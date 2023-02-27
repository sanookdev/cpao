<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminFolder extends MY_Controller
{
	private $itemOnPage = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($cat_id = null)
	{
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$this->load->helper('form');
		$item = $this->folder_Model->getByID($cat_id);
		if (count($item) == 0) {
			$item = [];
		} else {
			$item = $item[0];
		}

		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['cat_id'] = isset($cat_id) ? $cat_id : 0;
		$data['cat_dir'] = isset($item['cat_dir']) ? $item['cat_dir'] : '';
		$data['path'] = $this->folder_Model->path($data['cat_id'], false, false);
		$data['total_page'] = $this->folder_Model->count($data['cat_id']);
		$data['total_page'] += $this->folderFile_Model->count($data['cat_id']);
		$data['total_page'] =  ceil($data['total_page'] / $this->itemOnPage);
		$this->load->view('admin_folder', $data);
	}

	public function duplicate($cat_dir, $parent_id, $id = NULL)
	{
		$list = $this->folder_Model->getCatSmBy($parent_id, $id);
		foreach ($list as $row) {
			// $ex = explode('/', $row['cat_dir']);
			// $rs = end($ex);
			if ($row['cat_dir'] == $cat_dir) {
				return true;
			}
		}
		return false;
	}

	public function check_duplicate()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$cat_dir = $this->input->get('cat_dir');
		$id = $this->input->get('id');
		$parent_id = $this->input->get('parent_id');
		if ($this->duplicate($cat_dir, $parent_id, $id)) {
			echo 'false';
		} else {
			echo 'true';
		}
	}

	public function save_no()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$data = $this->input->post();
		$item = $this->folder_Model->getByID($data['cat_id']);
		if (count($item) > 0) {
			$item = $item[0];
		}

		$this->folder_Model->update_number($item['ordering'], $data['ordering'], $item['parent_id']);

		$return['isError'] = false;
		$response = $this->folder_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'เปลี่ยนลำดับไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'เปลี่ยนลำดับเรียบร้อย';
		}

		echo json_encode($return);
	}
	public function move_batch()
	{
		error_reporting(0);
		@ini_set('display_errors', 0);
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$list = $this->input->post('list');
		$moveFolder = $this->input->post('moveFolder');
		$target = $this->folder_Model->getByIdOne($moveFolder);
		$return['isError'] = false;
		$return['Message'] = '';
		$return['target'] = $target;
		foreach ($list as $row) {
			if ($row['type'] == 'folder') {
				$cat = $this->folder_Model->getByID($row['id']);
				if (count($cat) > 0) {
					$cat = $cat[0];
					$dir_target = $target['cat_dir'] . '/' . basename($cat['cat_dir']);
					// local
					rename($cat['cat_dir'], $dir_target);
					// mysql
					$cat['cat_dir'] = $dir_target;
					$cat['parent_id'] = $moveFolder;
					$this->folder_Model->save($cat);
				}
			} else if ($row['type'] == 'file') {
				$file = $this->folderFile_Model->getByID($row['id']);
				if (count($file) > 0) {
					$file = $file[0];
					$cat = $this->folder_Model->getByIdOne($file['cat_id']);
					$dir_target = $target['cat_dir'] . '/' . $file['url_download'];
					// local
					rename('awe12rhsto1m23fsd/jdownloads/' . $cat['cat_dir'] . '/' . $file['url_download'], 'awe12rhsto1m23fsd/jdownloads/' . $dir_target);
					// mysql
					$file['cat_id'] = $moveFolder;
					$this->folderFile_Model->save($this->session->userdata('user_id'), $file);
				}
			}
		}
		echo json_encode($return);
	}
	public function remove_batch()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$list = $this->input->post('list');
		$return['isError'] = false;
		$return['Message'] = 'ลบข้อมูลสำเร็จ';
		foreach ($list as $item) {
			if ($item['type'] == 'folder') {
				$return = $this->remove($item['id']);
				if ($return['isError']) {
					echo json_encode($return);
					return;
				}
			} else if ($item['type'] == 'file') {
				$file = $this->folderFile_Model->getByID($item['id']);
				if (isset($file[0])) {
					$file = $this->folderFile_Model->getByID($item['id'])[0];
					$cat = $this->folder_Model->getByID($file['cat_id']);
					if (count($cat) > 0) {
						$cat = $cat[0];
						if (is_file('awe12rhsto1m23fsd/jdownloads/' . $cat['cat_dir'] . '/' . $file['url_download'])) {
							unlink('awe12rhsto1m23fsd/jdownloads/' . $cat['cat_dir'] . '/' . $file['url_download']);
						}
					}
				}
				$return = $this->folderFile_Model->remove($item['id']);
				if ($return['isError']) {
					echo json_encode($return);
					return;
				}
			}
		}
		$return = [];
		$return['isError'] = false;
		$return['Message'] = 'ลบข้อมูลสำเร็จ';
		echo json_encode($return);
	}

	public function remove_folder()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$id = $this->input->post('id');

		echo json_encode($this->remove($id));
	}

	public function remove($id)
	{
		$return['isError'] = false;
		$return['Message'] = '';
		// rmdir
		$item = $this->folder_Model->getByID($id);
		if (count($item) == 0) {
			return $return;
		}
		$data = $item[0];
		$this->load->helper("file");
		$flgDelete = true;
		$path = 'awe12rhsto1m23fsd/jdownloads/' . $data['cat_dir'];
		if (is_dir($path)) {
			delete_files($path, true);
			$flgDelete = rmdir($path);
		}
		if (!$flgDelete) {
			$return['isError'] = true;
			$return['Message'] = 'ลบโฟลเดอร์ไม่สำเร็จ';
			return $return;
		}

		$response = $this->folder_Model->remove($id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบโฟลเดอร์ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบโฟลเดอร์สำเร็จ';
		}
		return $return;
	}

	public function load_tree()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$parent_id = $this->input->get('id');
		$select = $this->input->get('select');
		$select_id = [];
		if (isset($select)) {
			foreach ($select as $row) {
				$select_id[] = $row['id'];
			}
		}
		if (!isset($parent_id)) {
			$parent_id = 0;
		}
		$response = $this->folder_Model->getCatSmBy($parent_id);
		if ($parent_id == 0) {
			$list = [
				[
					'id' => 0,
					'text' => 'ศูนย์ข้อมูลลข่าวสาร',
					"children" => []
				]
			];
		}
		foreach ($response as $row) {
			$text = explode('/', $row['cat_dir']);
			$text = end($text);
			if (!in_array($row['cat_id'], $select_id)) {
				if ($parent_id == 0) {
					$list[0]['children'][] = [
						'id' => $row['cat_id'],
						'text' => $text,
						"children" => $row['sub'] > 0
					];
				} else {
					$list[] = [
						'id' => $row['cat_id'],
						'text' => $text,
						"children" => $row['sub'] > 0
					];
				}
			}
		}
		echo json_encode($list);
	}

	public function show_folder()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$response = $this->folder_Model->show($value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" โฟลเดอร์นี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" โฟลเดอร์นี้สำเร็จ';
		}
		echo json_encode($return);
	}

	public function save_href()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$data = $this->input->post('data');
		$return['isError'] = false;

		$response = $this->folder_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'มีข้อผิดพลาด ' . $response;
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกเรียบร้อย';
		}

		echo json_encode($return);
	}

	public function save_folder()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$data = $this->input->post('data');

		$return['isError'] = false;

		if (!isset($data['parent_id'])) {
			$item = $this->folder_Model->getByID($data['cat_id'])[0];
			$data['parent_id'] = $item['parent_id'];
		}
		if ($this->duplicate($data['cat_dir'], $data['parent_id'], $data['cat_id'])) {
			$return['isError'] = true;
			$return['Message'] = 'ชื่อโฟลเดอร์ซ้ำ';
			echo json_encode($return);
			return;
		}

		$response = $this->folder_Model->save($data);

		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'มีข้อผิดพลาด ' . $response;
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกเรียบร้อย';
		}

		echo json_encode($return);
	}


	public function load_folder()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$search = $this->input->get('search');
		$parent = $this->input->get('parent');
		$itemOnPage = $this->itemOnPage;
		$page = ($this->input->get('page') - 1) * $itemOnPage;
		$list = $this->folder_Model->getCatBy('cat_title', $search, $parent, $page, $itemOnPage);
		$files =  $this->folderFile_Model->getFileBy('file_title', $search, $parent, $page, $itemOnPage);
		$result = array_merge($list, $files);

		$data['total_page'] = $this->folder_Model->count($parent, false, $search);
		$data['total_page'] += $this->folderFile_Model->count($parent, false, $search);
		$data['total_page'] =  ceil($data['total_page'] / $this->itemOnPage);

		$data['result'] = $result;

		echo json_encode($data);
	}
}

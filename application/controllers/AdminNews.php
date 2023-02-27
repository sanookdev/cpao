<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminNews extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$this->load->model('CategoryNews_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_cate'] = $this->CategoryNews_Model->getAll();

		$this->load->view('admin_news_new', $data);
	}

	public function edit($id = '')
	{
		$this->load->model('CategoryNews_Model');
		$this->load->model('News_Model');
		$this->load->model('Attachment_Model');
		$this->load->model('images_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['item'] = $this->News_Model->news($id);
		$data['list_attachment'] = $this->Attachment_Model->getBy('news_id', $id);
		$data['list_images'] = $this->images_Model->getBy('news_id', $id);
		$data['list_cate'] = $this->CategoryNews_Model->getAll();

		$this->load->view('admin_news_edit', $data);
	}

	public function listData()
	{
		$this->load->model('CategoryNews_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_cate'] = $this->CategoryNews_Model->getNewsAll();

		$this->load->view('admin_news_list', $data);
	}

	public function listDataRss()
	{
		$this->load->model('CategoryNews_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_cate'] = $this->CategoryNews_Model->getRssAll();

		$this->load->view('admin_rss_list', $data);
	}

	public function export()
	{
		$this->load->model('CategoryNews_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_cate'] = $this->CategoryNews_Model->getAll();

		$this->load->view('admin_news_export', $data);
	}

	public function show()
	{
		header('Content-Type: application/json');
		$this->load->model('News_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$by = $this->session->userdata('user_id');
		$response = $this->News_Model->show($by, $value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" ข่าวนี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" ข่าวนี้สำเร็จ';
		}
		echo json_encode($return);
	}

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('News_Model');
		$this->load->model('Attachment_Model');
		$this->load->model('images_Model');
		$data = $this->input->post();
		$data['mod_user'] = $this->session->userdata('user_id');

		unset($data['link']);
		unset($data['tb_attach_no']);
		unset($data['tb_attach_title']);

		if (isset($data['public_date'])) {
			$date = $data['public_date'];
			$date = str_replace('/', '-', $date);
			$data['public_date'] = date('Y-m-d', strtotime($date));
		}
		if (isset($data['attachment'])) {
			if ($data['attachment'] != '') {
				$attachment = $data['attachment'];
			} else {
				$attachment = [];
			}
			unset($data['attachment']);
		}
		if (isset($data['images'])) {
			if ($data['images'] != '') {
				$images = $data['images'];
			} else {
				$images = [];
			}
			unset($data['images']);
		}

		// START manage old
		$old = $this->News_Model->news($data['news_id']);
		$old_attachment = $this->Attachment_Model->getBy('news_id', $data['news_id']);
		$old_image = $this->images_Model->getBy('news_id', $data['news_id']);

		if (isset($data['news_cover']) && $old && $old['news_cover'] != '' && $old['news_cover'] != $data['news_cover']) {
			$file = './uploads/' . $old['news_cover'];
			if (is_file($file))
				unlink($file);
		}
		// attachment
		if (count($old_attachment) > 0 && isset($attachment)) {
			foreach ($old_attachment as $file) {
				$path = './uploads/' . $file['attach_path'];
				$is_found = false;
				foreach ($attachment as $att) {
					if ($att['attach_path'] == $file['attach_path']) {
						$is_found = true;
						break;
					}
				}
				if (!$is_found) {
					$this->Attachment_Model->delete($file['attach_id']);
					$check_other = $this->Attachment_Model->getBy('attach_path', $file['attach_path']);
					if (is_file($path) && count($check_other) == 0)
						unlink($path);
				}
			}
		}
		// image
		if (count($old_image) > 0) {
			foreach ($old_image as $file) {
				$path = './uploads/' . $file['image_path'];
				if (isset($images) && !in_array($file['image_path'], $images)) {
					$this->images_Model->delete($file['image_id']);
					unlink($path);
				}
			}
		}
		// END manage old

		$return['isError'] = false;
		// attachment
		$id = $this->News_Model->save($data);
		if ($id && isset($attachment)) {
			foreach ($attachment as $att) {
				if ($att['attach_path']) {
					$this->Attachment_Model->saveData($data['mod_user'], $id, $att);
				}
			}
		}
		// images
		if ($id && isset($images)) {
			foreach ($images as $name) {
				if ($name) {
					$this->images_Model->save($data['mod_user'], $id, $name);
				}
			}
		}

		if (!$id) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
			$return['id'] = $id;
		}

		echo json_encode($return);
	}

	public function remove()
	{
		header('Content-Type: application/json');
		$this->load->model('News_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$response = $this->News_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function news()
	{
		header('Content-Type: application/json');
		$this->load->model('News_Model');
		$id = $this->input->get('id');
		$data = $this->News_Model->news($id);

		echo json_encode($data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('News_Model');
		$category_id = $this->input->get('category_id');
		$year = $this->input->get('year');
		$month = $this->input->get('month');
		$data = $this->News_Model->getAll($category_id, $year, $month);
		echo json_encode($data);
	}

	public function load_attachment() {
		header('Content-Type: application/json');
		$this->load->model('Attachment_Model');
		$data['result'] = $this->Attachment_Model->getAll();
		echo json_encode($data);
	}
}

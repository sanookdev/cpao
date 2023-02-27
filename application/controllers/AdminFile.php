<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminFile extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function save_no()
	{
		header('Content-Type: application/json');
		$this->load->model('folderFile_Model');
		$data = $this->input->post();
		$item = $this->folderFile_Model->getByID($data['file_id']);
		if (count($item) > 0) {
			$item = $item[0];
		}

		$this->folderFile_Model->update_number($item['ordering'], $data['ordering'], $item['cat_id']);

		$return['isError'] = false;
		$response = $this->folderFile_Model->save($this->session->userdata('user_id'), $data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'เปลี่ยนลำดับไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'เปลี่ยนลำดับเรียบร้อย';
		}

		echo json_encode($return);
	}

	public function remove_file()
	{
		header('Content-Type: application/json');
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$id = $this->input->post('id');
		$file = $this->folderFile_Model->getByID($id)[0];
		$cat = $this->folder_Model->getByID($file['cat_id'])[0];

		if ($cat) {
			unlink('awe12rhsto1m23fsd/jdownloads/'.$cat['cat_dir'].'/'.$file['url_download']);
		}

		$response = $this->folderFile_Model->remove($id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบโฟลเดอร์ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบโฟลเดอร์สำเร็จ';
		}
		echo json_encode($return);
	}

	public function show_file()
	{
		header('Content-Type: application/json');
		$this->load->model('folderFile_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$response = $this->folderFile_Model->show($value, $id);
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

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('folderFile_Model');
		$data = $this->input->post('data');

		$return['isError'] = false;
		$response = $this->folderFile_Model->save($this->session->userdata('user_id'), $data);

		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'มีข้อผิดพลาด';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกเรียบร้อย';
		}

		echo json_encode($return);
	}

	public function save_file()
	{
		header('Content-Type: application/json');
		$output = [];
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$cat_id = $this->input->post('cat_id');

		$cat = $this->folder_Model->getByID($cat_id);
		if (count($cat) == 0) {
			echo json_encode($output);
			return;
		}
		$cat = $cat[0];

		$path = 'awe12rhsto1m23fsd/jdownloads/' . $cat['cat_dir'];
		$config['encrypt_name'] = FALSE;
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|zip|rar|7z';
		$config['max_size'] = '102400'; // max_size in kb
		if (!empty($_FILES['myfile']['name'])) {
			if (!is_array($_FILES["myfile"]["name"])) //single file
			{
				$config['file_name'] = $_FILES['myfile']['name'];

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('myfile')) {
					$uploadData = $this->upload->data();
					$output[] = $uploadData['file_name'];
					$data = [
						'file_id' => 0,
						'file_title' => $uploadData['file_name'],
						'file_alias' => $uploadData['file_name'],
						'url_download' => $uploadData['file_name'],
						'cat_id' => $cat_id,
						'downloads' => 0,
						'size' => $this->formatSizeUnits(filesize($path.'/'.$uploadData['file_name'])),
					];
					$rep = $this->folderFile_Model->save($this->session->userdata('user_id'), $data);
					$output[] = $rep;
				}
			} else {
				$input = "myfile";
				$files = $_FILES;
				$total  = count($_FILES["myfile"]["name"]);
				for ($i = 0; $i < $total; $i++) {
					if (isset($files[$input]['name'][$i])) {
						$_FILES[$input]['name'] = $files[$input]['name'][$i];
						$_FILES[$input]['type'] = $files[$input]['type'][$i];
						$_FILES[$input]['tmp_name'] = $files[$input]['tmp_name'][$i];
						$_FILES[$input]['error'] = $files[$input]['error'][$i];
						$_FILES[$input]['size'] = $files[$input]['size'][$i];

						$config['file_name'] = $_FILES[$input]['name'];
						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if (!$this->upload->do_upload($input)) {
							$output[] = $this->upload->display_errors();
						} else {
							$uploadData = $this->upload->data();
							$data = [
								'file_id' => 0,
								'file_title' => $uploadData['file_name'],
								'file_alias' => $uploadData['file_name'],
								'url_download' => $uploadData['file_name'],
								'cat_id' => $cat_id,
								'downloads' => 0,
								'size' => $this->formatSizeUnits(filesize($path.'/'.$uploadData['file_name'])),
							];
							$rep = $this->folderFile_Model->save($this->session->userdata('user_id'), $data);
							$output[] = $rep;
							$output[] = $uploadData['file_name'];
						}
					}
				}
			}
		}
		echo json_encode($output);
	}

	function formatSizeUnits($bytes)
	{
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}

		return $bytes;
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminUpload extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function fileinput_upload()
	{
		header('Content-Type: application/json');
		// $bdInteli = $this->input->post('bdInteli');
		// $ci_last_regenerate = $_SESSION['__ci_last_regenerate'];
		// if ($bdInteli != $ci_last_regenerate) {
		// 	$out['error'] = 'key not match!!';
		// 	echo json_encode($out);
		// 	exit();
		// }
		$preview = $config = $errors = [];
		$input = 'attachment';
		if ($this->input->get('input') != null) {
			$input = $this->input->get('input');
		}
		if (empty($_FILES[$input])) {
			echo json_encode([]);
			return;
		}
		$total = count($_FILES[$input]['name']);
		$path = 'uploads/';
		$out['error'] = $total;
		$config_output = [];
		// Set preference
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|ppt|pptx|xls|xlsx|zip|rar|7z';
		$config['max_size'] = '102400'; // max_size in kb

		//Load upload library
		$this->load->library('upload', $config);
		$files = $_FILES;
		for ($i = 0; $i < $total; $i++) {
			$_FILES[$input]['name'] = $files[$input]['name'][$i];
			$_FILES[$input]['type'] = $files[$input]['type'][$i];
			$_FILES[$input]['tmp_name'] = $files[$input]['tmp_name'][$i];
			$_FILES[$input]['error'] = $files[$input]['error'][$i];
			$_FILES[$input]['size'] = $files[$input]['size'][$i];

			$this->upload->initialize($config);
			if (!$this->upload->do_upload($input)) {
				$errors[] = $this->upload->display_errors();
			} else {
				$uploadData = $this->upload->data();
				$new_file_name = $uploadData['file_name'];
				$newFileUrl = base_url('/uploads/' . $new_file_name);
				$config_output[] = [
					'key' => $new_file_name,
					'caption' => $new_file_name,
					'size' => $_FILES[$input]['size'],
					'downloadUrl' => $newFileUrl, // the url to download the file
				];
			}
		}
		$out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config_output, 'initialPreviewAsData' => true];
		if (!empty($errors)) {
			$img = count($errors) === 1 ?  $errors[0] : 'files: "' . implode('", "', $errors) . '" ';
			$out['error'] = $img;
		}
		echo json_encode($out);
	}

	public function file_upload()
	{
		header('Content-Type: application/json');
		// $bdInteli = $this->input->post('bdInteli');
		// $ci_last_regenerate = $_SESSION['__ci_last_regenerate'];
		// if ($bdInteli != $ci_last_regenerate) {
		// 	$out['error'] = 'key not match!!';
		// 	echo json_encode($out);
		// 	exit();
		// }
		$preview = $config = $errors = [];
		$input = 'attachment';
		if ($this->input->get('input') != null) {
			$input = $this->input->get('input');
		}
		if (empty($_FILES[$input])) {
			echo json_encode([]);
			return;
		}
		$total = count($_FILES[$input]['name']);
		$path = 'uploads/';
		$out['error'] = $total;
		$config_output = [];
		// Set preference
		$config['encrypt_name'] = FALSE;
		$config['upload_path'] = 'uploads/'.date('Y-m-d').'/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|ppt|pptx|xls|xlsx|zip|rar|7z';
		$config['max_size'] = '102400'; // max_size in kb

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		//Load upload library
		$files = $_FILES;
		for ($i = 0; $i < $total; $i++) {
			$_FILES[$input]['name'] = $files[$input]['name'][$i];
			$_FILES[$input]['type'] = $files[$input]['type'][$i];
			$_FILES[$input]['tmp_name'] = $files[$input]['tmp_name'][$i];
			$_FILES[$input]['error'] = $files[$input]['error'][$i];
			$_FILES[$input]['size'] = $files[$input]['size'][$i];
			$config['file_name'] = $_FILES[$input]['name'];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload($input)) {
				$errors[] = $this->upload->display_errors();
			} else {
				$uploadData = $this->upload->data();
				$new_file_name = date('Y-m-d').'/' . $uploadData['file_name'];
				$newFileUrl = base_url($config['upload_path'] . $new_file_name);
				$config_output[] = [
					'key' => $new_file_name,
					'caption' => $new_file_name,
					'size' => $_FILES[$input]['size'],
					'downloadUrl' => $newFileUrl, // the url to download the file
				];
			}
		}
		$out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config_output, 'initialPreviewAsData' => true];
		if (!empty($errors)) {
			$img = count($errors) === 1 ?  $errors[0] : 'files: "' . implode('", "', $errors) . '" ';
			$out['error'] = $img;
		}
		echo json_encode($out);
	}

	public function fileinput_remove()
	{ 
		header('Content-Type: application/json');
		echo json_encode([]);
	}

	public function fileremove()
	{
		$file = './uploads/' . $this->input->post('name');
		if (is_file($file))
			unlink($file);
	}

	// File upload
	public function fileUpload()
	{
		header('Content-Type: application/json');
		if (!empty($_FILES['file']['name'])) {

			// Set preference
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|zip|rar|7z';
			$config['max_size'] = '102400'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
				echo json_encode($uploadData);
				return;
			}
		}
		echo json_encode(array());
	}

	public function fileUploadSummernote()
	{
		if (!empty($_FILES['file']['name'])) {

			// Set preference
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|zip|rar|7z';
			$config['max_size'] = '102400'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
				echo '/cpao/uploads/'.$uploadData['file_name'];
			}
		}
	}

	public function fileUpload_attachment()
	{
		$input = 'attachment';
		$row = $this->input->post('row');
		if ($row == null) {
			header('Content-Type: application/json');
			echo json_encode([]);
			return;
		}
		$server = $this->input->post('server');
		$total = count($row);
		$files = $_FILES;
		$output = [];

		$config['encrypt_name'] = FALSE;
		$config['upload_path'] = 'uploads/'.date('Y-m-d').'/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|zip|rar|7z';
		$config['max_size'] = '102400'; // max_size in kb

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

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
					$output[] = [
						'index' => $i,
						'file_name' => date('Y-m-d').'/'.$uploadData['file_name']
					];
				}
			}
			else if (isset($server[$i])) {
				$output[] = [
					'index' => $i,
					'file_name' => $server[$i]
				];
			}
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}
}

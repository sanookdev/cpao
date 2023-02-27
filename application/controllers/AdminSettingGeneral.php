<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminSettingGeneral extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function general()
	{
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		return $this->load->view('admin_setting_general', $data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$name = 'general';
		$list = $this->Setting_Model->getBy('setting_group', $name);
		echo json_encode($list);
	}

	public function save()
	{
		$this->output->delete_cache('/home/index');
		$this->db->cache_delete('home', 'index');
		header('Content-Type: application/json');
		$this->load->model('setting_Model');
		$data = $this->input->post();
		$data['mod_user'] = $this->session->userdata('user_id');

		// check upload file
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
			$config['max_size'] = '30720'; // max_size in kb
			$config['file_name'] = $_FILES['file']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$uploadData = $this->upload->data();
				$data['setting_value'] = $uploadData['file_name'];
			}
		}

		// START manage old
		$old = $this->setting_Model->setting_web($data['setting_id']);
		if (isset($data['setting_value']) && $old && $old['setting_value'] != '' && $old['setting_value'] != $data['setting_value']) {
			$file = './uploads/' . $old['setting_value'];
			if (is_file($file))
				unlink($file);
		}
		// END manage old

		if (!$old) {
			$data['setting_no'] = $this->setting_Model->getMaxNo('setting_name', 'slideimage') + 1;
		}

		$return['isError'] = false;
		$id = $this->setting_Model->save($data);
		if (!$id) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
			$return['id'] = $id;
		}
		$this->setting_Model->getAll(true, true);
		echo json_encode($return);
	}

	public function show()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$by = $this->session->userdata('user_id');
		$response = $this->Setting_Model->show($by, $value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" ข้อมูลนี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" ข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function remove()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$response = $this->Setting_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function setting()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$id = $this->input->get('id');
		$data = $this->Setting_Model->setting_web($id);

		echo json_encode($data);
	}
}

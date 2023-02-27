<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminSettingPartner extends MY_Controller
{
	private $setting_name = "partner";

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['post'] = 'AdminSettingPartner';
		$data['page'] = 'หน่วยงานที่เกี่ยวข้อง';
		// $data['image_suggeest'] = '(ความสูง x60)';
		return $this->load->view('admin_setting', $data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$list = $this->Setting_Model->getBy('setting_name', $this->setting_name);
		echo json_encode($list);
	}

	public function save()
	{

		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$data = $this->input->post();
		$data['setting_name'] = $this->setting_name;
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
		$old = $this->Setting_Model->setting_web($data['setting_id']);
		if (isset($data['setting_value']) && $old && $old['setting_value'] != '' && $old['setting_value'] != $data['setting_value']) {
			$file = './uploads/' . $old['setting_value'];
			if (is_file($file))
				unlink($file);
		}
		// END manage old

		if (!$old) {
			$data['setting_no'] = $this->Setting_Model->getMaxNo('setting_name', $this->setting_name) + 1;
		}

		$return['isError'] = false;
		$id = $this->Setting_Model->save($data);
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

	public function save_no()
	{
		header('Content-Type: application/json');
		$this->load->model('Setting_Model');
		$data = $this->input->post();
		$item = $this->Setting_Model->setting_web($data['setting_id']);

		$this->Setting_Model->update_number($this->setting_name, $item['setting_no'], $data['setting_no']);

		$data['mod_user'] = $this->session->userdata('user_id');

		$return['isError'] = false;
		$response = $this->Setting_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'เปลี่ยนลำดับไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'เปลี่ยนลำดับเรียบร้อย';
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

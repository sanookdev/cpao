<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminCategoryNews extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function news()
	{
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$this->load->view('admin_category_news', $data);
	}

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('CategoryNews_Model');
		$data = $this->input->post();
		$data['mod_user'] = $this->session->userdata('user_id');

		$return['isError'] = false;
		$response = $this->CategoryNews_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
		}

		echo json_encode($return);
	}

	public function save_no()
	{
		header('Content-Type: application/json');
		$this->load->model('CategoryNews_Model');
		$data = $this->input->post();
		$item = $this->CategoryNews_Model->category_news($data['category_id']);

		$this->CategoryNews_Model->update_number($item['category_no'], $data['category_no']);

		$data['mod_user'] = $this->session->userdata('user_id');

		$return['isError'] = false;
		$response = $this->CategoryNews_Model->save($data);
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
		$this->load->model('CategoryNews_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$item = $this->CategoryNews_Model->category_news($id);
		if ($item['is_lock'] == '1') {
			$return['isError'] = true;
			$return['Message'] = 'ไม่สามารถลบรายการนี้ได้ เนื่องจากเป็นรายการเริ่มต้น';
			echo json_encode($return);
			return;
		}
		$response = $this->CategoryNews_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function show()
	{
		header('Content-Type: application/json');
		$this->load->model('CategoryNews_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$by = $this->session->userdata('user_id');
		$response = $this->CategoryNews_Model->show($by, $value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" ประเภทข่าวนี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" ประเภทข่าวนี้สำเร็จ';
		}
		echo json_encode($return);
	}

	public function category_news()
	{
		header('Content-Type: application/json');
		$this->load->model('CategoryNews_Model');
		$id = $this->input->get('id');
		$data = $this->CategoryNews_Model->category_news($id);
		echo json_encode($data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('CategoryNews_Model');
		$data = $this->CategoryNews_Model->getAll();
		echo json_encode($data);
	}
}

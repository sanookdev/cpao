<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminManageMenu extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function manage()
	{
		$this->load->model('Menu_Model');
		$this->load->model('Page_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->where('menu.is_head = 0 AND menu.parent_id IS NULL');
		$data['list_page'] = $this->Page_Model->getAll();
		return $this->load->view('admin_menu_manage', $data);
	}

	public function head()
	{
		$this->load->model('Menu_Model');
		$this->load->model('Page_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->where('menu.is_head = 1 AND menu.parent_id IS NULL AND menu.page_id IS NULL');
		$data['list_page'] = $this->Page_Model->getAll();
		return $this->load->view('admin_menu_head', $data);
	}

	public function load_page()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$list = $this->Page_Model->getAll();
		echo json_encode($list);
	}
	
	public function submenu()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->getBy('parent_id', NULL);
		return $this->load->view('admin_menu_submenu', $data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$parent_id = $this->input->get('menu_id');
		$list = $this->Menu_Model->getBy('parent_id', $parent_id);
		echo json_encode($list);
	}

	public function load_list_submenu2()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		if ($this->input->get('id')) {
			$id = $this->input->get('id');
			$list = $this->Menu_Model->getSubmenu2('parent_id', $id);
		} 
		else {
			$list = $this->Menu_Model->getSubmenu2();
		}
		echo json_encode($list);
	}

	public function load_list_submenu()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->get('id');
		$list = $this->Menu_Model->getSubmenu($id);
		echo json_encode($list);
	}

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$data = $this->input->post();
		$data['mod_user'] = $this->session->userdata('user_id');

		$return['isError'] = false;
		$id = $this->Menu_Model->save($data);
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

	public function save_no()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$data = $this->input->post();
		$item = $this->Menu_Model->menu($data['menu_id']);

		$this->Menu_Model->update_number($item['menu_no'], $data['menu_no'], $data['parent_id']);

		$data['mod_user'] = $this->session->userdata('user_id');

		$return['isError'] = false;
		$response = $this->Menu_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'เปลี่ยนลำดับไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'เปลี่ยนลำดับเรียบร้อย';
		}

		echo json_encode($return);
	}

	public function show()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$by = $this->session->userdata('user_id');
		$response = $this->Menu_Model->show($by, $value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" เมนูนี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" เมนูนี้สำเร็จ';
		}
		echo json_encode($return);
	}

	public function remove()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$response = $this->Menu_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function menu()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->get('id');
		$data = $this->Menu_Model->menu($id);

		echo json_encode($data);
	}
}

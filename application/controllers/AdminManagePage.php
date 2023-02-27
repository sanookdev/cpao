<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminManagePage extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function manage()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->getBy('parent_id', NULL);
		return $this->load->view('admin_page_manage', $data);
	}

	public function listData()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->getBy('parent_id', NULL);
		return $this->load->view('admin_page_list', $data);
	}

	public function create()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->getBy('parent_id', NULL);
		return $this->load->view('admin_page_new', $data);
	}


	public function edit($id='')
	{
		$this->load->model('Page_Model');
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_menu'] = $this->Menu_Model->getBy('parent_id', NULL);
		$data['item'] = $this->Page_Model->page($id);
		
		$this->load->view('admin_page_edit', $data);
    }

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$list = $this->Page_Model->getList();
		echo json_encode($list);
	}

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$this->load->model('Menu_Model');
		$data = $this->input->post();
		$data['mod_user'] = $this->session->userdata('user_id');

		// manage menu old
		$old = $this->Menu_Model->getBy('page_id', $data['page_id']);
		if (isset($data['menu_id']) && count($old) > 0) {
			$old = $old[0];
			if ($old && $old['menu_id'] != $data['menu_id']) {
				$old['page_id'] = null;
				$this->Menu_Model->save($old);
			}
		}

		if (isset($data['menu_id'])) {
			$menu['menu_id'] = $data['menu_id'];
		}
		
		unset($data['parent_id']);
		unset($data['menu_id']);
		unset($data['link']);

		$return['isError'] = false;
		$id = $this->Page_Model->save($data);
		if (!$id) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
			$return['id'] = $id;
			if (isset($menu['menu_id'])) {
				$this->load->model('Menu_Model');
				$menu['page_id'] = $id;
				$this->Menu_Model->save($menu);
			}
		}

		echo json_encode($return);
	}

	public function menu_is_empty() {
		$this->load->model('Menu_Model');
		$menu_id = $this->input->get('menu_id');
		$page_id = $this->input->get('page_id');
		$action = $this->input->get('action');
		$data = $this->Menu_Model->getBy('menu_id', $menu_id, false)[0];
		if ($action == 'new') {
			if ($data['page_id'] == null) {
				echo 'true';
				return;
			}
		}
		else{
			if ($data['page_id'] == null || $data['page_id'] == $page_id) {
				echo 'true';
				return;
			}
		}
		echo 'false';
	}

	public function show()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$by = $this->session->userdata('user_id');
		$response = $this->Page_Model->show($by, $value, $id);
		$text = $value == '0' ? 'ซ่อน' : 'แสดง';
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = '"' . $text . '" หน้านี้ไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = '"' . $text . '" หน้านี้สำเร็จ';
		}
		echo json_encode($return);
	}

	public function remove()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$response = $this->Page_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function load_submenu_empty()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->get('id');
		$list = $this->Menu_Model->getBy('parent_id', $id, false, true);

		echo json_encode($list);
	}

	public function load_submenu()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->get('id');
		$list = $this->Menu_Model->getBy('parent_id', $id, false, false);

		echo json_encode($list);
	}

	public function page()
	{
		header('Content-Type: application/json');
		$this->load->model('Page_Model');
		$id = $this->input->get('id');
		$data = $this->Page_Model->page($id);

		echo json_encode($data);
	}
}

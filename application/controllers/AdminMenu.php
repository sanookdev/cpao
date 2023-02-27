<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminMenu extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function listData()
	{
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$this->load->model('Page_Model');
		$data['list_page'] = $this->Page_Model->getAll();
		return $this->load->view('admin_menu_list', $data);
	}

	public function load_list()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$list = $this->Menu_Model->getParentAll();
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

		$this->Menu_Model->update_number($item['menu_no'], $data['menu_no']);

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

	public function check_duplicate() {
		$this->load->model('Menu_Model');
		$this->load->model('page_Model');
		$value = $this->input->get('value');
		$id = $this->input->get('id');
		$page_id = $this->input->get('page_id');
		$action = $this->input->get('action');
		$col = $this->input->get('col');
		$where = '';
		$page = $this->page_Model->page($page_id);
		if ($page['page_type'] == 'link'){
			echo 'true';
			return;
		}
		if ($action == 'new') {
			if (isset($page_id)) {
				$where = "menu.$col = '$value' 
				AND menu.parent_id IS NOT NULL 
				AND menu.page_id IS NOT NULL
				AND menu.page_id != '$page_id'";
			}
			else {
				$where = "menu.$col = '$value' 
				AND menu.parent_id IS NOT NULL 
				AND menu.page_id IS NOT NULL";
			}
		}
		else{
			if (isset($page_id)) {
				$where = "menu.$col = '$value' 
				AND page.page_type != 'link'
				AND menu.menu_id != $id
				AND menu.parent_id IS NOT NULL 
				AND menu.page_id IS NOT NULL
				AND menu.page_id != '$page_id'";
			}
			else {
				$where = "menu.$col = '$value' 
				AND menu.menu_id != $id
				AND menu.parent_id IS NOT NULL 
				AND menu.page_id IS NOT NULL";
			}
		}
		$data = $this->Menu_Model->where($where);
		// echo json_encode($data);
		echo count($data) > 0 ? 'false' : 'true';
	}

	public function check_duplicate2() {
		$this->load->model('Menu_Model');
		$value = $this->input->get('value');
		$id = $this->input->get('id');
		$action = $this->input->get('action');
		$col = $this->input->get('col');
		if ($action == 'new') {
			$data = $this->Menu_Model->getSubmenu2($col, $value);
		}
		else{
			$data = $this->Menu_Model->getSubmenu2NotId($col, $value, $id);
		}
		echo count($data) > 0 ? 'false' : 'true';
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

	public function head()
	{
		header('Content-Type: application/json');
		$this->load->model('Menu_Model');
		$id = $this->input->post('id');
		$is_head = $this->input->post('is_head');
		$by = $this->session->userdata('user_id');
		$data['menu_id'] = $id;
		$data['is_head'] = $is_head;
		$data['mod_user'] = $by;
		$response = $this->Menu_Model->save($data);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
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

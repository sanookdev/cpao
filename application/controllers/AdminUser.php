<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUser extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
	}
	
	public function create()
	{
		$this->load->model('permission_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['permission'] = $this->permission_Model->getAll();
		$this->load->view('admin_user_new', $data);
    }
    
    public function listData()
	{
		$this->load->model('permission_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['permission'] = $this->permission_Model->getAll();
		$this->load->view('admin_user_list', $data);
	}
	
	public function check_duplicate() {
		$this->load->model('User_Model');
		$value = $this->input->get('value');
		$id = $this->input->get('id');
		$action = $this->input->get('action');
		$col = $this->input->get('col');
		if ($action == 'new') {
			$data = $this->User_Model->getBy($col, $value);
		}
		else{
			$data = $this->User_Model->getByNotId($col, $value, $id);
		}
		echo count($data) > 0 ? 'false' : 'true';
	}

	public function save() 
	{
		header('Content-Type: application/json');
		$this->load->model('User_Model');
		$data = $this->input->post();
		$permission = $this->input->post('pem');
		if ($permission == null) {
			$permission = [];
		}
		$data['mod_user'] = $this->session->userdata('user_id');

		// remove field
		unset($data['confirmed']); 
		unset($data['pem']); 
		unset($data['toggle_password']);

		$date = $data['birthday'];
		$date= str_replace('/', '-', $date);
		$data['birthday'] = date('Y-m-d', strtotime($date));
		$data['password'] = $this->encryption->encrypt($data['password']);

		if (!isset($data['user_id']) || $data['user_id'] == '') {
			$chk_usernme = $this->User_Model->getBy('username', $data['username']);
			$chk_email = $this->User_Model->getBy('email', $data['email']);
		}
		else{
			$chk_usernme = $this->User_Model->getByNotId('username', $data['username'], $data['user_id']);
			$chk_email = $this->User_Model->getByNotId('email', $data['email'], $data['user_id']);
		}

		if (count($chk_email) > 0) {
			$return['isError'] = true;
			$return['Message'] = 'Email already in use!';
			echo json_encode($return);
			exit();
		}

		if (count($chk_usernme) > 0) {
			$return['isError'] = true;
			$return['Message'] = 'Username already in use!';
			echo json_encode($return);
			exit();
		}

		$return['isError'] = false;
		$response = $this->User_Model->save($data);
		$userId = $response;
		// Permission
		$this->load->model('Permission_Model');
		$this->Permission_Model->resetUser($userId);
		foreach($permission as $pem) {
			$this->Permission_Model->save($userId, $pem, 1);
		}
		//
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
		}
		else {
			$return['isError'] = false;
			$return['Message'] = 'บันทึกข้อมูลสำเร็จ';
		}

		echo json_encode($return);
	}

	public function remove() 
	{
		header('Content-Type: application/json');
		$this->load->model('User_Model');
		$id = $this->input->post('id');
		$by = $this->session->userdata('user_id');
		$response = $this->User_Model->remove($by, $id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		}
		else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function user() 
	{
		header('Content-Type: application/json');
		$this->load->model('User_Model');
		$this->load->model('Permission_Model');
		$id = $this->input->get('id');
		$data = $this->User_Model->user($id);
		if ($data['password'] != '')
			$data['password'] = $this->encryption->decrypt($data['password']);
		$data['permission'] = $this->Permission_Model->getUser($id);
		echo json_encode($data);
	}

	public function load_list() 
	{
        header('Content-Type: application/json');
		$this->load->model('User_Model');
		$data = $this->User_Model->getAll();
		echo json_encode($data);
	}
}

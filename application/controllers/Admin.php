<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$this->load->view('admin', $data);
	}

	public function test()
	{
		$this->load->library('user_agent');
		$this->load->library('rememberme');
		$this->load->model('online_users_mod');

		$data['cookie_name'] = 'rmtoken_' . str_replace('.', '_', $_SERVER['SERVER_NAME']);
		$data['cookie'] = $this->input->cookie('rmtoken_' . str_replace('.', '_', $_SERVER['SERVER_NAME']));
		$data['cookie_user'] = $this->rememberme->verifyCookie();
		$data['user'] = $this->session->userdata();
		$data['user_online'] = $this->online_users_mod->get_count_session_data();
		echo json_encode($data);
	}
}

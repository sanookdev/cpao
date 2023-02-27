<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->library('rememberme');
		$this->load->library('user_agent');
		$cookie_user = $this->rememberme->verifyCookie();
		if ($cookie_user) {
			if (!$this->session->userdata('logged_in') || !$this->session->has_userdata('username')) {
				$user = $this->User_Model->user($cookie_user);
				$newdata = array(
					'username'  => $user['username'],
					'fname'  => $user['fname'],
					'lname'  => $user['lname'],
					'profile_image'  => $user['profile_image'],
					'user_id'  => $user['user_id'],
					'is_admin'  => $user['is_admin'],
					'time_logged_in' => time(),
					'logged_in' => true,
					'rememberme_session' => $user['user_id']
				);
				$this->rememberme->setCookie($newdata['user_id']);
				$this->session->set_userdata($newdata);
			}
			$this->rememberme->setCookie($this->session->userdata('user_id'));
			return;
		}
		if (!$this->session->has_userdata('logged_in') || !$this->session->logged_in) {
			header('Location: ' . base_url('login'));
			exit;
		}
		$user_permission = $this->getPermission();
		$user = $this->session->userdata();
		$name_permission = $this->uri->segment(1);
		switch (strtolower($this->uri->segment(1))) {
			case 'admin':
			case 'adminmail':
			case 'adminupload':
				$name_permission = 'admin';
				break;
			case 'adminuser':
			case 'adminupload':
				$name_permission = 'user';
				break;
			case 'admincategorynews':
			case 'adminupload':
				$name_permission = 'category_news';
				break;
			case 'adminnews':
			case 'adminupload':
				$name_permission = 'news';
				break;
			case 'adminmanagemenu':
			case 'adminmenu':
				$name_permission = 'menu';
				break;
			case 'adminmanagepage':
			case 'adminupload':
				$name_permission = 'page';
				break;
			case 'adminsettinggeneral':
			case 'adminupload':
				$name_permission = 'general';
				break;
			case 'adminsettingcover':
			case 'adminupload':
				$name_permission = 'cover';
				break;
			case 'adminsettingexternallink':
			case 'adminupload':
				$name_permission = 'external/link';
				break;
			case 'adminsettingevent':
			case 'adminupload':
				$name_permission = 'event';
				break;
			case 'adminsettingpartner':
			case 'adminupload':
				$name_permission = 'partner';
				break;
			case 'adminsettingspecial':
			case 'adminupload':
				$name_permission = 'special';
				break;
			case 'adminfolder':
			case 'adminupload':
			case 'adminfile':
				$name_permission = 'folder';
				break;
			case 'adminmail':
				$name_permission = 'report';
				break;
		}
		if (!$user['is_admin'] && !($user_permission[$name_permission] && $user_permission[$name_permission] == 1)) {
			header('Location: ' . base_url('admin'));
		}
	}

	public function getPermission()
	{
		$this->load->model('permission_Model');
		$user = $this->session->userdata();
		$permission = $this->permission_Model->getUser($user['user_id']);
		$result = ['admin' => 1];
		foreach ($permission as $pem) {
			if ($pem['is_active'] == '1') {
				$result[$pem['name']] = 1;
			}
		}
		return $result;
	}

	public function is_logged_in()
	{
		return $this->session->has_userdata('logged_in') && $this->session->logged_in;
	}
}

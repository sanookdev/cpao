<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	private static $smtp_user = 'not-reply@chon.go.th';
	private static $smtp_pass = 'VFD3H4aFeh';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->is_logged_in()) {
			header('Location: ' . base_url('admin'));
			exit;
		} else {
			$this->load->view('login');
		}
	}

	public function forgotpassword()
	{
		if ($this->is_logged_in()) {
			header('Location: ' . base_url('admin'));
			exit;
		} else {
			$this->load->view('forgotpassword');
		}
	}

	public function send_forgot_password()
	{
		$to = $this->input->post('email');
		$this->load->model('Login_Model');
		$this->load->model('User_Model');
		$user = $this->Login_Model->getBy('email', $to);
		if (!$user) {
			$this->session->set_flashdata("class", "label-danger");
			$this->session->set_flashdata("email_sent", "ไม่พบ Email ในระบบ");
			header('Location: ' . base_url('forgotpassword'));
			return;
		}
		$password = $this->random_password();
		$user['password'] = $this->encryption->encrypt($password);
		$this->User_Model->save($user);

		$this->load->library('phpmailer_library');
		$this->load->library('email');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.chon.go.th';
		$config['smtp_port'] = '587'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
		$config['smtp_user'] = self::$smtp_user;
		$config['smtp_pass'] = self::$smtp_pass;
		$config['smtp_crypto'] = 'ssl';
		$config['charset'] = 'utf-8';
		$this->email->set_mailtype("html");
		$this->email->from(self::$smtp_user,  'Chonburi Provincial Administrative Organization');
		$this->email->to($to);
		$this->email->subject('Reset Password | Chonburi Provincial Administrative Organization');

		$username = $user['username'];
		$mailContent = "<p>เนื่องจากมีการกดลืมรหัสผ่าน ระบบจะทำการรีเซ็ตรหัสผ่านให้อัตโนมัติ</p>
		<p>รหัสผู้ใช้ : $username </p>
		<p>รหัสผ่าน : $password </p>
		<p></p>
		<p>Thank,</p>
		<p>Chonburi Provincial Administrative Organization</p>
		";


		$this->email->message($mailContent);
		$res = $this->email->send();
		if ($res) {
			$this->session->set_flashdata("class", "label-success");
			$this->session->set_flashdata("email_sent", "รหัสผ่านใหม่ถูกส่งไปใน Email เรียบร้อย");
		} else {
			$this->session->set_flashdata("class", "label-danger");
			$this->session->set_flashdata("email_sent", "ไม่สามารถส่ง Email ได้");
		}
		header('Location: ' . base_url('forgotpassword'));
	}

	public function redirect()
	{
		header('Location: ' . base_url('admin'));
	}

	public function login()
	{
		header('Content-Type: application/json');
		$this->load->model('Login_Model');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$user = $this->Login_Model->login($data);
		if ($data['password'] == '') {
			$data = array(
				'isError' => true,
				'Message' => 'กรุณากรอกรหัสผ่าน'
			);
			echo json_encode($data);
			return;
		}
		if ($data['username'] == '') {
			$data = array(
				'isError' => true,
				'Message' => 'กรุณากรอกรหัสผู้ใช้'
			);
			echo json_encode($data);
			return;
		}
		if (count($user) > 0) {
			$newdata = array(
				'username'  => $user[0]->username,
				'fname'  => $user[0]->fname,
				'lname'  => $user[0]->lname,
				'profile_image'  => $user[0]->profile_image,
				'user_id'  => $user[0]->user_id,
				'is_admin'  => $user[0]->is_admin,
				'time_logged_in' => time(),
				'logged_in' => true
			);
			$this->session->sess_expiration = '1800';
			$this->session->set_userdata($newdata);
			$this->load->library('rememberme');
			$this->load->library('user_agent');
			$this->rememberme->setCookie($newdata['user_id']);
			$data = array(
				'isError' => false,
				'Message' => ''
			);
			echo json_encode($data);
		} else {
			$data = array(
				'isError' => true,
				'Message' => 'รหัสไม่ถูกต้อง'
			);
			echo json_encode($data);
		}
	}

	public function logout()
	{
		$this->load->library('rememberme');
		$this->session->sess_destroy();
		$this->rememberme->deleteCookie();
		header('Location: ' . base_url('login'));
	}

	private function random_password()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$password = array();
		$alpha_length = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
		}
		return implode($password);
	}

	public function is_logged_in()
	{
		return $this->session->has_userdata('logged_in') && $this->session->logged_in;
	}
}

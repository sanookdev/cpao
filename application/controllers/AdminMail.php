<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminMail extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		return $this->load->view('admin_mail_history', $data);
	}

	public function sent()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		return $this->load->view('admin_mail_sent', $data);
	}

	public function rank()
	{
		$this->load->model('Menu_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		return $this->load->view('admin_mail_top', $data);
	}

	public function manage()
	{
		$this->load->model('Mail_Model');
		$data['user'] = $this->session->userdata();
		$data['user_permission'] = $this->getPermission();
		$data['list_mail'] = $this->Mail_Model->getAll();
		return $this->load->view('admin_mail_manage', $data);
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
		$this->load->model('Mail_Model');
		$list = $this->Mail_Model->getAll();
		echo json_encode($list);
	}

	public function import()
	{
		header('Content-Type: application/json');
		$this->load->model('Mail_Model');
		$data = $this->input->post('lines');

		foreach ($data as &$value) {
			$value['mail_password'] = $this->encryption->encrypt($value['mail_password']);
			$id = $this->Mail_Model->save($value);
			if (!$id) {
				$return['isError'] = true;
				$return['Message'] = 'บันทึกข้อมูลไม่สำเร็จ';
				echo json_encode($return);
				return;
			} 
		}
		$return['isError'] = false;
		$return['Message'] = 'บันทึกข้อมูลสำเร็จ';

		echo json_encode($return);
	}

	public function save()
	{
		header('Content-Type: application/json');
		$this->load->model('Mail_Model');
		$data = $this->input->post();
		$old = $data['old'];

		unset($data['toggle_password']);
		unset($data['old']);

		$data['mail_password'] = $this->encryption->encrypt($data['mail_password']);

		$id = $this->Mail_Model->save($data, $old);

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

	public function remove()
	{
		header('Content-Type: application/json');
		$this->load->model('Mail_Model');
		$id = $this->input->post('id');
		$response = $this->Mail_Model->remove($id);
		if (!$response) {
			$return['isError'] = true;
			$return['Message'] = 'ลบข้อมูลไม่สำเร็จ';
		} else {
			$return['isError'] = false;
			$return['Message'] = 'ลบข้อมูลสำเร็จ';
		}
		echo json_encode($return);
	}

	public function check_duplicate() {
		$this->load->model('Mail_Model');
		$value = $this->input->get('value');
		$action = $this->input->get('action');
		if ($action == 'new') {
			$data = $this->Mail_Model->getByMail($value);
		}
		else{
			$data = $this->Mail_Model->getByMail($value);
			echo count($data) > 1 ? 'false' : 'true';
			return;
		}
		echo count($data) > 0 ? 'false' : 'true';
	}

	public function mail()
	{
		header('Content-Type: application/json');
		$this->load->model('Mail_Model');
		$id = $this->input->get('id');
		$data = $this->Mail_Model->mail($id);

		$data['mail_password'] = $this->encryption->decrypt($data['mail_password']);

		echo json_encode($data);
	}

	public function histories()
	{
		header('Content-Type: application/json');
		$this->load->model('mailHistory_Model');
		$this->db->where('mail_sender_host', 'chon.go.th');
		$data['sents'] = $this->mailHistory_Model->getAll();

		$this->db->where('mail_to_host', 'chon.go.th');
		$data['receives'] = $this->mailHistory_Model->getAll();

		echo json_encode($data);
	}

	public function send_list()
	{
		header('Content-Type: application/json');
		$this->load->model('mailHistory_Model');
		$this->db->where('mail_sender_host', 'chon.go.th');
		$this->db->where('status', '1');
		$data['success_list'] = $this->mailHistory_Model->getAll();

		$this->db->where('mail_sender_host', 'chon.go.th');
		$this->db->where('status', '0');
		$data['fail_list'] = $this->mailHistory_Model->getAll();

		echo json_encode($data);
	}

	public function top_list()
	{
		header('Content-Type: application/json');
		$month = $this->input->get('month');
		$year = $this->input->get('year');
		$this->load->model('mailHistory_Model');
		$this->db->where('mail_sender_host', 'chon.go.th');
		$all = count($this->mailHistory_Model->getAllByDate($month, $year));
		$this->db->where('mail_sender_host', 'chon.go.th');
		$data['sents'] = $this->mailHistory_Model->getTop($month, $year);

		foreach ($data['sents'] as &$value) {
			$value['percent'] = ($value['sented'] / $all) * 100;
			$value['percent'] = number_format($value['percent'], 2, '.', '').'%';
		}

		$this->db->where('mail_to_host', 'chon.go.th');
		$all = count($this->mailHistory_Model->getAllByDate($month, $year));
		$this->db->where('mail_to_host', 'chon.go.th');
		$data['receives'] = $this->mailHistory_Model->getTopReceive($month, $year);

		foreach ($data['receives'] as &$value) {
			$value['percent'] = ($value['sented'] / $all) * 100;
			$value['percent'] = number_format($value['percent'], 2, '.', '').'%';
		}

		echo json_encode($data);
	}
}

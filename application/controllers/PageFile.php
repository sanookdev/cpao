<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PageFile extends CI_Controller
{
	private $user_online = 0;
	private $stat_today = 0;
	private $stat_yesterday = 0;
	private $stat_month = 0;
	private $stat_prev_month = 0;
	private $stat_all = 0;
	private $menu = [];

	private $itemOnPage = 10;

	private $setting_web = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('online_users_mod');
		$this->load->model('setting_Model');
		$this->load->model('menu_Model');
		$this->user_online = $this->online_users_mod->get_count_session_data();
		$this->stat_today = $this->online_users_mod->get_today();
		$this->stat_yesterday = $this->online_users_mod->get_yesterday();
		$this->stat_month = $this->online_users_mod->get_this_month();
		$this->stat_prev_month = $this->online_users_mod->get_prev_month();
		$this->stat_all = $this->online_users_mod->get_all();
		$this->menu = $this->menu_Model->getHeadAll(false);
		$this->slide_menu = $this->menu_Model->getSlideAll(false);
		$setting_web = $this->setting_Model->getAll(false);
		foreach ($setting_web as $row) {
			if ($row['setting_group'] == 'general') {
				if ($row['is_show'] == 1) {
					$this->setting_web[$row['setting_name']] = $row['setting_value'];
				}
			} else if ($row['is_show'] == 1) {
				if (!isset($this->setting_web[$row['setting_name']])) {
					$this->setting_web[$row['setting_name']] = [];
				}
				$this->setting_web[$row['setting_name']][] = $row;
			}
		}
	}

	public function index($url = '', $file_id = '')
	{
		$url = urldecode($url);
		$this->load->model('page_Model');
		$this->load->model('menu_Model');
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$data = $this->setting_web;
		$data['menu'] = $this->menu;
		$data['slide_menu'] = $this->slide_menu;
		$data['user_online'] = $this->user_online;
		$data['stat_today'] = $this->stat_today;
		$data['stat_yesterday'] = $this->stat_yesterday;
		$data['stat_month'] = $this->stat_month;
		$data['stat_prev_month'] = $this->stat_prev_month;
		$data['stat_all'] = $this->stat_all;
		$data['setting_web'] = $this->setting_web;

		$data['file'] = $this->folderFile_Model->getByIdOne($file_id);
		$data['page'] = $this->menu_Model->getBy('menu_url', $url);
		$data['url'] = $url;
		if ($data['file'] && count($data['page']) > 0) {
			$data['page'] = $data['page'][0];
			$data['path'] = $this->folder_Model->path($data['file']['cat_id']);
			$data['cat'] = $this->folder_Model->getByIdOne($data['file']['cat_id']);
			$data['file']['date_added'] = $this->DateThai($data['file']['date_added']);
		} else {
			$data['heading'] = '404 Page Not Found';
			$data['message'] = '<p>The page you requested was not found.</p>';
			$this->load->view('errors/html/error_404', $data);
			return;
		}
		$data['page']['page_mod_date'] = $this->DateThai($data['page']['page_mod_date']);
		$this->load->view('page_file', $data);
	}

	function DateThai($strDate)
	{
		$strYear = date("Y", strtotime($strDate)) + 543;
		if ($strYear > 3000) {
			$strYear -= 543;
		}
		$strMonth = date("n", strtotime($strDate));
		$strDay = date("j", strtotime($strDate));
		$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		$strMonthThai = $strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	function DateTimeThai($strDate)
	{
		$strYear = date("Y", strtotime($strDate)) + 543;
		if ($strYear > 3000) {
			$strYear -= 543;
		}
		$strMonth = date("n", strtotime($strDate));
		$strDay = date("j", strtotime($strDate));
		$strHour = date("H", strtotime($strDate));
		$strMinute = date("i", strtotime($strDate));
		$strSeconds = date("s", strtotime($strDate));
		$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		$strMonthThai = $strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
}

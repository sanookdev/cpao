<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
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

	public function index($url = '', $cat_id = '', $page = 1, $alias = '')
	{
		// $this->output->cache(60);
		$url = urldecode($url);
		$this->load->model('page_Model');
		$this->load->model('menu_Model');
		$this->load->model('folder_Model');
		$data = $this->setting_web;
		$search = $this->input->get('q');
		$data['menu'] = $this->menu;
		$data['slide_menu'] = $this->slide_menu;
		$data['user_online'] = $this->user_online;
		$data['stat_today'] = $this->stat_today;
		$data['stat_yesterday'] = $this->stat_yesterday;
		$data['stat_month'] = $this->stat_month;
		$data['stat_prev_month'] = $this->stat_prev_month;
		$data['stat_all'] = $this->stat_all;
		$data['setting_web'] = $this->setting_web;

		$data['page'] = $this->menu_Model->getPageBy('menu_url', $url, false, false, false);
		$data['url'] = $url;
		if (count($data['page']) > 0) {
			$data['page'] = $data['page'][0];
			if ($data['page']['page_type'] == 'folder') {
				if ($cat_id == '') {
					$cat_id = $data['page']['page_detail'];
				}
				$data['path'] = $this->folder_Model->path($cat_id, true, true);
				$data['folder'] = $this->load_folder($page, $search, $cat_id);
				$data['total_page'] = $this->folder_Model->count($cat_id, true);
				$data['total_page'] += $this->folderFile_Model->count($cat_id, true);
				$data['total_page'] =  ceil($data['total_page'] / $this->itemOnPage);
			}
		} else {
			$data['heading'] = '404 Page Not Found';
			$data['message'] = '<p>The page you requested was not found.</p>';
			$this->load->view('errors/html/error_404', $data);
			return;
		}

		$data['itemOnPage'] = $this->itemOnPage;
		$data['pagination'] = $page;
		$data['cat_id'] = $cat_id;
		$data['alias'] = $alias;

		$data['page']['page_mod_date'] = $this->DateThai($data['page']['page_mod_date']);
		$this->load->view('page', $data);
	}

	function load_folder($init_page = 1, $search = null, $parent = null)
	{
		$this->load->model('folder_Model');
		$this->load->model('folderFile_Model');
		$itemOnPage = $this->itemOnPage;
		$page = ($init_page - 1) * $itemOnPage;
		$list = $this->folder_Model->getCatByPublished('cat_title', $search, $parent, $page, $itemOnPage);
		$files =  $this->folderFile_Model->getFileByPublished('file_title', $search, $parent, $page, $itemOnPage);
		foreach($list as &$row) {
			$row['cat_alias'] = str_replace(array( '(', ')' ), '', $row['cat_alias']);
		}
		foreach($files as &$row) {
			$row['date_added'] = $this->DateThai($row['date_added']);
		}
		$result = array_merge($list, $files);
		return $result;
	}

	function DateThai($strDate)
	{
		$strYear = date("Y", strtotime($strDate)) + 543;
		$strMonth = date("n", strtotime($strDate));
		$strDay = date("j", strtotime($strDate));
		$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		$strMonthThai = $strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	function DateTimeThai($strDate)
	{
		$strYear = date("Y", strtotime($strDate)) + 543;
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intro extends CI_Controller
{
    private $setting_web = [];
    private $special = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_Model');
        $setting_web = $this->setting_Model->getAll();
        $this->special = $this->setting_Model->getSpecial();
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

    public function index()
    {
        if ($this->special == null) {
            $this->load->model('online_users_mod');
            $this->load->model('setting_Model');
            $this->load->model('menu_Model');
            $this->load->model('news_Model');
            $this->load->model('categoryNews_Model');
            $this->load->model('attachment_Model');
            $this->user_online = $this->online_users_mod->get_count_session_data();
            $this->stat_today = $this->online_users_mod->get_today();
            $this->stat_yesterday = $this->online_users_mod->get_yesterday();
            $this->stat_month = $this->online_users_mod->get_this_month();
            $this->stat_prev_month = $this->online_users_mod->get_prev_month();
            $this->stat_all = $this->online_users_mod->get_all();
            $this->menu = $this->menu_Model->getHeadAll(false);
		    $this->slide_menu = $this->menu_Model->getSlideAll(false);

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

            $data['cate'] = $this->categoryNews_Model->where('is_show = 1 AND is_lock = 0');
            foreach($data['cate'] as &$row) {
                $row['itemOnPage'] = 6;
                $row['list'] = $this->news_Model->getAllLimit($row['category_id'], 0, $row['itemOnPage']);
                $row['count'] = ceil($this->news_Model->getCount($row['category_id'])['total'] / $row['itemOnPage']);
                foreach($row['list'] as &$news) {
                    $news['attachment'] = $this->attachment_Model->getBy('news_id', $news['news_id']);
                }
            }
            
            $this->load->view('home', $data);
            return;
        }
        $data['special'] = $this->special;
        $this->load->view('intro', $data);
    }
}

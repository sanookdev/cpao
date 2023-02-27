<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['news_id']);
        if (count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $this->db->insert('news', $data);
            return $this->db->insert_id();
        } else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $this->update($data);
            return $data['news_id'];
        }
    }

    public function join_cate($where)
    {
        $this->db->select('menu.*, page.page_detail');
        $this->db->join('category_news cate', "cate.category_id=news.category_id");
        if ($where != '') {
            $this->db->where($where, NULL, false);
        }
        $this->db->where('news.is_delete', 0);
        $this->db->where('cate.is_delete', 0);
        $this->db->order_by("public_date", "desc");
        $res = $this->db->get('news');
        return $res->result_array();
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('news.news_id', $data['news_id']);
        return $this->db->update('news', $data);
    }

    public function crementView($id)
    {
        $this->db->where('news_id', $id);
        $this->db->set('views', 'views+1', FALSE);
        $this->db->update('news');
    }

    public function show($by, $is_show, $news_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_show'] = $is_show;
        $this->db->where('news.news_id', $news_id);
        return $this->db->update('news', $data);
    }

    public function remove($by, $news_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $this->db->where('news.news_id', $news_id);
        return $this->db->update('news', $data);
    }

    public function news($id)
    {
        $this->db->cache_off();
        $this->db->select('`news_id`, `category_id`, `news_title`, `news_detail`, `news_cover`, 
                        `is_delete`, `is_show`, `views`, `mod_date`, `mod_user`, news_type,
                        DATE_FORMAT(`public_date`, "%d/%m/%Y") as `public_date`');
        $this->db->where('news.news_id', $id);
        $res = $this->db->get('news');
        return $res->row_array();
    }

    public function getByID($id)
    {
        $this->db->cache_off();
        $this->db->where('news.news_id', $id);
        $res = $this->db->get('news');
        return $res->result_array();
    }

    public function getBy($by, $value)
    {
        $this->db->cache_off();
        $this->db->select('news.*, user.nick, cate.category_name, cate.category_url');
        $this->db->join('category_news cate', 'cate.category_id = news.category_id');
        $this->db->join('user', 'user.user_id = news.mod_user');
        $this->db->where('news.' . $by, $value);
        $this->db->where('news.is_delete', 0);
        $res = $this->db->get('news');
        return $res->result_array();
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->cache_off();
        $this->db->where('news.' . $by, $value);
        $this->db->where('news.news_id !=', $id, FALSE);
        $this->db->where('news.is_delete', 0);
        $res = $this->db->get('news');
        return $res->result_array();
    }

    public function getAllLimit($category_id, $start, $limit, $search = '')
    {
        $this->db->cache_off();
        $this->db->select('`news_id`, `category_id`, IF(news_type = "link", news_detail, "") as news_detail, `news_title`, `news_cover`, `news_url`,
                        news.`is_delete`, `is_show`, `views`, news.`mod_date`, news.`mod_user`, news_type,
                        DATE_FORMAT(`public_date`, "%d/%m/%Y") as `public_date_2`,
                        DATE_FORMAT(`public_date`, "%Y-%m-%d") as `public_date`, user.nick, user.username');
        $this->db->where('news.category_id', $category_id);
        if ($search) {
            $this->db->like("REPLACE(news.news_title, ' ', '')", str_replace(' ', '',$search));
        }
        $this->db->where('news.is_delete', 0);
        $this->db->where('news.is_show', 1);
        $this->db->where('news.public_date <= now()', NULL, false);
        $this->db->join('user', 'user.user_id = news.mod_user');
        $this->db->order_by("public_date", "desc");
        $this->db->order_by("mod_date", "desc");
        $this->db->limit($limit, $start);
        $res = $this->db->get('news');
        return $res->result_array();
    }

    public function getNext($category_id, $id)
    {
        $this->db->cache_off();
        $this->db->select('`news_id`, `category_id`, `news_title`, `news_cover`, `news_url`,
                        `is_delete`, `is_show`, `views`, `mod_date`, `mod_user`, 
                        DATE_FORMAT(`public_date`, "%Y-%m-%d") as `public_date`');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.is_delete', 0);
        $this->db->where('news.is_show', 1);
        $this->db->where('news.public_date <= now()', NULL, false);
        $this->db->where("news.public_date >= (select public_date from news s where s.news_id = $id)", NULL, false);
        $this->db->order_by("public_date", "desc");
        $this->db->order_by("mod_date", "desc");
        $res = $this->db->get('news')->result_array();
        $next = null;
        foreach($res as $row) {
            if ($row['news_id'] == $id) {
                return $next;
            }
            $next = $row;
        }
        return $next;
    }

    public function getPrev($category_id, $id)
    {
        $this->db->cache_off();
        $this->db->select('`news_id`, `category_id`, `news_title`, `news_cover`, `news_url`,
                        `is_delete`, `is_show`, `views`, `mod_date`, `mod_user`, 
                        DATE_FORMAT(`public_date`, "%Y-%m-%d") as `public_date`');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.is_delete', 0);
        $this->db->where('news.is_show', 1);
        $this->db->where('news.public_date <= now()', NULL, false);
        $this->db->where("news.public_date <= (select public_date from news s where s.news_id = $id)", NULL, false);
        $this->db->order_by("public_date", "desc");
        $this->db->order_by("mod_date", "desc");
        $res = $this->db->get('news')->result_array();
        $prev = null;
        $is_found = false;
        foreach($res as $row) {
            $prev = $row;
            if (!$is_found && $row['news_id'] == $id) {
                $is_found = true;
            }
            else if ($is_found) {
                return $prev;
            }
        }
        return $prev;
    }

    public function getCount($category_id, $search = '')
    {
        $this->db->cache_off();
        $this->db->select('COUNT(*) as total');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.public_date <= now()', NULL, false);
        $this->db->where('news.is_delete', 0);
        if ($search) {
            $this->db->like("REPLACE(news.news_title, ' ', '')", str_replace(' ', '',$search));
        }
        $this->db->order_by("public_date", "desc");
        $res = $this->db->get('news');
        return $res->row_array();
    }

    public function getAll($category_id, $year, $month)
    {
        $this->db->cache_off();
        $this->db->select('`news_id`, `category_id`, `news_title`, `news_cover`, `news_url`,
                        `is_delete`, `is_show`, `views`, `mod_date`, `mod_user`,  news_type,
                        DATE_FORMAT(`public_date`, "%Y-%m-%d") as `public_date`');
        $this->db->where('news.category_id', $category_id);
        if ($year) {
            $this->db->where('YEAR(public_date)', $year);
        }
        if ($month) {
            $this->db->where('MONTH(public_date)', $month);
        }
        $this->db->where('news.is_delete', 0);
        $this->db->order_by("public_date", "desc");
        $this->db->order_by("mod_date", "desc");
        $res = $this->db->get('news');
        return $res->result_array();
    }
}

/* End of file News_Model.php */

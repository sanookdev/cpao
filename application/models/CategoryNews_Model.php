<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CategoryNews_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['category_id']);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $data['category_no'] = $this->getMaxNo() + 1;
            return $this->db->insert('category_news', $data);
        }
        else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            return $this->update($data);
        }
    }

    public function update_number($from, $to) {
        $val = ' - 1';
        if ($from > $to) {
            $tmp = $from;
            $from = $to;
            $to = $tmp;
            $val = ' + 1';
        }
        if ($from == '0')
            return true;
        $sql = "UPDATE category_news set category_no = category_no $val WHERE category_news.category_no BETWEEN  $from AND $to"; 
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('category_news.category_id', $data['category_id']);
        return $this->db->update('category_news', $data);
    }

    public function show($by, $is_show, $category_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_show'] = $is_show;
        $this->db->where('category_news.category_id', $category_id);
        return $this->db->update('category_news', $data);
    }

    public function remove($by, $category_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $this->db->where('category_news.category_id', $category_id);
        return $this->db->update('category_news', $data);
    }

    public function category_news($id)
    {
        $this->db->where('category_news.category_id', $id);
        $res = $this->db->get('category_news');
        return $res->row_array(); 
    }

    public function getByID($id)
    {
        $this->db->where('category_news.category_id', $id);
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    public function getBy($by, $value)
    {
        $this->db->cache_off();
        $this->db->where('category_news.'.$by, $value);
        $this->db->where('category_news.is_delete', 0);
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->where('category_news.'.$by, $value);
        $this->db->where('category_news.category_id !=', $id, FALSE);
        $this->db->where('category_news.is_delete', 0);
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    
    public function getMaxNo()
    {
        $this->db->select_max('category_no');
        $this->db->where('category_news.is_delete', 0);
        $res = $this->db->get('category_news')->row_array();
        if ($res) {
            return $res['category_no'];
        }
        return 0;
    }

    public function where($where)
    {
        $this->db->where($where, NULL, false);
        $this->db->where('category_news.is_delete', 0);
        $this->db->order_by("category_no", "asc");
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    public function getRssAll()
    {
        $this->db->cache_off();
        $this->db->where('category_news.is_show', 0);
        $this->db->where('category_news.is_delete', 0);
        $this->db->order_by("category_no", "asc");
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    public function getNewsAll()
    {
        $this->db->cache_off();
        $this->db->where('category_news.is_show', 1);
        $this->db->where('category_news.is_delete', 0);
        $this->db->order_by("category_no", "asc");
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

    public function getAll()
    {
        $this->db->cache_off();
        $this->db->where('category_news.is_delete', 0);
        $this->db->order_by("category_no", "asc");
        $res = $this->db->get('category_news');
        return $res->result_array(); 
    }

}

/* End of file Category_news_Model.php */

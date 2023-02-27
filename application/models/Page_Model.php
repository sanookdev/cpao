<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['page_id']);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['create_date'] = $now;
            $this->db->insert('page', $data);
            return $this->db->insert_id();
        }
        else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $this->update($data);
            return $data['page_id'];
        }
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('page.page_id', $data['page_id']);
        return $this->db->update('page', $data);
    }

    public function show($by, $is_show, $page_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_show'] = $is_show;
        $this->db->where('page.page_id', $page_id);
        return $this->db->update('page', $data);
    }

    public function remove($by, $page_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $this->db->where('page.page_id', $page_id);
        return $this->db->update('page', $data);
    }

    public function page($id)
    {
        $this->db->select("page.*, IF(menu.parent_id IS NULL, '', menu.menu_id) as menu_id, 
                         IF(menu.parent_id IS NULL, menu.menu_id, menu.parent_id) as parent_id");
        $this->db->where('page.page_id', $id);
        $this->db->join('menu', 'menu.page_id=page.page_id', 'left');
        $this->db->order_by("create_date", "desc");
        $res = $this->db->get('page');
        return $res->row_array(); 
    }

    public function getByID($id)
    {
        $this->db->where('page.page_id', $id);
        $this->db->order_by("create_date", "desc");
        $res = $this->db->get('page');
        return $res->result_array(); 
    }

    public function getBy($by, $value)
    {
        $this->db->where('page.'.$by, $value);
        $this->db->where('page.is_delete', 0);
        $this->db->order_by("create_date", "desc");
        $res = $this->db->get('page');
        return $res->result_array(); 
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->where('page.'.$by, $value);
        $this->db->where('page.page_id !=', $id, FALSE);
        $this->db->where('page.is_delete', 0);
        $this->db->order_by("create_date", "desc");
        $res = $this->db->get('page');
        return $res->result_array(); 
    }

    public function getList()
    {
        $this->db->select("page.*, IF(menu.parent_id IS NULL, '', menu.menu_id) as menu_id, 
                        IF(menu.parent_id IS NULL, '', menu.menu_title) as menu_title, 
                        IF(menu.parent_id IS NULL, menu.menu_id, menu.parent_id) as parent_id, 
                        IF(menu.parent_id IS NULL, menu.menu_title, p.menu_title) as parent_menu_title");
        $this->db->join('menu', 'menu.page_id=page.page_id', 'left');
        $this->db->join('menu p', 'p.menu_id=menu.parent_id', 'left');
        $this->db->where('page.is_delete', 0);
        $this->db->order_by("p.menu_no", "asc");
        $this->db->order_by("menu.menu_no", "asc");
        $res = $this->db->get('page');
        return $res->result_array(); 
    }

    public function getAll()
    {
        $this->db->select("page.*");
        $this->db->join('menu', 'menu.page_id=page.page_id', 'left');
        $this->db->where('page.is_delete', 0);
        $this->db->order_by("menu.menu_no", "asc");
        $res = $this->db->get('page');
        return $res->result_array(); 
    }

}

/* End of file page_Model.php */

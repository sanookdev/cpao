<?php

defined('BASEPATH') or exit('No direct script access allowed');

class File_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['menu_id']);
        if (isset($data['page_id']) && $data['page_id'] == '') {
            $data['page_id'] = null;
        }
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            if (isset($data['parent_id'])) {
                $data['menu_no'] = $this->getMaxNo('parent_id', $data['parent_id']) + 1;
            }
            else {
                $data['menu_no'] = $this->getMaxNoParent() + 1;
            }
            return $this->db->insert('menu', $data);
        }
        else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            return $this->update($data);
        }
    }

    public function update_number($from, $to, $parent_id=NULL) {
        $val = ' - 1';
        if ($from > $to) {
            $tmp = $from;
            $from = $to;
            $to = $tmp;
            $val = ' + 1';
        }
        if ($from == '0')
            return true;
        $sql = "UPDATE menu set menu_no = menu_no $val WHERE menu.menu_no BETWEEN  $from AND $to "; 
        if ($parent_id) {
            $sql .= " AND menu.parent_id = $parent_id";
        }
        else {
            $sql .= " AND menu.parent_id IS NULL";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('menu.menu_id', $data['menu_id']);
        return $this->db->update('menu', $data);
    }

    public function show($by, $is_show, $menu_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_show'] = $is_show;
        $this->db->where('menu.menu_id', $menu_id);
        return $this->db->update('menu', $data);
    }

    public function remove($by, $menu_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $item = $this->menu($menu_id);
        $max = $this->getMaxNo('parent_id', $item['parent_id']);
        $this->update_number($item['menu_no'], $max, $item['parent_id']);
        $this->db->where('menu.menu_id', $menu_id);
        return $this->db->update('menu', $data);
    }

    public function menu($id)
    {
        $this->db->select('menu.*, p.parent_id as parent_parent_id, p.menu_title as parent_menu_title, 
            (select count(*) from menu s where s.parent_id = menu.menu_id) as count_child');
        $this->db->join('menu p', 'p.menu_id=menu.parent_id', 'left');
        $this->db->where('menu.menu_id', $id);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->row_array(); 
    }

    public function getByID($id)
    {
        $this->db->where('menu.menu_id', $id);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function getSubmenu($parent_id)
    {
        $this->db->where('menu.is_delete', 0);
        $this->db->where('menu.parent_id IN (select menu_id from menu sub where parent_id is null)', NULL, FALSE);
        $this->db->where('menu.page_id IS NULL', NULL, FALSE);
        if ($parent_id) {
            $this->db->where('menu.parent_id', $parent_id);
        } else {
            $this->db->where('menu.parent_id IS NOT NULL', NULL, FALSE);
        }
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array();
    }

    public function getSubmenu2($by=null, $value=null)
    {
        $this->db->select('menu.*, p.menu_title as parent_menu_title');
        $this->db->join('menu p', 'p.menu_id=menu.parent_id', 'left');
        $this->db->where('menu.is_delete', 0);
        $this->db->where('menu.parent_id IN 
            (select menu_id from menu sub 
            where sub.parent_id IS NOT NULL 
            AND sub.page_id IS NULL
            AND sub.is_delete = 0)', NULL, FALSE);
        $this->db->where('menu.parent_id IS NOT NULL', NULL, FALSE);
        $this->db->where('menu.page_id IS NULL', NULL, FALSE);
        if ($by) {
            $this->db->where('menu.'.$by, $value);
        }
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function getSubmenu2NotId($by=null, $value=null, $id)
    {
        $this->db->select('menu.*, p.menu_title as parent_menu_title');
        $this->db->join('menu p', 'p.menu_id=menu.parent_id', 'left');
        $this->db->where('menu.is_delete', 0);
        $this->db->where('menu.parent_id IN 
            (select menu_id from menu sub 
            where sub.parent_id IS NOT NULL 
            AND sub.page_id IS NULL
            AND sub.is_delete = 0)', NULL, FALSE);
        $this->db->where('menu.parent_id IS NOT NULL', NULL, FALSE);
        $this->db->where('menu.page_id IS NULL', NULL, FALSE);
        $this->db->where('menu.menu_id !=', $id, FALSE);
        if ($by) {
            $this->db->where('menu.'.$by, $value);
        }
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function where($where) 
    {
        $this->db->select('menu.*, page.page_detail');
        $this->db->join('page', "page.page_id=menu.page_id AND page.page_type = 'link' AND page.is_show = 1 AND page.is_delete = 0", 'left');
        $this->db->where($where, NULL, false);
        $this->db->where('menu.is_delete', 0);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function getBy($by, $value, $parent_not_null = false, $page_is_null = false)
    {
        $this->db->select('menu.*, page.page_title, page.page_detail, page.page_type, page.mod_date as page_mod_date');
        $this->db->where('menu.'.$by, $value);
        $this->db->where('menu.is_delete', 0);
        if ($parent_not_null) {
            $this->db->where('menu.parent_id IS NOT NULL', NULL, FALSE);
        }
        if ($page_is_null) { 
            
            $this->db->where('menu.page_id IS NULL', NULL, FALSE);
        }
        $this->db->join('page', "page.page_id=menu.page_id AND page.is_show = 1 AND page.is_delete = 0", 'left');
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function getByNotId($by, $value, $id, $parent_not_null = false)
    {
        $this->db->where('menu.'.$by, $value);
        $this->db->where('menu.menu_id !=', $id, FALSE);
        $this->db->where('menu.is_delete', 0);
        if ($parent_not_null) {
            $this->db->where('menu.parent_id IS NOT NULL', NULL, FALSE);
        }
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    
    public function getMaxNo($by='', $value='')
    {
        $this->db->select_max('menu_no');
        $this->db->where('menu.is_delete', 0);
        if ($by != '') {
            $this->db->where('menu.'.$by, $value);
        }
        $res = $this->db->get('menu')->row_array();
        if ($res) {
            return $res['menu_no'];
        }
        return 0;
    }

    public function getMaxNoParent($by='', $value='')
    {
        $this->db->select_max('menu_no');
        $this->db->where('menu.is_delete', 0);
        $this->db->where('menu.parent_id IS NULL', NULL, false);
        if ($by != '') {
            $this->db->where('menu.'.$by, $value);
        }
        $res = $this->db->get('menu')->row_array();
        if ($res) {
            return $res['menu_no'];
        }
        return 0;
    }

    public function getParentAll()
    {
        $this->db->select("menu.*, (select count(*) from menu s where s.parent_id = menu.menu_id) as count_child");
        $this->db->where('menu.is_delete', 0);
        $this->db->where('parent_id', NULL);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

    public function getHeadAll()
    {
        $this->db->select('menu.*, page.page_detail');
        $this->db->where('menu.is_show', 1);
        $this->db->where('menu.is_head', 1);
        $this->db->where('menu.is_delete', 0);
        $this->db->join('page', "page.page_id=menu.page_id AND page.page_type = 'link' AND page.is_show = 1 AND page.is_delete = 0", 'left');
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        $list = $res->result_array(); 
        foreach($list as &$row) {
            $row['client'] = $this->where("menu.is_show = 1 AND parent_id = ".$row['menu_id']);
        }
        return $list;
    }

    public function getSlideAll()
    {
        $this->db->where('menu.is_show', 1);
        $this->db->where('menu.is_head', 0);
        $this->db->where('menu.is_delete', 0);
        $this->db->where('menu.parent_id IS NULL', NULL, false);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        $list = $res->result_array(); 
        foreach($list as &$row) {
            $row['client'] = $this->where("menu.is_show = 1 AND parent_id = ".$row['menu_id']);
        }
        return $list;
    }

    public function getAll()
    {
        $this->db->where('menu.is_delete', 0);
        $this->db->order_by("menu_no", "asc");
        $res = $this->db->get('menu');
        return $res->result_array(); 
    }

}

/* End of file menu_Model.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['setting_id']);
        if (count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $this->db->insert('setting_web', $data);
            return $this->db->insert_id();
        } else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            $this->update($data);
            return $data['setting_id'];
        }
    }

    public function update_number($name, $from, $to)
    {
        $val = ' - 1';
        if ($from > $to) {
            $tmp = $from;
            $from = $to;
            $to = $tmp;
            $val = ' + 1';
        }
        if ($from == '0')
            return true;
        $sql = "UPDATE setting_web set setting_no = setting_no $val WHERE setting_name = '$name' AND setting_web.setting_no BETWEEN  $from AND $to";
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('setting_web.setting_id', $data['setting_id']);
        return $this->db->update('setting_web', $data);
    }

    public function show($by, $is_show, $setting_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_show'] = $is_show;
        $this->db->where('setting_web.setting_id', $setting_id);
        return $this->db->update('setting_web', $data);
    }

    public function remove($by, $setting_id)
    {
        $item = $this->setting_web($setting_id);
        $max = $this->getMaxNo('setting_name', $item['setting_name']);
        $this->update_number($item['setting_name'], $item['setting_no'], $max);

        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $this->db->where('setting_web.setting_id', $setting_id);
        return $this->db->update('setting_web', $data);
    }

    public function setting_web($id)
    {
        $this->db->cache_off();
        $this->db->where('setting_web.setting_id', $id);
        $res = $this->db->get('setting_web');
        return $res->row_array();
    }

    public function getByID($id)
    {
        $this->db->cache_off();
        $this->db->where('setting_web.setting_id', $id);
        $res = $this->db->get('setting_web');
        return $res->result_array();
    }

    public function getBy($by, $value)
    {
        $this->db->cache_off();
        $this->db->where('setting_web.' . $by, $value);
        $this->db->where('setting_web.is_delete', 0);
        $this->db->order_by("setting_no", "asc");
        $res = $this->db->get('setting_web');
        return $res->result_array();
    }

    public function getByAndOrder($by, $value, $order)
    {
        $this->db->cache_off();
        $this->db->where('setting_web.' . $by, $value);
        $this->db->where('setting_web.is_delete', 0);
        $this->db->order_by($order, "desc");
        $res = $this->db->get('setting_web');
        return $res->result_array();
    }

    public function getMaxNo($by, $value)
    {
        $this->db->cache_off();
        $this->db->select_max('setting_no');
        $this->db->where('setting_web.is_delete', 0);
        $this->db->where($by, $value);
        $res = $this->db->get('setting_web')->row_array();
        if ($res) {
            return $res['setting_no'];
        }
        return 0;
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->cache_off();
        $this->db->where('setting_web.' . $by, $value);
        $this->db->where('setting_web.setting_id !=', $id, FALSE);
        $this->db->where('setting_web.is_delete', 0);
        $res = $this->db->get('setting_web');
        return $res->result_array();
    }

    public function getSpecial()
    {
        $this->db->cache_off();
        $this->db->where('setting_web.is_delete', 0);
        $this->db->where('setting_web.is_show', 1);
        $this->db->where('setting_web.setting_name', 'special');
        $this->db->where('setting_web.setting_value3 <= now()', NULL, false);
        $this->db->order_by("setting_value3", "desc");
        $res = $this->db->get('setting_web');
        return $res->row_array();
    }

    public function getAll($is_cache = false, $is_flush = false)
    {
        if (!$is_flush) {
            if ($is_cache) {
                $this->db->cache_on();
            } else {
                $this->db->cache_off();
            }
        }
        if ($is_flush) {
            $this->db->cache_on();
            $this->db->start_cache();
        }
        $this->db->where('setting_web.is_delete', 0);
        $this->db->order_by("setting_name", "asc");
        $this->db->order_by("setting_no", "asc");
        $res = $this->db->get('setting_web');
        $array = $res->result_array();
        if ($is_flush) {
            $this->db->stop_cache();
            $this->db->flush_cache();
        }
        return $array;
    }
}

/* End of file setting_web_Model.php */

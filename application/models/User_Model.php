<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{

    public function save($data)
    {
        $select = $this->getByID($data['user_id']);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            if ($this->db->insert('user', $data)) {
                return $this->db->insert_id();
            }
            else {
                return 0;
            }
        }
        else {
            $now = date("Y-m-d H:i:s");
            $data['mod_date'] = $now;
            if($this->update($data)) {
                return $data['user_id'];
            }
            else {
                return 0;
            }
        }
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_date'] = $now;
        $this->db->where('user.user_id', $data['user_id']);
        return $this->db->update('user', $data);
    }

    public function remove($by, $user_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['mod_user'] = $by;
        $data['mod_date'] = $now;
        $data['is_delete'] = 1;
        $this->db->where('user.user_id', $user_id);
        return $this->db->update('user', $data);
    }

    public function user($id)
    {
        $this->db->select('`user_id`, `username`, `password`, `nick`, `email`, `fname`, `lname`, card_id,
                            `profile_image`, `gender`, DATE_FORMAT(`birthday`, "%d/%m/%Y") as birthday, `province`, `amphoe`, 
                            `district`, `address`, `is_admin`, `is_lock`');
        $this->db->where('user.user_id', $id);
        $res = $this->db->get('user');
        return $res->row_array(); 
    }

    public function getByID($id)
    {
        $this->db->where('user.user_id', $id);
        $res = $this->db->get('user');
        return $res->result_array(); 
    }

    public function getBy($by, $username)
    {
        $this->db->where('user.'.$by, $username);
        $this->db->where('user.is_delete', 0);
        $res = $this->db->get('user');
        return $res->result_array(); 
    }

    public function getByNotId($by, $username, $id)
    {
        $this->db->where('user.'.$by, $username);
        $this->db->where('user.user_id !=', $id, FALSE);
        $this->db->where('user.is_delete', 0);
        $res = $this->db->get('user');
        return $res->result_array(); 
    }

    public function getAll()
    {
        $this->db->select('`user_id`, `username`, `nick`, `email`, `fname`, `lname`, card_id,
                            `profile_image`, `gender`, `birthday`, `province`, `amphoe`, 
                            `district`, `address`, `zipcode`, `is_admin`, `is_lock`');
        $this->db->where('user.is_delete', 0);
        $res = $this->db->get('user');
        return $res->result_array(); 
    }

}

/* End of file User_Model.php */

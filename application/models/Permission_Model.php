<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permission_Model extends CI_Model
{

    public function getAll() {
        $this->db->order_by('pem_no');
        $res = $this->db->get('permission');
        return $res->result_array(); 
    }

    public function getUser($user_id) {
        $this->db->select('user_permission.*, pem.name, pem.title');
        $this->db->where('user_id', $user_id);
        $this->db->join('permission pem', 'pem.pem_id = user_permission.pem_id');
        $res = $this->db->get('user_permission');
        return $res->result_array();
    }

    public function resetUser($user_id) {
        $data = [
            'is_active' => 0
        ];
        $this->db->where('user_id', $user_id);
        $this->db->update('user_permission', $data);
    }

    public function save($user_id, $pem_id, $active) {
        $data = [
            'user_id' => $user_id,
            'pem_id' => $pem_id,
            'is_active' => $active,
        ];
        $select = $this->getBy($user_id, $pem_id);
        if(count($select) == 0) {
            //
            $this->db->insert('user_permission', $data);
            return $this->db->insert_id();
        }
        else {
            $this->db->where('user_id', $data['user_id']);
            $this->db->where('pem_id', $data['pem_id']);
            return $this->db->update('user_permission', $data);
        }
    }

    public function getBy($user_id, $pem_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('pem_id', $pem_id);
        $res = $this->db->get('user_permission');
        return $res->result_array(); 
    }

}

/* End of file attachment_Model.php */

<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Login_Model extends CI_Model

{

    public function login($data)

    {

        $this->db->where('user.username', $data['username']);

        // $this->db->where('user.is_delete', 0);

        $res = $this->db->get('user');

     
        $result = $res->result(); 
        foreach($result as $row) {
            if ($row->password != '' && $this->encryption->decrypt($row->password) == $data['password']) {

                return [$row];

            }

        }

        return [];

    }



    public function getBy($by, $value)

    {

        $this->db->where("user.$by", $value);

        $res = $this->db->get('user');

        return $res->row_array();

    }



    public function adminlogin($data)

    {

        $this->db->where('user.username', $data['username']);

        $this->db->where('user.is_admin', 1);

        $this->db->where('user.is_delete', 0);

        $res = $this->db->get('user');

        $result = $res->result(); 

        foreach($result as $row) {

            if ($row->password != '' && $this->encryption->decrypt($row->password) == $data['password']) {

                return [$row];

            }

        }

        return [];

    }



}



/* End of file Login_Model.php */
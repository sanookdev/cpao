<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mail_Model extends CI_Model
{

    public function save($data, $old = '')
    {
        if ($old == '') {
            $select = $this->getByMail($data['mail']);
        }
        else {
            $select = $this->getByMail($old);
        }
        if(count($select) == 0) {
            //
            if ($this->db->insert('mail_account', $data)) {
                return $data['mail'];
            }
            else {
                return 0;
            }
        }
        else {
            if($this->update($data, $old)) {
                return $data['mail'];
            }
            else {
                return 0;
            }
        }
    }

    public function update($data, $old = '')
    {
        if ($old != '') {
            $this->db->where('mail_account.mail', $old);
        }
        else {
            $this->db->where('mail_account.mail', $data['mail']);
        }
        return $this->db->update('mail_account', $data);
    }

    public function remove($mail)
    {
        $this->db->where('mail_account.mail', $mail);
        return $this->db->delete('mail_account');
    }

    public function mail($mail)
    {
        $this->db->where('mail_account.mail', $mail);
        $res = $this->db->get('mail_account');
        return $res->row_array(); 
    }

    public function getByMail($mail)
    {
        $this->db->where('mail_account.mail', $mail);
        $res = $this->db->get('mail_account');
        return $res->result_array(); 
    }

    public function getAll()
    {
        $res = $this->db->get('mail_account');
        return $res->result_array(); 
    }

}

/* End of file Mail_Model.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MailHistory_Model extends CI_Model
{

    public function save($data)
    {
        $this->db->insert('mail_history', $data);
    }

    public function saveMailFail($data)
    {
        $timestamp = strtotime($data['mail_date']);
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        $day = date('d', $timestamp);
        $hour = date('H', $timestamp);
        $minute = date('i', $timestamp);
        $second = date('s', $timestamp);

        $this->db->order_by('mail_date', 'desc');
        $this->db->where('mail_sender', $data['mail_sender']);
        $this->db->where('mail_to', $data['mail_to']);
        $this->db->where('year(mail_date)', $year);
        $this->db->where('month(mail_date)', $month);
        $this->db->where('day(mail_date)', $day);
        $this->db->where('hour(mail_date)', $hour);
        $this->db->where('minute(mail_date)', $minute);
        $this->db->where('second(mail_date) >=', $second - 15);
        $this->db->where('second(mail_date) <=', $second);
        $res = $this->db->get('mail_history');
        $select = $res->row_array();
        if (!$select) {
            $this->db->insert('mail_history', $data);
        }
        else {
            $data['mail_date'] = $select['mail_date'];
            $this->db->where('mail_his_id', $select['mail_his_id']);
            $this->db->update('mail_history', $data);
        }
    }

    public function removeAll()
    {
        $this->db->truncate('mail_history');
    }

    public function getTop($month, $year)
    {
        $this->db->select('mail_sender, count(*) as sented');
        $this->db->order_by('sented', 'desc');
        $this->db->where('month(mail_date)', $month);
        $this->db->where('year(mail_date)', $year);
        $this->db->group_by('mail_sender');
        $res = $this->db->get('mail_history');
        return $res->result_array(); 
    }

    public function getTopReceive($month, $year)
    {
        $this->db->select('mail_to, count(*) as sented');
        $this->db->order_by('sented', 'desc');
        $this->db->where('month(mail_date)', $month);
        $this->db->where('year(mail_date)', $year);
        $this->db->group_by('mail_to');
        $res = $this->db->get('mail_history');
        return $res->result_array(); 
    }

    public function getAllByDate($month, $year)
    {
        $this->db->where('month(mail_date)', $month);
        $this->db->where('year(mail_date)', $year);
        $this->db->order_by('mail_date', 'desc');
        $res = $this->db->get('mail_history');
        return $res->result_array(); 
    }

    public function getAll()
    {
        $this->db->order_by('mail_date', 'desc');
        $res = $this->db->get('mail_history');
        return $res->result_array(); 
    }

}

/* End of file MailHistory_Model.php */

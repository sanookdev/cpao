<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Job_Model extends CI_Model
{

    public function save($data, $old = '')
    {
        if ($old == '') {
            $select = $this->getByName($data['job_name']);
        }
        else {
            $select = $this->getByName($old);
        }
        if(count($select) == 0) {
            //
            if ($this->db->insert('jobs', $data)) {
                return $data['job_name'];
            }
            else {
                return 0;
            }
        }
        else {
            if($this->update($data, $old)) {
                return $data['job_name'];
            }
            else {
                return 0;
            }
        }
    }

    public function update($data, $old = '')
    {
        if ($old != '') {
            $this->db->where('jobs.job_name', $old);
        }
        else {
            $this->db->where('jobs.job_name', $data['job_name']);
        }
        return $this->db->update('jobs', $data);
    }

    public function remove($name)
    {
        $this->db->where('jobs.job_name', $name);
        return $this->db->delete('jobs');
    }

    public function job($name)
    {
        $this->db->where('jobs.job_name', $name);
        $res = $this->db->get('jobs');
        return $res->row_array(); 
    }

    public function getByName($name)
    {
        $this->db->where('jobs.job_name', $name);
        $res = $this->db->get('jobs');
        return $res->result_array(); 
    }

}

/* End of file User_Model.php */

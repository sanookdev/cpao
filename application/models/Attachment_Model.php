<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Attachment_Model extends CI_Model
{

    public function save($by, $news_id, $name)
    {
        $select = $this->getBy('attach_path', $name);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['attach_path'] = $name;
            $data['news_id'] = $news_id;
            $data['mod_user'] = $by;
            $data['mod_date'] = $now;
            $this->db->insert('attachment', $data);
            return $this->db->insert_id();
        }
        else {
            return $select[0]['attach_id'];
        }
    }

    public function saveData($by, $news_id, $data)
    {
        $select = $this->getByWithId('attach_path', $data['attach_path'], $news_id);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['news_id'] = $news_id;
            $data['mod_user'] = $by;
            $data['mod_date'] = $now;
            $this->db->insert('attachment', $data);
            return $this->db->insert_id();
        }
        else {
            $this->db->where('attach_id', $select[0]['attach_id']);
            $this->db->update('attachment', $data);
            return $select[0]['attach_id'];
        }
    }

    public function delete($id) {
        $this->db->where('attachment.attach_id', $id);
        return $this->db->delete('attachment');
    }

    public function getBy($by, $value)
    {
        $this->db->select("`attach_id`, `news_id`, `attach_path`, `attach_title`, `attach_no`, `mod_date`, `mod_user`,
                            concat('/uploads/', attach_path) AS upload_attach_path");  
        $this->db->where('attachment.'.$by, $value);
        $this->db->order_by('attach_no', 'asc');
        $res = $this->db->get('attachment');
        return $res->result_array(); 
    }

    public function getByWithId($by, $value, $news_id)
    {
        $this->db->select("`attach_id`, `news_id`, `attach_path`, `attach_title`, `attach_no`, `mod_date`, `mod_user`,
                            concat('/uploads/', attach_path) AS upload_attach_path");  
        $this->db->where('attachment.'.$by, $value);
        $this->db->where('attachment.news_id', $news_id);
        $this->db->order_by('attach_no', 'asc');
        $res = $this->db->get('attachment');
        return $res->result_array(); 
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->select("`attach_id`, `news_id`, `attach_path`, `attach_title`, `attach_no`, `mod_date`, `mod_user`,
                            concat('/uploads/', attach_path) AS upload_attach_path");  
        $this->db->where('attachment.'.$by, $value);
        $this->db->where('attachment.attachment_id !=', $id, FALSE);
        $this->db->where('attachment.is_delete', 0);
        $res = $this->db->get('attachment');
        return $res->result_array(); 
    }

    public function getAll() {
        $this->db->select('news.news_id, news.news_title, attach_id, attach_title, attach_path');
        $this->db->order_by('news.category_id');
        $this->db->order_by('news.public_date', "desc");
        $this->db->order_by('news.mod_date', "desc");
        $this->db->join('news', 'news.news_id = attachment.news_id');
        $res = $this->db->get('attachment');
        return $res->result_array(); 
    }

}

/* End of file attachment_Model.php */

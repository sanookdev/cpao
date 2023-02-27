<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Images_Model extends CI_Model
{

    public function save($by, $news_id, $name)
    {
        $select = $this->getBy('image_path', $name);
        if(count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['image_path'] = $name;
            $data['news_id'] = $news_id;
            $data['mod_user'] = $by;
            $data['mod_date'] = $now;
            $this->db->insert('images', $data);
            return $this->db->insert_id();
        }
        else {
            return $select[0]['image_id'];
        }
    }

    public function delete($id) {
        $this->db->where('images.image_id', $id);
        return $this->db->delete('images');
    }

    public function getBy($by, $value)
    {
        $this->db->select("`image_id`, `news_id`, `image_path`, `mod_date`, `mod_user`,
                            concat('".base_url('/uploads/')."', image_path) AS upload_image_path");  
        $this->db->where('images.'.$by, $value);
        $res = $this->db->get('images');
        return $res->result_array(); 
    }

    public function getByNotId($by, $value, $id)
    {
        $this->db->select("`image_id`, `news_id`, `image_path`, `mod_date`, `mod_user`,
                            concat('".base_url('/uploads/')."', image_path) AS upload_image_path");  
        $this->db->where('images.'.$by, $value);
        $this->db->where('images.images_id !=', $id, FALSE);
        $this->db->where('images.is_delete', 0);
        $res = $this->db->get('images');
        return $res->result_array(); 
    }

}

/* End of file images_Model.php */

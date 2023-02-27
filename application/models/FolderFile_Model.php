<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FolderFile_Model extends CI_Model
{

    public function getFileBy($by, $value, $parent, $start, $limit)
    {
        $this->db->cache_off();
        $this->db->select("file_id, files.cat_id, file_title , file_alias, url_download, size, 
        files.published, downloads, files.ordering, files.date_added, DATE_FORMAT(files.date_added, '%Y-%m-%d') as date_added_format,
        cats.cat_dir,
        'file' as type");
        $this->db->order_by('ordering');
        if ($parent != null && $parent != '') {
            $this->db->where('files.cat_id', $parent);
        } else {
            $this->db->where('files.cat_id', 0);
        }
        if ($value != null && $value != '') {
            $this->db->where("(files.$by like '%$value%' or files.url_download like '%$value%')", NULL, false);
        }
        $this->db->join('qilry_jdownloads_cats as cats', 'cats.cat_id = files.cat_id');
        $this->db->limit($limit, $start);
        $res = $this->db->get('qilry_jdownloads_files files');
        return $res->result_array();
    }


    public function getFileByPublished($by, $value, $parent, $start, $limit)
    {
        $this->db->cache_off();
        $this->db->select("file_id, files.cat_id, file_title , file_alias, url_download, size, 
        files.published, downloads, files.ordering, date_added,
        cats.cat_dir, cats.cat_title,
        'file' as type");
        $this->db->order_by('ordering');
        if ($value == '' || $value == null) {
            if ($parent != null && $parent != '') {
                $this->db->where('files.cat_id', $parent);
            } else {
                $this->db->where('files.cat_id', 0);
            }
        }
        if ($value != null && $value != '') {
            $this->db->like('files.' . $by, $value);
        }
        $this->db->join('qilry_jdownloads_cats as cats', 'cats.cat_id = files.cat_id');
        $this->db->where('files.published', 1);
        // $this->db->limit($limit, $start);
        $res = $this->db->get('qilry_jdownloads_files files');
        return $res->result_array();
    }
    public function remove($file_id)
    {
        $this->db->where('qilry_jdownloads_files.file_id', $file_id);
        return $this->db->delete('qilry_jdownloads_files');
    }
    public function show($is_show, $file_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['modified_date'] = $now;
        $data['published'] = $is_show;
        $this->db->where('qilry_jdownloads_files.file_id', $file_id);
        return $this->db->update('qilry_jdownloads_files', $data);
    }

    public function save($by, $data)
    {
        $select = $this->getByID($data['file_id']);
        if (count($select) == 0) {
            //
            $now = date("Y-m-d H:i:s");
            $data['created_by'] = $by;
            $data['date_added'] = $now;
            $data['ordering'] = 0;
            $min = $this->getMinNo($data['cat_id']);
            $max = $this->getMaxNo($data['cat_id']);
            $this->incrementNumber($min, $max, $data['cat_id']);
            return $this->db->insert('qilry_jdownloads_files', $data);
        } else {
            $now = date("Y-m-d H:i:s");
            $data['modified_by'] = $by;
            $data['modified_date'] = $now;
            return $this->update($data);
        }
    }

    public function incrementNumber($start, $end, $cat_id = NULL)
    {
        if ($start == '' || $end == '')
            return true;
        $sql = "UPDATE qilry_jdownloads_files set ordering = ordering + 1 WHERE ordering BETWEEN $start AND $end ";
        if ($cat_id) {
            $sql .= " AND qilry_jdownloads_files.cat_id = $cat_id";
        } else {
            $sql .= " AND qilry_jdownloads_files.cat_id IS NULL";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['modified_date'] = $now;
        $this->db->where('qilry_jdownloads_files.file_id', $data['file_id']);
        return $this->db->update('qilry_jdownloads_files', $data);
    }

    public function getByID($id)
    {
        $this->db->where('qilry_jdownloads_files.file_id', $id);
        $res = $this->db->get('qilry_jdownloads_files');
        return $res->result_array();
    }

    public function getByIdOne($id)
    {
        $this->db->select("file_id, cat_id, file_title , file_alias, url_download, size, date_added, published, downloads, ordering");
        $this->db->where('qilry_jdownloads_files.file_id', $id);
        $res = $this->db->get('qilry_jdownloads_files');
        return $res->row_array();
    }

    public function count($cat_id = NULL, $is_cache = false, $search = '')
    {
        if ($is_cache) {
            $this->db->cache_on();
        } else {
            $this->db->cache_off();
        }
        $this->db->select('COUNT(*) as total');
        if ($cat_id != null && $cat_id != '') {
            $this->db->where('cat_id', $cat_id);
            $this->db->where("(file_title like '%$search%' or url_download like '%$search%')", NULL, false);
        } else {
            $this->db->where('cat_id', 0);
        }
        $res = $this->db->get('qilry_jdownloads_files');
        return $res->row_array()['total'];
    }


    public function increment($id)
    {
        $this->db->where('file_id', $id);
        $this->db->set('downloads', 'downloads+1', FALSE);
        $this->db->update('qilry_jdownloads_files');
    }

    public function update_number($from, $to, $cat_id = NULL)
    {
        $val = ' - 1';
        if ($from > $to) {
            $tmp = $from;
            $from = $to;
            $to = $tmp;
            $val = ' + 1';
        }
        if ($from == '0' || ($from == '' && $to == ''))
            return true;
        $sql = "UPDATE qilry_jdownloads_files set ordering = ordering $val WHERE ordering BETWEEN  $from AND $to ";
        if ($cat_id) {
            $sql .= " AND qilry_jdownloads_files.cat_id = $cat_id";
        } else {
            $sql .= " AND qilry_jdownloads_files.cat_id IS NULL";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    public function getMaxNo($cat_id = NULL)
    {
        $this->db->select_max('ordering');
        if ($cat_id != null && $cat_id != '') {
            $this->db->where('cat_id', $cat_id);
        } else {
            $this->db->where('cat_id', 0);
        }
        $res = $this->db->get('qilry_jdownloads_files')->row_array();
        if ($res) {
            return $res['ordering'];
        }
        return 0;
    }

    public function getMinNo($cat_id = NULL)
    {
        $this->db->select_min('ordering');
        if ($cat_id != null && $cat_id != '') {
            $this->db->where('cat_id', $cat_id);
        } else {
            $this->db->where('cat_id', 0);
        }
        $res = $this->db->get('qilry_jdownloads_files')->row_array();
        if ($res) {
            return $res['ordering'];
        }
        return 0;
    }
}

/* End of file attachment_Model.php */

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Folder_Model extends CI_Model
{

    public function getCatBy($by, $value, $parent, $start, $limit)
    {
        $this->db->select("cat_id, cat_dir, cat_title, cat_alias, published, ordering, cat_href,
        (select count(*) from qilry_jdownloads_files files where files.cat_id = qilry_jdownloads_cats.cat_id) as size, 
        (select count(*) from qilry_jdownloads_cats sub where sub.parent_id = qilry_jdownloads_cats.cat_id) as count_sub_folder, 
        'folder' as type");
        $this->db->order_by('ordering');
        if ($parent != null && $parent != '') {
            $this->db->where('parent_id', $parent);
        } else {
            $this->db->where('parent_id', 0);
        }
        if ($value != null && $value != '') {
            $this->db->where("(qilry_jdownloads_cats.$by like '%$value%' or qilry_jdownloads_cats.cat_dir like '%$value%')", NULL, false);
        }
        $this->db->limit($limit, $start);
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->result_array();
    }

    public function getCatByPublished($by, $value, $parent, $start, $limit)
    {
        $this->db->cache_off();
        $this->db->select("qilry_jdownloads_cats.cat_id, qilry_jdownloads_cats.cat_dir, qilry_jdownloads_cats.cat_title,
        qilry_jdownloads_cats.cat_alias, qilry_jdownloads_cats.published, qilry_jdownloads_cats.ordering, qilry_jdownloads_cats.cat_href,
        p.cat_title as p_cat_title,
        (select count(*) from qilry_jdownloads_files files where files.published = 1 and files.cat_id = qilry_jdownloads_cats.cat_id) as size, 
        (select count(*) from qilry_jdownloads_cats sub where sub.published = 1 and sub.parent_id = qilry_jdownloads_cats.cat_id) as count_sub_folder, 
        'folder' as type");
        $this->db->join('qilry_jdownloads_cats p', 'p.cat_id=qilry_jdownloads_cats.parent_id', 'left');
        $this->db->order_by('ordering');
        if ($value == '' || $value == null) {
            if ($parent != null && $parent != '') {
                $this->db->where('qilry_jdownloads_cats.parent_id', $parent);
            } else {
                $this->db->where('qilry_jdownloads_cats.parent_id', 0);
            }
        }
        if ($value != null && $value != '') {
            $this->db->like('qilry_jdownloads_cats.' . $by, $value);
        }
        $this->db->where('qilry_jdownloads_cats.published', 1);
        // $this->db->limit($limit, $start);
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->result_array();
    }

    public function getByParent($parent_id)
    {
        $this->db->where('parent_id', $parent_id);
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->result_array();
    }

    public function remove($cat_id)
    {
        // remove sub folder
        $folder = $this->getByParent($cat_id);
        while (count($folder) != 0) {
            $item = array_pop($folder);
            $child = $this->getByParent($item['cat_id']);
            if (count($child) > 0) {
                $folder = array_merge($folder, $child);
            }
            // remove file
            $this->db->where('cat_id', $item['cat_id']);
            $files = $this->db->get('qilry_jdownloads_files')->result_array();;
            while (count($files) != 0) {
                $file = array_pop($files);
                $this->db->where('qilry_jdownloads_files.file_id', $file['file_id']);
                $this->db->delete('qilry_jdownloads_files');
            }

            $this->db->where('qilry_jdownloads_cats.cat_id', $item['cat_id']);
            $this->db->delete('qilry_jdownloads_cats');
        }
        // remove file
        $this->db->where('cat_id', $cat_id);
        $files = $this->db->get('qilry_jdownloads_files')->result_array();;
        while (count($files) != 0) {
            $file = array_pop($files);
            $this->db->where('qilry_jdownloads_files.file_id', $file['file_id']);
            $this->db->delete('qilry_jdownloads_files');
        }

        $this->db->where('qilry_jdownloads_cats.cat_id', $cat_id);
        return $this->db->delete('qilry_jdownloads_cats');
    }
    public function show($is_show, $cat_id)
    {
        $now = date("Y-m-d H:i:s");
        $data['checked_out_time'] = $now;
        $data['published'] = $is_show;
        $this->db->where('qilry_jdownloads_cats.cat_id', $cat_id);
        return $this->db->update('qilry_jdownloads_cats', $data);
    }

    public function save($data)
    {
        $select = $this->getByID($data['cat_id']);
        if (count($select) == 0) {
            //
            if (!is_dir('awe12rhsto1m23fsd/jdownloads/' . $data['cat_dir'])) {
                mkdir('awe12rhsto1m23fsd/jdownloads/' . $data['cat_dir'], 0777, TRUE);
            }
            $now = date("Y-m-d H:i:s");
            $data['checked_out_time'] = $now;
            $data['ordering'] = $this->getMaxNo() + 1;
            return $this->db->insert('qilry_jdownloads_cats', $data);
        } else {
            $select = $select[0];
            $root = 'awe12rhsto1m23fsd/jdownloads/';
            if (isset($data['cat_dir']) && $data['cat_dir'] != '' && $data['cat_dir'] != $select['cat_dir']) {
                $this->rename_sub($data['cat_id'], $data['cat_dir']);
                if (is_dir($root . $select['cat_dir'])) {
                    $success = rename($root . $select['cat_dir'], $root . $data['cat_dir']);
                    if (!$success) {
                        return 'ไม่สามารถบันทึกได้';
                    }
                }
            }
            $now = date("Y-m-d H:i:s");
            $data['checked_out_time'] = $now;
            return $this->update($data);
        }
    }

    public function rename_sub($parent_id, $name)
    {
        $this->db->where('parent_id', $parent_id);
        $result = $this->db->get('qilry_jdownloads_cats')->result_array();
        foreach ($result as $row) {
            $dir = explode('/', $row['cat_dir']);
            if (count($dir) > 1) {
                $dir[count($dir) - 2] = $name;
                $cat_dir = implode('/', $dir);
                $this->db->where('cat_id', $row['cat_id']);
                $this->db->update('qilry_jdownloads_cats', ['cat_dir' => $cat_dir]);
            }
        }
    }

    public function update($data)
    {
        $now = date("Y-m-d H:i:s");
        $data['checked_out_time'] = $now;
        $this->db->where('qilry_jdownloads_cats.cat_id', $data['cat_id']);
        return $this->db->update('qilry_jdownloads_cats', $data);
    }

    public function getByID($id)
    {
        $this->db->where('qilry_jdownloads_cats.cat_id', $id);
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->result_array();
    }

    public function getByIdOne($id)
    {
        $this->db->where('qilry_jdownloads_cats.cat_id', $id);
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->row_array();
    }

    public function path($cat_id, $is_published = true, $is_cache = false)
    {
        if ($is_cache) {
            $this->db->cache_on();
        } else {
            $this->db->cache_off();
        }
        $this->db->select("cat_id, cat_dir, cat_title, cat_alias, parent_id");
        $this->db->where('qilry_jdownloads_cats.cat_id', $cat_id);
        if ($is_published) {
            $this->db->where('qilry_jdownloads_cats.published', 1);
        }
        $res = $this->db->get('qilry_jdownloads_cats');
        $result = [];
        $item = $res->row_array();
        $result[] = $item;
        while ($item['parent_id'] != 0) {
            $this->db->where('qilry_jdownloads_cats.cat_id', $item['parent_id']);
            if ($is_published) {
                $this->db->where('qilry_jdownloads_cats.published', 1);
            }
            $res = $this->db->get('qilry_jdownloads_cats');
            $item = $res->row_array();
            $result[] = $item;
        }
        $result = array_reverse($result);
        return $result;
    }

    public function count($parent = NULL, $is_cache = false, $search = '')
    {
        if ($is_cache) {
            $this->db->cache_on();
        } else {
            $this->db->cache_off();
        }
        $this->db->select('COUNT(*) as total');
        if ($parent != null && $parent != '') {
            $this->db->where("(cat_title like '%$search%' or cat_dir like '%$search%')", NULL, false);
            $this->db->where('parent_id', $parent);
        } else {
            $this->db->where('parent_id', 0);
        }
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->row_array()['total'];
    }


    public function increment($file)
    {
        $select = $this->getBy('path', $file);
        if (count($select) == 0) {
            //
            $data['path'] = $file;
            $data['download'] = 1;
            $this->db->insert('folder', $data);
            return $this->db->insert_id();
        } else {
            $this->db->where('path', $file);
            $this->db->set('download', 'download+1', FALSE);
            $this->db->update('folder');
        }
    }

    public function getCatSmBy($parent_id = 0, $not_in = null)
    {
        $this->db->select('*, 
        (select count(*) from qilry_jdownloads_cats sub where sub.parent_id = qilry_jdownloads_cats.cat_id) as sub');
        $this->db->where('qilry_jdownloads_cats.parent_id', $parent_id);
        if ($not_in != '' && $not_in != null) {
            $this->db->where('qilry_jdownloads_cats.cat_id !=', $not_in, FALSE);
        }
        $res = $this->db->get('qilry_jdownloads_cats');
        return $res->result_array();
    }

    public function getBy($by, $value)
    {
        $this->db->where('folder.' . $by, $value);
        $res = $this->db->get('folder');
        return $res->result_array();
    }

    public function update_number($from, $to, $parent_id = NULL)
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
        $sql = "UPDATE qilry_jdownloads_cats set ordering = ordering $val WHERE ordering BETWEEN  $from AND $to ";
        if ($parent_id) {
            $sql .= " AND qilry_jdownloads_cats.parent_id = $parent_id";
        } else {
            $sql .= " AND qilry_jdownloads_cats.parent_id IS NULL";
        }
        $query = $this->db->query($sql);
        return $query;
    }

    public function getMaxNo($parent = NULL)
    {
        $this->db->select_max('ordering');
        if ($parent != null && $parent != '') {
            $this->db->where('parent_id', $parent);
        } else {
            $this->db->where('parent_id', 0);
        }
        $res = $this->db->get('qilry_jdownloads_cats')->row_array();
        if ($res) {
            return $res['ordering'];
        }
        return 0;
    }
}

/* End of file attachment_Model.php */

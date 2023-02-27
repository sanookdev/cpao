<?php
class online_users_mod extends CI_Model
{
  private $timeout = 120;

  function __construct()
  {
    parent::__construct();
  }

  function add($data) {
    $this->db->insert('visitors_online', $data);
  }

  //getting all session data
  function get_all_session_data()
  {
    $this->db->cache_off();
    $this->db->where('timestamp < ', time() - $this->timeout);
    $this->db->delete('ci_sessions');
    $this->db->distinct();
    $this->db->select('ip_address');
    $query = $this->db->get('ci_sessions');
    return $query->result_array();
  }

  function delete_time_out() {
    $this->db->where('timestamp < ', time() - $this->timeout);
    $this->db->delete('ci_sessions');
  }

  function get_count_session_data()
  {
    $this->delete_time_out();
    $this->db->cache_off();
    $this->db->distinct();
    $this->db->select('ip_address');
    $query = $this->db->get('ci_sessions');
    return $query->num_rows();
  }

  function get_today()
  {
    $this->db->cache_off();
    $this->db->select('count(*) as num');
    $this->db->where('date', date('Y-m-d'));
    $query = $this->db->get('visitors_online');
    return $query->row_array()['num'];
  }

  function get_yesterday()
  {
    $this->db->cache_off();
    $this->db->where('topic', 'get_yesterday');
    $data = $this->db->get('static')->row_array();
    if (isset($data['value']) && $data['mod_date'] == date('Y-m-d')) {
      return intval($data['value']);
    }
    $this->db->cache_off();
    $date = date('Y-m-d', strtotime("-1 days"));
    $this->db->select('count(*) as num');
    $this->db->where('date', $date);
    $query = $this->db->get('visitors_online');
    $num = $query->row_array()['num'];

    if (!isset($data['value'])) {
      $this->db->insert('static', ['topic' => 'get_yesterday', 'value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    else {
      $this->db->where('topic', 'get_yesterday');
      $this->db->update('static', ['value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    return $num;
  }

  function get_this_month()
  {
    $this->db->cache_off();
    $this->db->where('topic', 'get_this_month');
    $data = $this->db->get('static')->row_array();
    if (isset($data['value']) && $data['mod_date'] == date('Y-m-d')) {
      return intval($data['value']);
    }
    $this->db->cache_off();
    $date  = date('Y-m');
    $this->db->select('count(*) as num');
    $this->db->where('DATE_FORMAT(date, "%Y-%m") = ', $date);
    $query = $this->db->get('visitors_online');
    $num = $query->row_array()['num'];

    if (!isset($data['value'])) {
      $this->db->insert('static', ['topic' => 'get_this_month', 'value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    else {
      $this->db->where('topic', 'get_this_month');
      $this->db->update('static', ['value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    return $num;
  }

  function get_prev_month()
  {
    $this->db->cache_off();
    $this->db->where('topic', 'get_prev_month');
    $data = $this->db->get('static')->row_array();
    if (isset($data['value']) && $data['mod_date'] == date('Y-m-d')) {
      return intval($data['value']);
    }
    $this->db->cache_off();
    $datestring = 'first day of last month';
    $dt = date_create($datestring);
    $date  = $dt->format('Y-m');
    $this->db->select('count(*) as num');
    $this->db->where('DATE_FORMAT(date, "%Y-%m") = ', $date);
    $query = $this->db->get('visitors_online');
    $num = $query->row_array()['num'];

    if (!isset($data['value'])) {
      $this->db->insert('static', ['topic' => 'get_prev_month', 'value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    else {
      $this->db->where('topic', 'get_prev_month');
      $this->db->update('static', ['value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    return $num;
  }

  function get_all()
  {
    $this->db->cache_off();
    $this->db->where('topic', 'get_all');
    $data = $this->db->get('static')->row_array();
    if (isset($data['value']) && $data['mod_date'] == date('Y-m-d')) {
      return intval($data['value']);
    }
    $this->db->cache_off();
    $this->db->select('count(*) as num');
    $query = $this->db->get('visitors_online');
    $num = $query->row_array()['num'];

    if (!isset($data['value'])) {
      $this->db->insert('static', ['topic' => 'get_all', 'value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    else {
      $this->db->where('topic', 'get_all');
      $this->db->update('static', ['value' => $num, 'mod_date' => date('Y-m-d')]);
    }
    return $num;
  }
}

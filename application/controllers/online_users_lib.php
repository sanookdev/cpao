<?php
class online_users_lib extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('online_users_mod');
  }

  //getting all online session data

  function get_all_session_data()
  {
		header('Content-Type: application/json');
    $query = $this->online_users_mod->get_all_session_data();
    echo json_encode($query);
  }
}

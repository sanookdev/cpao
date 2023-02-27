<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserVisit extends CI_Controller
{

    function index()
    {
        $this->load->model('online_users_mod');
        // $total = 61187;
        // for($i = 0; $i < $total; $i++) {
        //     $date = '2019-01-01';
        //     $time = strtotime('2019-01-01');
        //     $data = [
        //         'ip_address' => "::",
        //         'date' => $date,
        //         'timestamp' => $time,
        //     ];  
        //     $this->online_users_mod->add($data);
        // }
    }
}

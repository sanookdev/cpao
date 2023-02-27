<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$hook['post_controller'] = array(
	'class'    => 'User_online',
	'function' => 'online',
	'filename' => 'User_online.php',
	'filepath' => 'hooks',
	'params' => ''
);
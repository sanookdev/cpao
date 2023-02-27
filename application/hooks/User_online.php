<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_online
{
	var $CI;
	function __construct()
    {
		$this->CI = & get_instance();
    }
	function online()
	{
		$array = [
			'ip_address' => $this->get_client_ip(),
			'date' => date('Y-m-d'),
			'timestamp' => time(),
		];
		$this->CI->db->where("ip_address", $array['ip_address']);
		$this->CI->db->where("date", date('Y-m-d'));
		$item = $this->CI->db->get('visitors_online')->row_array();
		if (!$item) {
			$this->CI->db->insert('visitors_online', $array); 
		}
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}

/* End of file users_online.php */
/* Location: ./application/hooks/user_online.php */
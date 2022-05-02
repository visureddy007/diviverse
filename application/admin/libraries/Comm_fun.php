<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//require 'vendor/autoload.php';
class Comm_fun
{

	protected $CI;
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI = &get_instance();
		//$this->load->library('email');
	}

	public function is_logged_in()
	{

		$is_logged_in = $this->CI->session->userdata('diviverse_user_logged_in');

		if (isset($is_logged_in) && $is_logged_in == true) {
			redirect('dashboard');
		}
	}


	function is_not_logged_in()
	{
		$is_logged_in = $this->CI->session->userdata('diviverse_user_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != true) {
			redirect('login');
		}
	}

	



	function onlyAdminAccess()
	{
		$is_admin = $this->CI->session->userdata('diviverse_user_role');

		if (isset($is_admin) && $is_admin != 'ADMIN') {
			$this->CI->session->set_flashdata('invalid', warning_msg('Invalid access'));
			redirect('dashboard');
		}
	}
	function eligible_user($dept)
	{
		$user_dept = strtolower($this->CI->session->userdata('diviverse_user_department_name'));

		if ($user_dept != $dept) {
			$this->CI->session->set_flashdata('invalid', warning_msg('Invalid Access'));
			redirect('dashboard');
		}
	}
}

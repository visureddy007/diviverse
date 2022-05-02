<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __Construct(){
		parent:: __construct();
		$this->comm_fun->is_not_logged_in();
	}
	
	
		
	
	public function index()
	{		
		$sess_data = array(
			'diviverse_user_name'=>'',
			'diviverse_user_id'=>'',		
			'diviverse_user_department_name'=>'',				
			'diviverse_user_plant_name'=>'',			
			'diviverse_user_logged_in'=>false
		);
		$this->session->set_userdata($sess_data);
		if(isset($_GET['m']) && $_GET['m']=='pass'){
			$this->session->set_flashdata('msg',success_msg('Password updated Successfully ,login with new password'));
		}
		redirect("login");	
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
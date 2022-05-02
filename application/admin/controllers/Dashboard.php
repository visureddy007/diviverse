
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	function __Construct(){
		parent:: __Construct();
		$this->uid = $this->session->userdata('avantiqc_user_id');
		$this->user_department = strtolower($this->session->userdata('avantiqc_user_department_name'));
		$this->comm_fun->is_not_logged_in();
	}
	
	public function index(){
		if($this->user_department=='soaking'){
			$data['main_content'] = 'dashboard_soaking';						
		}else if($this->user_department=='lab'){
			$data['main_content'] = 'dashboard_lab';			
		}else{
			$data['main_content'] = 'dashboard';			
		}
		$this->load->view('dash_template/body',$data);
	}
	
	public function demo(){
	
		$this->load->view('demo');
	}
	
}
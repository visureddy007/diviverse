
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __Construct(){
		parent:: __Construct();
		$this->comm_fun->is_logged_in();
		$this->load->model('Login_model');
		$this->load->library('bcrypt');
	}
	
	public function index(){
		$data['main_content'] = 'login';
		$this->load->view('login_template/body',$data);
	}
	
		
	function validate(){
		
		extract($_POST);
		$status=0;
		$msg='';
		$url='';
		if(isset($name) && $name==""){/*do email validation here and in signup*/
			$msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please enter mobile number</strong></div>';
		}else if(isset($password) && $password==""){
			$msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please enter password</strong></div>';
		}else{			
			/* $ud = $this->Login_model->validate($name,md5($password));		 */
			$ud = $this->Login_model->verify($name);	
			if ($ud) {
				$stored_password = $ud[0]['password'];
				if ($this->bcrypt->check_password($password, $stored_password)) {		
						$user = $ud[0];
					   if($user['status']==1){		
							$user_id = $user['id'];
							$name = $user['name'];							
							$sess_data = array(					
								'diviverse_user_name'=>$name,
								'diviverse_user_id'=>$user_id,				
								'diviverse_user_logged_in'=>true
							);
							$this->session->set_userdata($sess_data);
							$status=1;
							$url = base_url('dashboard');
							$msg='<div class="alert alert-success">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>Successfully logged in</strong></div>';
						}else{
							  $msg='<div class="alert alert-warning">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>Your account been deactivated,please contact admin  </strong></div>';
											
						}
								
				} else {
					$msg=warning_msg('Invalid Password');
				}		
			} else {
				$msg=warning_msg('Invalid details');
			}			
					 
		}
		$res = array('status'=>$status,'msg'=>$msg,'url'=>$url);
		$res['cst']['cstn'] = $this->security->get_csrf_token_name();
		$res['cst']['cstv'] = $this->security->get_csrf_hash();
		echo json_encode($res); exit;
	 }
}

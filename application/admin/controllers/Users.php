
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	
	function __Construct(){
		parent:: __Construct();
		$this->comm_fun->is_not_logged_in();
		$this->comm_fun->onlyAdminAccess();
		$this->uid = $this->session->userdata('avantiqc_user_id');
		$this->load->model('Users_model');
		$this->load->model('Department_model');
		$this->load->model('Plants_model');
		$this->load->library('datatblsel');	
		$this->load->library('bcrypt');	
	}
	
	public function index(){
		$data['main_content'] = 'users_list';
		$this->load->view('dash_template/body',$data);
	}
	
	public function add(){
		$data['main_content'] = 'add_user';
		$data['departments'] = $this->Department_model->getAllActive();
		$data['plants'] = $this->Plants_model->getAllActive();
		$this->load->view('dash_template/body',$data);
	}
	
	function edit(){
		$id = addslashes($this->uri->segment('3'));
		if($id!="" ){
			$res = $this->Users_model->deptInfo($id);
			if($res['num']==1){
				$data['main_content'] = 'edit_user';			
				$data['record'] = $res['data'];			
				$this->load->view('dash_template/body',$data);
			}else{
				$this->session->set_flashdata('invalid',warning_msg('Invalid request'));
				redirect('Users');
			}	
		}else{
			redirect('Users');
		}	
	}
	
	function getAll(){
		$select = "u.*,d.name as department_name,p.name as plant_name";
		$column = array('u.name','u.mobile','u.created_at');
		$order = array();
		$join = array();
		$join[]= array(
					'table_name'=>'departments as d',
					'on'=>'d.id=u.department_id',
					'join'=>'LEFT',
				);
		$join[]= array(
					'table_name'=>'plants as p',
					'on'=>'p.id=u.plant_id',
					'join'=>'LEFT',
				);
		$where=' u.id !=0';		
		$tb_name = 'users as u';
		$list = $this->datatblsel->get_datatables($select,$column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
	
		$i = 0;
		foreach ($list as $req) {  
			
			$no++;
			$row = array();
			$action='<a href="'.base_url('Users/edit/'.$req->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>';	
			if($req->status=='0'){
				$status = '<a class="btn btn-warning btn-sm" style="color:white">Pending</a>';	
			}elseif($req->status=='1'){
				$status = '<a class="btn btn-success btn-sm" style="color:white">Active</a>';	
			}else
			{
				$status = '<a class="btn btn-danger btn-sm" style="color:white">Inactive</a>';	
			}
			$i = $i +1;
			$row[] = $i;
			$row[] = stripslashes($req->name);
			$row[] = stripslashes($req->mobile);
			$row[] = stripslashes($req->role);
			$row[] = stripslashes($req->department_name);
			$row[] = stripslashes($req->plant_name);
			$row[] = $status;
			$row[] = $req->created_at;
			$row[] = $action;
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->datatblsel->count_all($select,$tb_name,$join),
				"recordsFiltered" => $this->datatblsel->count_filtered($select,$column,$order,$tb_name,$join,$where),
				"data" => $data,
			);
		echo json_encode($output);
	}
	
	function del(){
		$ary['success']=false;
		$ary['msg']='';
		$ary['url']='';
		$id = addslashes($this->input->post('i'));
		$res = $this->Users_model->deptInfo($id);
		if($id=="" || $res['num']!=1){
			$ary['msg']=warning_msg('Invalid request, please reload the page and try again');
		}else{
			$q = $this->Users_model->update(array('is_del'=>1),$id);
			if($q){
				$msg = success_msg('User deleted successfully');
				$this->session->set_flashdata('success',$msg);
				$ary['msg']=$msg;			
				$ary['success']=true;			
				$ary['url']=base_url('Users');
			}else{				
				$ary['msg'] = warning_msg('Unable to delete Please  Try again');
			}
		}		
		echo json_encode($ary);		
	}
	
	function create(){
		extract($_POST);
		$status=0;
		$msg='';
		$url='';
		$id = $this->uid;
		 if($this->input->post('name')=='' ){
				$msg = warning_msg('Please enter User name');
		 }elseif($this->input->post('mobile')=='' ){
				$msg = warning_msg('Please enter mobile');
		 }elseif($this->input->post('mobile')!='' && !empty($this->Users_model->isMobileExists(addslashes($this->input->post('mobile')))) ){
				$msg = warning_msg('mobile already exists');
		 }elseif($this->input->post('department')=='' ){
				$msg = warning_msg('Please select department');
		 }elseif($this->input->post('plant')=='' ){
				$msg = warning_msg('Please select plant');
		 }else{	
			$password='123456';
			$hash = $this->bcrypt->hash_password($password);
			$insert_data['non_xss'] = array(			
				'name'=>addslashes($this->input->post('name')),
				'mobile'=>addslashes($this->input->post('mobile')),
				'department_id'=>addslashes($this->input->post('department')),
				'plant_id'=>addslashes($this->input->post('plant')),
				'password'=>$hash,
				'status'=>1,				
			);
			$insert_data['xss_data'] = clean_ip($insert_data['non_xss']);
			$res = $this->Users_model->insert($insert_data['xss_data']);
			if($res){				
				$status=1;
				$msg = success_msg('User Created Successfully');
				$url=base_url('Users');
			}else{
				$msg = warning_msg('Unable to create please try again later!');						
			}
		 }
		 
		
		$res = array('status'=>$status,'msg'=>$msg,'url'=>$url);
		$res['cst']['cstn'] = $this->security->get_csrf_token_name();
		$res['cst']['cstv'] = $this->security->get_csrf_hash();
		echo json_encode($res); exit;	
	}	
	
	function update(){
		extract($_POST);
		$status=0;
		$msg='';
		$url='';
		$id = $this->uid;
		$User_id = addslashes($this->uri->segment('3'));
		$User = $this->Users_model->deptInfo($User_id);
		if($User['num']!=1){
			$msg = warning_msg('Invalid request');	
		}else if($this->input->post('name')=='' ){
				$msg = warning_msg('Please enter User name');	
		}else if($this->input->post('status')=='' ){
				$msg = warning_msg('Please select status');	
		}else{
			if($User['data']['name']!=$this->input->post('name') && !empty($this->Users_model->isNameExists(addslashes($this->input->post('name')))) ){
					$msg = warning_msg('User name already exists');	
				
			}else{				 
				$update_data['non_xss'] = array(
						'name'=>addslashes($this->input->post('name')),		
						'status'=>addslashes($this->input->post('status')),
						'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update_data['xss_data'] = clean_ip($update_data['non_xss']);	
				$q = $this->Users_model->update($update_data['xss_data'],$User_id);				
				if($q){
					$status=1;
					$msg = success_msg('User Updated Successfully');	
					
					$url=base_url('Users');

				}else{
					$msg = warning_msg('Please Try Again !');	
				}
			 }			
		}
			
		
		$res = array('status'=>$status,'msg'=>$msg,'url'=>$url);
		$res['cst']['cstn'] = $this->security->get_csrf_token_name();
		$res['cst']['cstv'] = $this->security->get_csrf_hash();
		echo json_encode($res); exit;	
		
		
	}
	

}
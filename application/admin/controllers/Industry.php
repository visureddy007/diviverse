
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends CI_Controller {

	
	function __Construct(){
		parent:: __Construct();
		$this->comm_fun->is_not_logged_in();
		$this->comm_fun->onlyAdminAccess();
		$this->uid = $this->session->userdata('diviverse_user_id');
		$this->load->model('Industry_model');
		$this->load->library('datatblsel');	
	}
	
	public function index(){
		$data['main_content'] = 'industry_list';
		$this->load->view('dash_template/body',$data);
	}
	
	public function add(){
		$data['main_content'] = 'add_industry';
		$this->load->view('dash_template/body',$data);
	}
	
	function edit(){
		$id = addslashes($this->uri->segment('3'));
		if($id!="" ){
			$res = $this->Industry_model->catInfo($id);
			if($res['num']==1){
				$data['main_content'] = 'edit_industry';			
				$data['record'] = $res['data'];			
				$this->load->view('dash_template/body',$data);
			}else{
				$this->session->set_flashdata('invalid',warning_msg('Invalid request'));
				redirect('Industry');
			}	
		}else{
			redirect('Industry');
		}	
	}
	
	function getAll(){
		$select = "c.*";
		$column = array('c.name','c.status','c.created_at');
		$order = array();
		$join = array();
		$where=" c.is_del != 1";
		$tb_name = 'industry as c';
		$list = $this->datatblsel->get_datatables($select,$column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
	
		$i = 0;
		foreach ($list as $req) {  
			
			$no++;
			$row = array();
			$action='<a href="'.base_url('Industry/edit/'.$req->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-t="'.$req->name.'" data-i="'.$req->id.'" data-c="industry" class="btn btn-danger btn-sm del"><i class="fa fa-trash"></i></a><br>';	
			$status = $req->status=='1'?'Active':'Inactive';
			if($req->status=='1'){
				$status = '<a class="btn btn-success btn-sm" style="industry:white">'.$status.'</a>';	
			}else
			{
				$status = '<a class="btn btn-warning btn-sm" style="industry:white">'.$status.'</a>';	
			}
			$i = $i +1;
			$row[] = $i;
			$row[] = $req->name;
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
		$res = $this->Industry_model->catInfo($id);
		if($id=="" || $res['num']!=1){
			$ary['msg']=warning_msg('Invalid request, please reload the page and try again');
		}else{
			$q = $this->Industry_model->update(array('is_del'=>1),$id);
			if($q){
				$msg = success_msg('Industry deleted successfully');
				$this->session->set_flashdata('success',$msg);
				$ary['msg']=$msg;			
				$ary['success']=true;			
				$ary['url']=base_url('Industry');
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
				$msg = warning_msg('Please enter industry name');
		 }elseif($this->input->post('description')=='' ){
				$msg = warning_msg('Please enter description');
		 }elseif($this->input->post('name')!='' && !empty($this->Industry_model->isNameExists(addslashes($this->input->post('name')))) ){
				$msg = warning_msg('Industry name already exists');
		 }else{	
			$insert_data['non_xss'] = array(			
				'name'=>addslashes($this->input->post('name')),
				'description'=>stripcslashes($this->input->post('description')),
				'status'=>1,				
			);
			$insert_data['xss_data'] = clean_ip($insert_data['non_xss']);
			if(isset($_FILES['image']) && !empty($_FILES) && $_FILES['image']['name']!=""){		
				$trgt='assets/industryimage/';
				$size = $_FILES['image']['size'];
				$file_name = $_FILES['image']['name'];
				$path_parts=pathinfo($_FILES['image']['name']);
				$file = time().'.'.$path_parts['extension'];
				$insert_data['xss_data']['image']=$file;
				move_uploaded_file($_FILES['image']['tmp_name'],$trgt.$file); 
			 }
			$res = $this->Industry_model->insert($insert_data['xss_data']);
			if($res){				
				$status=1;
				$url=base_url('Industry');
				$msg = success_msg('Industry Created Successfully');
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
		$industry_id = addslashes($this->uri->segment('3'));
		$industry = $this->Industry_model->catInfo($industry_id);
		if($industry['num']!=1){
			$msg = warning_msg('Invalid request');	
		}else if($this->input->post('name')=='' ){
				$msg = warning_msg('Please enter industry name');	
		}else if($this->input->post('status')=='' ){
				$msg = warning_msg('Please select status');	
		}else{
			if($industry['data']['name']!=$this->input->post('name') && !empty($this->Industry_model->isNameExists(addslashes($this->input->post('name')))) ){
					$msg = warning_msg('industry name already exists');	
				
			}else{				 
				$update_data['non_xss'] = array(
						'name'=>addslashes($this->input->post('name')),		
						'description'=>stripcslashes($this->input->post('description')),
						'status'=>addslashes($this->input->post('status')),
						'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update_data['xss_data'] = clean_ip($update_data['non_xss']);	
				if(!empty($_FILES) && $_FILES['image']['name']!=""){		
					$trgt='assets/industryimage/';
					$size = $_FILES['image']['size'];
					$file_name = $_FILES['image']['name'];
					$path_parts=pathinfo($_FILES['image']['name']);
					$file = time().'.'.$path_parts['extension'];
					$update_data['xss_data']['image']=$file;
					move_uploaded_file($_FILES['image']['tmp_name'],$trgt.$file); 
				}
				$q = $this->Industry_model->update($update_data['xss_data'],$industry_id);				
				if($q){
					$status=1;
					$url=base_url('Industry');
					$msg = success_msg('Industry Updated Successfully');	

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
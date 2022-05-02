
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	
	function __Construct(){
		parent:: __Construct();
		$this->comm_fun->is_not_logged_in();
		$this->comm_fun->onlyAdminAccess();
		$this->uid = $this->session->userdata('diviverse_user_id');
		$this->load->model('Category_model');
		$this->load->library('datatblsel');	
	}
	
	public function index(){
		$data['main_content'] = 'category_list';
		$this->load->view('dash_template/body',$data);
	}
	
	public function add(){
		$data['main_content'] = 'add_category';
		$this->load->view('dash_template/body',$data);
	}
	
	function edit(){
		$id = addslashes($this->uri->segment('3'));
		if($id!="" ){
			$res = $this->Category_model->catInfo($id);
			if($res['num']==1){
				$data['main_content'] = 'edit_category';			
				$data['record'] = $res['data'];			
				$this->load->view('dash_template/body',$data);
			}else{
				$this->session->set_flashdata('invalid',warning_msg('Invalid request'));
				redirect('Category');
			}	
		}else{
			redirect('Category');
		}	
	}
	
	function getAll(){
		$select = "c.*";
		$column = array('c.name','c.status','c.created_at');
		$order = array();
		$join = array();
		$where=" c.is_del != 1";
		$tb_name = 'category as c';
		$list = $this->datatblsel->get_datatables($select,$column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
	
		$i = 0;
		foreach ($list as $req) {  
			
			$no++;
			$row = array();
			$action='<a href="'.base_url('Category/edit/'.$req->id).'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-t="'.$req->name.'" data-i="'.$req->id.'" data-c="category" class="btn btn-danger btn-sm del"><i class="fa fa-trash"></i></a><br>';	
			$status = $req->status=='1'?'Active':'Inactive';
			if($req->status=='1'){
				$status = '<a class="btn btn-success btn-sm" style="color:white">'.$status.'</a>';	
			}else
			{
				$status = '<a class="btn btn-warning btn-sm" style="color:white">'.$status.'</a>';	
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
		$res = $this->Category_model->catInfo($id);
		if($id=="" || $res['num']!=1){
			$ary['msg']=warning_msg('Invalid request, please reload the page and try again');
		}else{
			$q = $this->Category_model->update(array('is_del'=>1),$id);
			if($q){
				$msg = success_msg('Category deleted successfully');
				$this->session->set_flashdata('success',$msg);
				$ary['msg']=$msg;			
				$ary['success']=true;			
				$ary['url']=base_url('Category');
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
				$msg = warning_msg('Please enter category name');
		 }elseif($this->input->post('description')=='' ){
				$msg = warning_msg('Please enter description');
		 }elseif($this->input->post('name')!='' && !empty($this->Category_model->isNameExists(addslashes($this->input->post('name')))) ){
				$msg = warning_msg('Category name already exists');
		 }else{	
			$insert_data['non_xss'] = array(			
				'name'=>addslashes($this->input->post('name')),
				'description'=>stripcslashes($this->input->post('description')),
				'status'=>1,				
			);
			$insert_data['xss_data'] = clean_ip($insert_data['non_xss']);
			if(isset($_FILES['thumbnail_image']) && !empty($_FILES) && $_FILES['thumbnail_image']['name']!=""){		
				$trgt='assets/categoryimage/';
				$size = $_FILES['thumbnail_image']['size'];
				$file_name = $_FILES['thumbnail_image']['name'];
				$path_parts=pathinfo($_FILES['thumbnail_image']['name']);
				$file = time().'.'.$path_parts['extension'];
				$insert_data['xss_data']['thumbnail_image']=$file;
				move_uploaded_file($_FILES['thumbnail_image']['tmp_name'],$trgt.$file); 
			 }
			$res = $this->Category_model->insert($insert_data['xss_data']);
			if($res){				
				$status=1;
				$url=base_url('Category');
				$msg = success_msg('Category Created Successfully');
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
		$category_id = addslashes($this->uri->segment('3'));
		$category = $this->Category_model->catInfo($category_id);
		if($category['num']!=1){
			$msg = warning_msg('Invalid request');	
		}else if($this->input->post('name')=='' ){
				$msg = warning_msg('Please enter category name');	
		}else if($this->input->post('status')=='' ){
				$msg = warning_msg('Please select status');	
		}else{
			if($category['data']['name']!=$this->input->post('name') && !empty($this->Category_model->isNameExists(addslashes($this->input->post('name')))) ){
					$msg = warning_msg('category name already exists');	
				
			}else{				 
				$update_data['non_xss'] = array(
						'name'=>addslashes($this->input->post('name')),		
						'description'=>stripcslashes($this->input->post('description')),
						'status'=>addslashes($this->input->post('status')),
						'updated_at'=>date('Y-m-d H:i:s'),
				);
				$update_data['xss_data'] = clean_ip($update_data['non_xss']);	
				if(!empty($_FILES) && $_FILES['thumbnail_image']['name']!=""){		
					$trgt='assets/categoryimage/';
					$size = $_FILES['thumbnail_image']['size'];
					$file_name = $_FILES['thumbnail_image']['name'];
					$path_parts=pathinfo($_FILES['thumbnail_image']['name']);
					$file = time().'.'.$path_parts['extension'];
					$update_data['xss_data']['thumbnail_image']=$file;
					move_uploaded_file($_FILES['thumbnail_image']['tmp_name'],$trgt.$file); 
				}
				$q = $this->Category_model->update($update_data['xss_data'],$category_id);				
				if($q){
					$status=1;
					$url=base_url('Category');
					$msg = success_msg('Category Updated Successfully');	

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
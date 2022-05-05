<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Font_model extends CI_Model{
	private $tbl_name = 'font';
	
	
	function insert($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}
	
   function update($data,$id){
		$this->db->where('id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
	
	
	
	function isNameExists($name){		
		return  $this->db->where('name',$name)->where('is_del',0)->get($this->tbl_name)->result();			
	}	
	
	
	function getAllActive(){
		return $this->db->where('is_del',0)
						->where('status',1)
						->get($this->tbl_name)
						->result();
	}
	
	function catInfo($id){
		$sql = "select * from $this->tbl_name  where id=?";
		$q = $this->db->query($sql,$id);
		$num = $q->num_rows();
		$data='';
		if($num==1){
			$data=$q->result_array();
			$data = $data[0];	
		}
		return array('num'=>$num,'data'=>$data);		
	}
	
	function getName($id){
		$sql = "select * from $this->tbl_name  where id=?";
		$q = $this->db->query($sql,$id);
		if($q->num_rows()>0){
			$data=$q->result_array();
			return $data[0]->name;	
		}
	}
	
}
?>
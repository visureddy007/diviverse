<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model{
	
	private $tbl_name = 'users';
	
	function validate($name,$pwd){		
		$sql = "select
					u.* 
				from
					$this->tbl_name as u 
			    where
					u.`name`=? and u.`password`=?";
		$q = $this->db->query($sql,array($name,$pwd));
		
		$num=$q->num_rows();
		$data="";
		if($num>0){
			$data=$q->result_array();
			$data=$data[0];
		}
		return array('num'=>$num,'data'=>$data);	
	}
	
	public function verify($uname)
	{
		$sql = "SELECT u.*
				FROM $this->tbl_name AS u
				WHERE u.mobile = '$uname' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
}

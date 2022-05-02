<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class datatblsel {
	private $CI;

	function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->database();
	}

	function _get_datatables_query($select,$column,$order,$tb_name,$join,$where){
		
	  $this->CI->db->select($select);
		if(!empty($join)){
			foreach($join as $k=>$v){
				if(isset($v['join'])){
					$this->CI->db->join($v['table_name'],$v['on'],$v['join']);
				}else{
					$this->CI->db->join($v['table_name'],$v['on']);					
				}
				
			}
		}	
		$this->CI->db->from($tb_name);

		if(isset($_POST['where']))
		{
			$this->CI->db->where($_POST['where']);
		} 		else if(isset($where))
		{
			
			$this->CI->db->where($where);
		}				$i = 0;		$like_or='';		foreach ($column as $item) 
		{
			if($_POST['search']['value'])
				/*($i===0) ? $this->CI->db->like($item, $_POST['search']['value']) : $this->CI->db->or_like($item, $_POST['search']['value']);
				$column[$i] = $item;
				*/				$like_or.=($i===0) ? "( $item like '%".$_POST['search']['value']."%' ": "OR $item like '%".$_POST['search']['value']."%' ";				$i++;				
		}		if($like_or!=''){			$like_or.=' )';			$this->CI->db->where($like_or);		}


		if(isset($_POST['order']))
		{
			$this->CI->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			
			$this->CI->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($select,$column,$order,$tb_name,$join,$where){
		$this->_get_datatables_query($select,$column,$order,$tb_name,$join,$where);
		if($_POST['length'] != -1)
		$this->CI->db->limit($_POST['length'], $_POST['start']);
		$query = $this->CI->db->get();
		
		return $query->result();
	}
			
	function count_filtered($select,$column,$order,$tb_name,$join,$where){
		$this->_get_datatables_query($select,$column,$order,$tb_name,$join,$where);
		$query = $this->CI->db->get();
		return $query->num_rows();
	}

	function count_all($select,$tb_name,$join){
		  $this->CI->db->select($select);
		if(!empty($join)){
			foreach($join as $k=>$v){
			$this->CI->db->join($v['table_name'],$v['on']);
			}
		}
		$this->CI->db->from($tb_name);
		return $this->CI->db->count_all_results();
	}
}

/* End of file Someclass.php */
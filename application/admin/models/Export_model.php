<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Export_model extends CI_Model
{
    private $tbl_name = 'export';

    function insert($data)
    {
        $q = $this->db->insert($this->tbl_name, $data);
        return $q;
    }

    function update($data, $id)
    {
        $this->db->where('id', $id);
        $q = $this->db->update($this->tbl_name, $data);
        return $q;
    }

    function isNameExists($name)
    {
        return  $this->db->where('name', $name)->where('is_del', 0)->get($this->tbl_name)->result();
    }


    function get_export_details($id)
    {
        $this->db->select('*');
        $this->db->from($this->tbl_name);
        $this->db->where("export.id=$id");
        
        $query = $this->db->get();
        $query->result();
        $num = $query->num_rows();
        $data = [];
        if ($num == 1) {
            $data = $query->result()[0];
        }
     
        return array('num' => $num, 'data' => $data);
    }
    public function get_day_code_details($id)
    {
        $this->db->select('*');
        $this->db->from('export_day_code');
        $this->db->where("export_id=$id");
        
        $query = $this->db->get();
        return $query->result();
        
    }

    function getName($id)
    {
        $sql = "select * from $this->tbl_name  where id=?";
        $q = $this->db->query($sql, $id);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data[0]->name;
        }
    }
}

<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model
{

    public function fetch_plants($is_del, $status)
    {
        $this->db->select('*');
        $this->db->from("plants");
        $this->db->where("is_del=$is_del");
        $this->db->where("status=$status");
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_grades($is_del, $status)
    {
        $this->db->select('*');
        $this->db->from("grades");
        $this->db->where("is_del=$is_del");
        $this->db->where("status=$status");
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_varities($is_del, $status)
    {
        $this->db->select('*');
        $this->db->from("varities");
        $this->db->where("is_del=$is_del");
        $this->db->where("status=$status");
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_export($status)
    {
        $this->db->select('*');
        $this->db->from("export");
        $this->db->where("status=$status");
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_samples_ab_and_both($type,$date)
    {
		/*$this->db->select('*');
        $this->db->from("samples");
        $this->db->where("sample_type",$type);
        $this->db->where("sample_for","Both");
        $this->db->or_where("sample_for","Anti.Biotic");
        $query = $this->db->get();
		echo $this->db->last_query(); exit;*/
		
		$sql = "SELECT * FROM `samples` WHERE `sample_type` = '$type' AND (`sample_for` = 'Both' OR `sample_for` = 'Anti.Biotic') AND Date(`created_at`) = '$date'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		
        $list = '<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">#</th>
										  <th scope="col">Sample ID</th>
										  <th scope="col">Batch Number</th>
										  <th scope="col">Sample Collected By</th>
										  <th scope="col">View</th>
										</tr>
									  </thead>
									  <tbody>';
        foreach ($query->result() as $row) {
            $list .= '
										<tr>
										  <td><input type="checkbox" name="sample_ids[]" id="sample_ids" value="'.$row->id.'"></td>
										  <td>'.$row->id.'</td>
										  <td>'.$row->batch_no.'</td>
										  <td>Vishnu</td>
										  <td>View</td>
										</tr>
										';
            
        }
		$list.='	
			  </tbody>
			</table>';
        $return_data['list'] = $list;
        return $return_data;
   } 
   
 public function fetch_samples_micro($type,$date)
    {
		/*$this->db->select('*');
        $this->db->from("samples");
        $this->db->where("sample_type",$type);
        $this->db->where("sample_for","Both");
        $this->db->or_where("sample_for","Anti.Biotic");
        $query = $this->db->get();
		echo $this->db->last_query(); exit;*/
		
		$sql = "SELECT * FROM `samples` WHERE `sample_type` = '$type' AND `sample_for` = 'Micro'  AND Date(`created_at`) = '$date'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		
        $list = '<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">#</th>
										  <th scope="col">Sample ID</th>
										  <th scope="col">Batch Number</th>
										  <th scope="col">Sample Collected By</th>
										  <th scope="col">View</th>
										</tr>
									  </thead>
									  <tbody>';
        foreach ($query->result() as $row) {
            $list .= '
										<tr>
										  <td><input type="checkbox" name="sample_ids[]" id="sample_ids" value="'.$row->id.'"></td>
										  <td>'.$row->id.'</td>
										  <td>'.$row->batch_no.'</td>
										  <td>Vishnu</td>
										  <td>View</td>
										</tr>
										';
            
        }
		$list.='	
			  </tbody>
			</table>';
        $return_data['list'] = $list;
        return $return_data;
   } 
   

   public function fetch_daycodes($id)
    {
        $this->db->select('*');
        $this->db->from("export_day_code");
        $this->db->where("export_id=$id");
        $query = $this->db->get();
        $options = '';
        $lis = '';
        foreach ($query->result() as $row) {
            $options .= '<option value="' . $row->id . '">' . $row->day_code_name . '</option>';
            $lis .= '<li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text"> ' . $row->day_code_name . '</span></a></li>';
            
        }
        $return_data['select'] = $options;
        $return_data['ul'] = $lis;
        return $return_data;
    }
    public function fetch_soakings($plant_id, $date)
    {
        $this->db->select('*');
        $this->db->from("soakings");
        $this->db->where("plant_id=$plant_id");
        $this->db->where("date_format(created_at, '%Y-%m-%d')='$date'");
        $query = $this->db->get();
        $output = '<option value="">Select Soakings</option>';
        foreach ($query->result() as $row) {
            $output .= '<option data-id=' . $row->quantity . ' value="' . $row->id . '">' . $row->batch . ' - ' . $row->quantity . '</option>';
        }
        return $output;
    }
    public function fetch_soaking_qty($soaking_id)
    {
        $this->db->select('quantity');
        $this->db->from("soakings");
        $this->db->where("id=$soaking_id");
        $query = $this->db->get();
        // $output = '<option value="">Select Soakings</option>';
        // foreach ($query->result() as $row) {
        //     $output .= '<option data-id=' . $row->quantity . ' value="' . $row->id . '">' . $row->batch . ' - ' . $row->quantity . '</option>';
        // }
        return $query->result();
    }
}

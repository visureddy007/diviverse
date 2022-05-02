
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends CI_Controller
{


    function __Construct()
    {
        parent::__Construct();
        $this->comm_fun->is_not_logged_in();
        $this->uid = $this->session->userdata('avantiqc_user_id');
        $this->load->model('Common_model', 'common');
    }


    public function fetch_plants()
    {
        $data = $this->common->fetch_plants();
        return $data;
    }

    function fetch_daycodes()
    {
        $data = $this->common->fetch_daycodes($_POST['export_id']);
        print_r(json_encode($data));
    }

	function fetch_samples_ab_and_both(){
        $data = $this->common->fetch_samples_ab_and_both($_POST['sample_type'],$_POST['sample_date']);
        print_r(json_encode($data));
    }
	function fetch_samples_micro(){
        $data = $this->common->fetch_samples_micro($_POST['sample_type'],$_POST['sample_date']);
        print_r(json_encode($data));
    }
	
}
/* can this file be deleted ? smit?*/
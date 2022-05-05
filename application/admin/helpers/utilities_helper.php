<?php

function clean_ip($data){
	$ci =&get_instance();	
	$ci->load->helper('security');
	$data = $ci->security->xss_clean($data);
	$data = str_replace("[removed]","",$data);
	return $data;
	
}


function danger_msg($msg){
	return '<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<strong>Danger ! </strong><span class="alert-link">'.$msg.'</span>.
									</div>';
}
function warning_msg($msg){
	return '<div class="alert alert-warning alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<strong>Warning ! </strong><span class="alert-link">'.$msg.'</span>.
									</div>';
}
function success_msg($msg){
	return '<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<strong>Success ! </strong><span class="alert-link">'.$msg.'</span>
									</div>';
}

}
	
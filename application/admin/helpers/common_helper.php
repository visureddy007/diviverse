<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Generic function which returns the translation of input label in currently loaded language of user
 * @param $string
 * @return mixed
 */
function trans($string)
{
    $ci =& get_instance();
    return $ci->lang->line($string);
}
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

function cleanString($string) {
   $string = str_replace(' ', '-', $string); /* // Replaces all spaces with hyphens. */

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); /* // Removes special chars. */
}


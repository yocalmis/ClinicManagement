<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcs {

public function index($curr,$lng)
	{

  
	if($curr==""){
		
	$CI =& get_instance();
    $CI->load->library('session');
	$CI->session->set_userdata('currency',1);
	$CI->session->set_userdata('currency_icon',"€");
	$CI->session->set_userdata('currency_birim',"Euro");

		
	}
	
	
	if($lng==""){
		
				$CI =& get_instance();
				$CI->load->library('session');
				$CI->load->library("Language/Eng");
				$data["lang"]=$CI->eng->index(); 
				$CI->session->set_userdata('lng',$data["lang"]);	
				$CI->session->set_userdata('lng_turu',"Eng");						
	}
	
	
	
		
		
	}
	
	
	




function GetIP(){
 if(getenv("HTTP_CLIENT_IP")) {
 $ip = getenv("HTTP_CLIENT_IP");
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 $ip = getenv("HTTP_X_FORWARDED_FOR");
 if (strstr($ip, ',')) {
 $tmp = explode (',', $ip);
 $ip = trim($tmp[0]);
 }
 } else {
 $ip = getenv("REMOTE_ADDR");
 }
 return $ip;
}


	
	
}
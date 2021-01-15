<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency {

public function index($curr=null)
	{
		
				if($curr==""){
			
				$curr="euro";
			
				}		
		
		
				$curr=trim($curr); 		 $curr=htmlentities($curr);      $curr=strip_tags($curr); 
	


				$this->load->model('Curr_model');
				$kontrol=$this->Curr_model->kontrol($curr);	
			
			
				if($kontrol==FALSE){
			
				$curr="euro";
			
				}		
			
				$curr_miktar=$kontrol[0][$curr];
				$this->session->set_userdata('currency',$curr_miktar);
				$currency=$this->session->userdata('currency');	
				
				if($curr=="euro"){$icon="€";}
				if($curr=="dollar"){$icon="$";}
				if($curr=="pound"){$icon="£";}
				if($curr=="tl"){$icon="₺";}
				if($curr=="dinar"){$icon="dinar";}				
				if($curr=="ruble"){$icon="₽";}
				$this->session->set_userdata('currency_icon',$icon);
				$currency_icon=$this->session->userdata('currency_icon');					
				
				
			    echo $currency." ".$currency_icon;

		
		
	}
	



	
	
}
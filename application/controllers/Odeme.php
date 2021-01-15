<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Odeme extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
		


	

	}
	
   
			    public function index()
    {
		
		            $this->load->library('messages');
					$this->messages->config('Odeme/odeme');	
					return FALSE;
	}
	
	
			    public function odeme()
    {

        $online=$this->session->userdata('adminonline');
        if(empty($online))
        {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc=$this->admin_model->admin_query();

            if($sonuc){
         
            $this->messages->config('');	
            }
            else{
				
			 $this->messages->config('');
			
			}

        }

        else{
			
		if($this->session->userdata('odeme')!=1){
            $this->load->library('messages');	
		$this->messages->config('');
return FALSE;		
		}	
			
			  $crud = new grocery_CRUD();		
			
	
				$crud->set_table('borc_alacak');

         $data['side_menu']="SSS Ayarları";
         $data['kilavuz']="  <b>SSS Ayarları</b>";
		 $this->load->model('admin_model');		 
		 $data["sss"]=$this->admin_model->sss_getir();
		 
	     $this->session->set_userdata('odeme_miktar',322);		 
	     $this->session->set_userdata('uye_id',12);	
		 
         $data["odeme_miktar"]=$this->session->userdata('odeme_miktar');
         $data["uye_id"]=$this->session->userdata('uye_id');
		 
         $output = $crud->render();
         $output->data=$data;


          //  $this->_example_output($output);
		$this->load->view('odeme',(array)$output);
		
			

		
		
		
        }


    }
	
	
	
	
	
	
	
			    public function odeme_2()
    {
		
		
	        $online=$this->session->userdata('adminonline');
        if(empty($online))
        {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc=$this->admin_model->admin_query();

            if($sonuc){
         
            $this->messages->config('');	
            }
            else{
				
			 $this->messages->config('');
			
			}

        }

        else{	
		
		
			if($this->session->userdata('odeme')!=1){
            $this->load->library('messages');	
		$this->messages->config('');
return FALSE;		
		}	
		
	
		
         $data["odeme_miktar"]=$this->session->userdata('odeme_miktar');
         $data["uye_id"]=$this->session->userdata('uye_id');
	
	if($data["uye_id"]==""){

		            $this->load->library('messages');
					$this->messages->config('Odeme/odeme');	
					return FALSE;	
		
	}
	
	if(!is_numeric($data["uye_id"])){

		            $this->load->library('messages');
					$this->messages->config('Odeme/odeme');	
					return FALSE;	
		
	}	

	if($data["odeme_miktar"]==""){

		            $this->load->library('messages');
					$this->messages->config('Odeme/odeme');	
					return FALSE;	
		
	}
	
	if(!is_numeric($data["odeme_miktar"])){

		            $this->load->library('messages');
					$this->messages->config('Odeme/odeme');	
					return FALSE;	
		
	}	
	

$rakam=$data["odeme_miktar"];
require_once('C:\xampp\htdocs\otomasyon\bina\binayonetimi\application\libraries\iyzipay-php-master\samples\initialize_checkout_form.php');

    }
	  }
	
				    public function odeme_3()
    {


require_once('C:\xampp\htdocs\otomasyon\bina\binayonetimi\application\libraries\iyzipay-php-master\samples\config.php');

# create request class
$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$token = $_POST["token"];
$request->setToken($token);

# make request
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

# print result
//print_r($checkoutForm);


//print_r($checkoutForm->getStatus());
print_r($checkoutForm->getPaymentStatus());
//print_r($checkoutForm->getErrorMessage());




    }
	
	
	

	
	
	
		    public function odeme_al()
    {

        $online=$this->session->userdata('adminonline');
        if(empty($online))
        {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc=$this->admin_model->admin_query();

            if($sonuc){
         
            $this->messages->config('');	
            }
            else{
				
			 $this->messages->config('');
			
			}

        }

        else{


		if($this->session->userdata('odeme')!=1){
            $this->load->library('messages');	
		$this->messages->config('');
return FALSE;		
		}


require_once('C:\xampp\htdocs\otomasyon\bina\binayonetimi\application\libraries\iyzipay-php-master\samples\config.php');

# create request class
$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$token = $_POST["token"];
$request->setToken($token);

# make request
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

# print result
//print_r($checkoutForm);


//print_r($checkoutForm->getStatus());
//print_r($checkoutForm->getPaymentStatus());
//print_r($checkoutForm->getErrorMessage());


if($checkoutForm->getPaymentStatus()=="SUCCESS"){
	
			//db Tarih güncelle , session odeme durum güncelle	, yönlendir
		$this->session->set_userdata('odeme',2);	
		$this->load->library('messages');
        $this->messages->config('');
	
}

else{
	echo "İşlem Başarısız";
	echo"<a href='".base_url()."Odeme/odeme'></a>";
			//db Tarih güncelle , session odeme durum güncelle	, yönlendir

	
}


return FALSE;
		
			
	




		
		
		
        }


    }
	
	
	
	
	
}

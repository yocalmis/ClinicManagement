<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sec {

public function get()
	{

$parametreler = strtolower($_SERVER['QUERY_STRING']); //Adres satırından gelen tüm sorguları aldık.
$yasaklar="%¿¿'¿¿`¿¿insert¿¿concat¿¿delete¿¿join¿¿update¿¿select¿¿\"¿¿\\¿¿<¿¿>¿¿tablo_adim¿¿kolon_adim"; //Buraya tablo adlarınızı da ekleyiniz. Her ekleme sonrasını ¿¿ ile ayırmalısınız.
$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
$i++;	
}
if (strlen($parametreler)>=90) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;	
}

		
		
	}
	

public function post()
	{


$gelenpostlar='';
foreach ($_POST as $key => $value) {
$gelenpostlar=$gelenpostlar.' '.strtolower(htmlspecialchars($key)).' '.strtolower(htmlspecialchars($value));	
}
if (strstr($gelenpostlar,'union select')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
if (strstr($gelenpostlar,'_schema')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


/*****Tablo Adları ÇEK*******/

if (strstr($gelenpostlar,'acente_abone_eposta')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_currency')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_category')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_gecmis')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_istek')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_one_category')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
if (strstr($gelenpostlar,'acente_on_rez')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
if (strstr($gelenpostlar,'acente_on_rez_detay')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_puan_guv')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_puan_org')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_puan_para')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_puan_servis')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_rezervasyon')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_rezervasyon_detay')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}


if (strstr($gelenpostlar,'acente_sayfalar')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_sepet')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_sepet_detay')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'	acente_tur')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_tur_detay')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_tur_fotolar')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_uyeler')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_yardim')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'acente_yorumlar')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'tkn_mat_admin')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}

if (strstr($gelenpostlar,'tkn_mat_options')) {
header("location:".base_url().""); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}






/*****Tablo Adları ÇEK*******/




		
		
	}
	
	
	
	public function process()
	{
	$this->get();
	$this->post();	
	}
	
	
}
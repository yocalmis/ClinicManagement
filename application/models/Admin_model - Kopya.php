<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
         $this->load->database();
     }
	 
	 //Admin Varm� Yokmu Kontrol Et , Varsa Login'e Yoksa Kay�t sayfas�na y�nlendir
	 
	 
     
      function admin_query()
     {
   
        $sql = "SELECT * FROM tkn_mat_admin";
        $query = $this->db->query($sql);
        
        if( $query->num_rows() > 0 )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

   
   
   
     }

    function admin_register_before($username)
    {

        $sql = "SELECT * FROM tkn_mat_users Where username='$username'";
        $query = $this->db->query($sql);

        if( $query->num_rows() > 0 )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }




    }

		 
		 
		   function admin_info()
    {
        $sql = "SELECT * FROM tkn_mat_options";
        $query = $this->db->query($sql);
        
        if( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
		 
		 
		 
		 	 //Admin kaydet
		 
		 
         
              function admin_register($data)
     {
    $name=$this->db->escape_str($data[0]);
	$email=$this->db->escape_str($data[1]);
	$username=$this->db->escape_str($data[2]);
	$pass=$this->db->escape_str($data[3]);


	
	$insert=array(
	'name'=>$name,
	'username'=>$username,
	'pass'=>$pass,
	'email'=>$email
	
	);
	
	$into=$this->db->insert('tkn_mat_admin',$insert);
	if($into){return 1;}else{return 0;}



     }
     

	 
	 //Admin login kontrol
	 
     
     function admin_return($data)
     {
 

    $username=$this->db->escape_str($data[0]);
	$pass=$this->db->escape_str($data[1]);

	$query =$this->db->query("select * from tkn_mat_admin Where username='$username' and pass='$pass'");
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     }



		 //Admin login kontrol
	 
     
     function tur_return_id($id)
     {

	$query =$this->db->query("select * from acente_tur Where kod='$id'");
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     } 
	 
	   function tur_detay_return($tur_kod,$id)
     {

	$query =$this->db->query("select * from acente_tur_detay Where tur_kod=".$tur_kod." and id=".$id);
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     }  
	 
	 
	 
     
     function tur_return_adi($adi)
     {


	$query =$this->db->query("select * from acente_tur Where seo_adi='$adi'");
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     } 
	 
	     function tur_turu($id)
     {


	$query =$this->db->query("select * from acente_tur Where id='$id'");
foreach ($query->result_array() as $row)
{
        return $row['tur_donemi'];
}

   
     } 
	 
	 
	 	     function tur_turu_kod($id)
     {


	$query =$this->db->query("select * from acente_tur Where kod='$id'");
foreach ($query->result_array() as $row)
{
        return $row['tur_donemi'];
}

   
     } 
	 
	      function otel_fiyat_say($id)
     {


	$query =$this->db->query("select * from acente_tur_detay Where tur_kod=".$id);
	return $query->num_rows();

   
     } 
	 
	 
	 
	  function rez_varmi($id)
     {


	$query =$this->db->query("select * from acente_rezervasyon Where id=".$id."");
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     } 
	 
	 
		  function tur_kontrol($id,$kod,$adi)
     {


	$query =$this->db->query("select * from acente_tur Where id='$id' and kod='$kod' and seo_adi='$adi'");
    if ($query->num_rows() > 0)
    {return 1;}    else{return 0;}
    

   
     }  
	 
	 
	 
	 
	 
	 
	      function istek_say($id)   {


	$query =$this->db->query("select * from acente_istek Where tur_id='$id'");
    return $say=count($query->result_array());
   
     } 
	 
	 
	 
	 
	 
	 	  function mail_cikis($id,$ep1,$ep2)
     {

	 $ep=$ep1."@".$ep2;

	$query =$this->db->query("update acente_abone_eposta set durum=0 Where id='$id' and eposta='$ep'");
    if ($query)
    {return 1;}    
     else{return 0;}
    

   
     }  
	 
	 
	 
	 
	 
    function mail_getir()
    {

        $sql = "SELECT * FROM acente_abone_eposta Where durum=1";
        $query = $this->db->query($sql);

        if( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }




    }
	 
function resim_sil($foto_id,$tur_id,$foto_adi)
	 
	{

      	$query =$this->db->query("delete from acente_tur_fotolar Where id='$foto_id' and tur_id='$tur_id'");
		
		$q=unlink("assets/resimler/turlar/".$foto_adi);
    if ($q)
    {return 1;}    
     else{return 0;}



    } 
	 
	 
	 
	 
	         function resim_kaydet($id,$name,$kod)
     {
 

	$insert=array(
	'tur_id'=>$id,
	'foto'=>$name
	
	);
	
	$into=$this->db->insert('acente_tur_fotolar',$insert);
	if($into){return 1;}else{return 0;}



     }
	 
	 
	 
	 
	     function resim_getir($id)
    {

        $sql = "SELECT * FROM acente_tur_fotolar Where tur_id='$id'";
        $query = $this->db->query($sql);

        if( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }




    }
	 
	      function kategori_resim_query($primary_key)
     {
   
        $sql = "SELECT * FROM acente_category where id=".$primary_key."";
        $query = $this->db->query($sql);
        
        if( $query->num_rows() > 0 )
        {
          return $query->result_array();
        }
        else
        {
            return FALSE;
        }

   
   
   
     }
	 
	  
	      function tur_resim_query($primary_key)
     {
   
        $sql = "SELECT * FROM acente_tur where id=".$primary_key."";
        $query = $this->db->query($sql);
        
        if( $query->num_rows() > 0 )
        {
          return $query->result_array();
        }
        else
        {
            return FALSE;
        }

   
   
   
     }
	 
	 
	      function tur_yorum_sil($primary_key)
     {
   
        $sql = "DELETE FROM acente_yorumlar where tur_id=".$primary_key."";
		$sql = $this->db->query($sql);
      
        if(  $sql )
        {
          return TRUE;
        }
        else
        {
            return FALSE;
        }

   
   
   
     } 
	 
		      function tur_istek_sil($primary_key)
     {
   
        $sql = "DELETE FROM acente_istek where tur_id=".$primary_key."";
  		$sql = $this->db->query($sql);    
        if(  $sql )
        {
          return TRUE;
        }
        else
        {
            return FALSE;
        }

   
   
   
     } 
	 
	 
	 	      function tur_detay_sil($kod)
     {
   
        $sql = "DELETE FROM acente_tur_detay where tur_kod=".$kod."";
 		$sql = $this->db->query($sql);     
        if(  $sql )
        {
          return TRUE;
        }
        else
        {
            return FALSE;
        }

   
   
   
     } 
	 
	   function tur_foto_getir($primary_key)
     {
   
         $sql = "SELECT * FROM acente_tur_fotolar where tur_id=".$primary_key."";
        $query = $this->db->query($sql);
        
        if( $query->num_rows() > 0 )
        {
          return $query->result_array();
        }
        else
        {
            return FALSE;
        }

   
   
   
     } 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	  	 function sepet($id)
     {
		 
				$rezerve=$this->onrez_getir($id);

				
				$n=0;if( $rezerve ) :  foreach( $rezerve as $dizi ) : 
				$cart_detay_getir[$n]=$this->onrez_detay_getir($dizi["id"]);	
				$sil_detay = $this->db->query("delete from acente_on_rez_detay Where sepet_id=".$dizi["id"]);				 
				$n=$n+1; endforeach;  endif; 
				
				$sil_sepet = $this->db->query("delete from acente_on_rez Where id=".$id);		 


		
				$n=0;if( $rezerve ) :  foreach( $rezerve as $dizi ) : 


	$insert=array(
	
	'tur_id'=>$dizi["tur_id"], 
	'tur_kod'=>$dizi["tur_kod"],
	'kullanici_id'=>$dizi["kullanici_id"],
	'tur_detay_id'=>$dizi["tur_detay_id"],
	'yetiskin'=>$dizi["yetiskin"],
	'cocuk'=>$dizi["cocuk"],
	'bebek'=>$dizi["bebek"],	
	'tutar'=>$dizi["tutar"],
	'para_birimi'=>$dizi["para_birimi"],	
	'bas_tar'=>$dizi["bas_tar"],	
	'bit_tar'=>$dizi["bit_tar"],		
	'baslangic_saati'=>$dizi["baslangic_saati"],	
	'bitis_saati'=>$dizi["bitis_saati"],
	'indirimsiz'=>$dizi["indirimsiz"]
	);
	$into=$this->db->insert('acente_sepet',$insert);	

		$son_id = $this->db->insert_id();



		
					$m=0;if( $cart_detay_getir[$n] ) :  foreach( $cart_detay_getir[$n] as $dizi2 ) : 
				
		
	$insert2=array(
	
	'sepet_id'=>$son_id, 
	'eriskin'=>$dizi2["eriskin"],
	'adi'=>$dizi2["adi"],
	'soyadi'=>$dizi2["soyadi"],
	'email'=>$dizi2["email"],
	'tel'=>$dizi2["tel"],
	'sehir'=>$dizi2["sehir"]

	);
	$into2=$this->db->insert('acente_sepet_detay',$insert2);	
	
		
						$m=$m+1; endforeach;  endif; 

		
		
		
		
		
		
		
		
		

				
				$n=$n+1; endforeach;  endif; 
		
		
		
		return TRUE;
	
	 }
	
	
	
		 	 function onrez_detay_getir($id)
     {
	
		$query = $this->db->query("select * from acente_on_rez_detay Where sepet_id=".$id);
        if( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
	
	 }
	
	
	
	
	 
	 
	 
	 	 	 	 function onrez_getir($id)
     {
	
$query =$this->db->query("select * from acente_on_rez Where id=".$id);
        if( $query->num_rows() > 0 )
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
	
	 } 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
}
?>
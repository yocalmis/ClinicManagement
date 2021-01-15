<?php error_reporting(0);
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// error_reporting(0);
?>

<?php  $this->load->view('admin/header.php'); ?>	
<link rel="stylesheet" href="<?php echo base_url() ?>assets/surukle_birak/css/style.css">

	

<script type="text/javascript">

	function kontrolet(){

		//var ep=$('#ep').val();  
		var bas=$('#bas').val(); 
		var ice=$('#ice').val();
	
		if( (bas=='') || (ice=='') ){ 

			//	if(ep==''){$("#ep").css("background-color","#66CCFF");}else{$("#ep").css("background-color","#FFFFFF"); }
			if(bas=='') {
				$("#bas").css("background-color","#66CCFF");
			}
			else {
				$("#bas").css("background-color","#FFFFFF"); 
			}
			if(ice=='') {
				$("#ice").css("background-color","#66CCFF");
			}
			else {
				$("#ice").css("background-color","#FFFFFF"); 
			}

		}
		else { 
			$('#myform').removeAttr("onsubmit"); 
		}
				
	}

	function kontrolet_2(){

		var ep=$('#sms').val();  
		var ice=$('#ice_sms').val();		

		if (ice=='') { 
			if(ice=='') {
				$("#ice").css("background-color","#66CCFF");
			}
			else {
				$("#ice").css("background-color","#FFFFFF"); 
			}

		}
		else { 

			$('#myform_2').removeAttr("onsubmit"); 

		}
			
	}

</script>			



<div class="form-title-left"><a><?php echo $s_adi; ?> turuna ait resimler</a></div>

<form id="upload" method="post" action="<?php echo base_url(); ?>admin/admin/fotolar_upload" enctype="multipart/form-data">
	<div id="drop">
		Sürükle 
		<a>Aç</a>
		<span>Resim Büyüklükleri 650 * 300</span>
		<input type="file" name="upl" multiple />
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>		
		<input type="hidden" name="adi" value="<?php echo $s_adi; ?>"/>	
		<input type="hidden" name="kod" value="<?php echo $kod; ?>"/>	
	</div>

	<ul><!-- The file uploads will be shown here --></ul>
	<button class="y_r_y_b">Yükle</button>
</form>




<div class="y-n_r_i">				
	<?php if( $foto ) :  foreach( $foto  as $dizi ) : ?>	
		<div class="y_r_m">

			<img src="<?php echo base_url(); ?>assets/resimler/turlar/<?php  echo $dizi['foto']; ?>">

			<a href="<?php echo base_url(); ?>admin/admin/foto_sil/<?php  echo $id; ?>/<?php  echo $kod; ?>/<?php  echo $s_adi; ?>/<?php  echo $dizi['id']; ?>/<?php  echo $dizi['tur_id']; ?>/<?php  echo $dizi['foto']; ?>"><i>close</i></a>
			
		</div>

	<?php endforeach;  endif; ?>
</div>
  <!-- SURUKLE BIRAK -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/surukle_birak/js/jquery.knob.js"></script>
   <script src="<?php echo base_url(); ?>assets/surukle_birak/js/jquery.ui.widget.js"></script>
   <script src="<?php echo base_url(); ?>assets/surukle_birak/js/jquery.iframe-transport.js"></script>
   <script src="<?php echo base_url(); ?>assets/surukle_birak/js/jquery.fileupload.js"></script>
   <script src="<?php echo base_url(); ?>assets/surukle_birak/js/script.js"></script>
<?php  $this->load->view('admin/footer.php'); ?>
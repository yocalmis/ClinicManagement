<?php error_reporting(0);
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// error_reporting(0);
?>


<?php  $this->load->view('header.php'); ?>	

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script type="text/javascript">

	function kontrolet(){

		//var ep=$('#ep').val();
		var bas=$('#bas').val();
		var ice=$('#ice').val();		
		if( (bas=='') || (ice=='') ){ 
			if(bas==''){
				$("#bas").css("border-color","#B33A3A");
			}
			else {
					$("#bas").css("border-color","#FFFFFF"); 
			}
			if(ice==''){
				$("#ice").css("border-color","#B33A3A");
			}
			else{
				$("#ice").css("border-color","#FFFFFF"); 
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
				if(ice==''){
					$("#bas").css("border-color","#B33A3A");
				}
				else{
					$("#ice").css("border-color","#FFFFFF"); 
				}
			}
			
			else {
				$('#myform_2').removeAttr("onsubmit");
			}
			
		}
</script>

<div class="">
	<form class="ep_g"  id="myform" action="mail_gonder" method="POST" onsubmit="return false;" >
		<div class="form-title-left">
			<a>E-Posta Gönder</a>
		</div>
		<div class="msg_s-msg_ep">

			<div class="msg_hdr">
				<input id="bas" name="bas" type="text" placeholder="Konu Başlığı">
			</div>
			
			<select class="m_s_msg" name="epostalar[]" multiple placeholder="Maillerinizi Gönderin">
				<?php if( $mail ) :  foreach( $mail  as $dizi ) : ?>	
					<option value="<?php  echo $dizi['id'] ?>-<?php  echo $dizi['eposta'] ?>">
						<?php  echo $dizi['eposta'] ?>
					</option>
				<?php endforeach;  endif; ?>
			</select>
		</div>


		<div class="ck_msg">
			<!-- Göndermek İstediğiniz Mesaj -->
			<textarea id="ice" name="ice" rows="10" cols="40"></textarea>
		</div>

		<div class="msg_s_btn">
			<!--Bu input'tu button yaptım!!-->
			<button onclick="kontrolet()" type="submit" name="action">Gönder</button> 
		</div>
	</form>
</div>
 			
<script src="http://localhost/acente/assets/grocery_crud/texteditor/ckeditor/ckeditor.js"></script> 
<script>
//    CKEDITOR.replace( 'ice' );	
var editor = CKEDITOR.replace('ice',
{


	toolbar :
	[
	{ name: 'document', items : [ 'Preview' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
	{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] },
	'/',
	{ name: 'styles', items : [ 'Styles','Format' ] },
	{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'tools', items : [ 'Maximize','-','About' ] }

	],
	width: "auto",	
	height: "200px"

});

</script>

	<?php  $this->load->view('footer.php'); ?>			
				
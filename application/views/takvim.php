<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Klinik Yönetimi</title>

<style type="text/css">

/* BU DIS KUTU BLOK YERINE */
#takvim {
	display:block;	
	font-family: Georgia, "Times New Roman", Times, serif;
	min-width:25;
}

/* BU ACILIR KUTUNUN (AY VE YIL) FONT BUYUKLUGU */
#takvim select.ui-datepicker-year, #takvim select.ui-datepicker-month {
	font-size:12px;	
}

#takvim>div {
	float:left;
	display:inline-block;
	margin:3px;
}

</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/takvim/jquery.js"></script> <!-- bunu tekrar cagirmaya gerek yok zaten cagrili  -->
<!-- TAKVIM JS LERI -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/takvim/ui/ui.css">
<script src="<?php echo base_url(); ?>assets/takvim/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>assets/takvim/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>assets/takvim/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/takvim/ui/jquery.ui.datepicker-tr.js"></script> <!-- TURKCE DIL DOSYASI -->
<script>
  // ornekler /////////////////////////
  // Normal
	$(function() {
		$( "#datepicker" ).datepicker({

		});

	////
	
	
	// bugun butonlu (today)
	$( "#datepicker2" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true
		});

	
	
	// 2 takvim birden
		$( "#datepicker3" ).datepicker({
				numberOfMonths: 2,  // adet
			showButtonPanel: true
		});
		
	// acilir kutu
		$( "#datepicker4" ).datepicker({

		});
				
	});
	

			
			
	</script>
    
</head>

<body>
<div id="takvim">
	<div id="datepicker">
    
    </div>

	<!--<div id="datepicker2">
    
    </div>
    

	<div id="datepicker3">
    
    </div>
    <br clear="all" />
    <label for="datepicker4">Tarih:</label>
    <input type="text" id="datepicker4" />-->
</div>




</body>
</html>

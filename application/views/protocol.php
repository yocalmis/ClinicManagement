<?php  $this->load->view('header.php'); ?>	


<!DOCTYPE html>
<html>
<head>
	<title>Klinik</title>
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';"><?php echo $data["pn"]; ?> numaralı protokol - <?php echo $data["ad"]; ?></h2>
		<p>Doktor Adı: <a href="<?php echo base_url(); ?>yonetim/cari/read/<?php echo $data["dr_id"]; ?>"><?php echo $data["dr_ad"]; ?></a><br>
		 Hasta Adı: <a href="<?php echo base_url(); ?>yonetim/cari/read/<?php echo $data["hs_id"]; ?>"><?php echo $data["hasta_ad"]; ?></a></p>
	</div>


	
	
	<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
</head>
<body>
<!--
<h2>Tabs</h2>
<p>Click on the buttons inside the tabbed menu:</p>
-->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'rnd')">Randevu </button>
  <button class="tablinks" onclick="openCity(event, 'mua')">Muayene</button> 
     <button class="tablinks" onclick="openCity(event, 'olc')">Ölçüm</button>  
     <button class="tablinks" onclick="openCity(event, 'dos')">Dosya</button> 
   <button class="tablinks" onclick="openCity(event, 'rap')">Rapor</button> 
  <!--   <button class="tablinks" onclick="openCity(event, 'rec')">Reçeteler</button>  	 
 <button class="tablinks" onclick="openCity(event, 'bo')">Borç - Alacak</button>-->
  <button class="tablinks" onclick="openCity(event, 'ta')">Finans</button>
  

  
</div>

<script>

var veriler="";
$.ajax({ 
type: "POST", 
url: "http://localhost/klinik/yonetim/randevu_xx", 
data: veriler, 
success:function(cevap){ 

//$(".xxx").html(""+cevap); 
} 
})

</script>

<div class="xxx">

</div>

<div id="Randevu" class="tabcontent">
  <h3>Randevular</h3>
  <p>

		
  <p>
</div>

<div id="Boal" class="tabcontent">
  <h3>Paris</h3>
  <p>aa </p> 
</div>

<div id="Tah" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Muay" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Olc" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Rap" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Dos" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Rec" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

<br>

<?php if($data['side_menu']=="Cari İşlemleri Ayarları"){ ?>
	<button onclick="window.location.href = '<?php echo base_url(); ?>yonetim/cari_borc_alacak/add/<?php echo $data["cari_id"]; ?>';">Borçlandır - Alacaklandır</button>
	<button onclick="window.location.href = '<?php echo base_url(); ?>yonetim/cari_tahsilat_odeme/add/<?php echo $data["cari_id"]; ?>';">Tahsilat - Ödeme Yap</button>
	<br><br>
<?php  echo "Cari Açılış Bakiyesi: ".$data["cari_baslangic"]." ".$this->session->userdata('para_birim')."";   } ?>


<?php echo $output; ?>




<?php if($data['side_menu']=="Cari İşlemleri Ayarları"){ ?>
<?php  		echo "<div style='float:right; padding-top:30px; padding-right:75px; padding-bottom:75px;'><b>".$data["cari_adi"]." - ".$data["cari_total"]."</b></div>"; ?>
<?php } ?>






<script>
function openCity(evt, url) {

var base="<?php echo base_url(); ?>";
var id="<?php echo $data["id"]; ?>";
var pn="<?php echo $data["pn"]; ?>";

window.location = base+"yonetim/protocol_detay/"+url+"/"+id+"/"+pn;
}
</script>
   
</body>
</html> 
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>

<br><br>



<?php  $this->load->view('footer.php'); ?>	
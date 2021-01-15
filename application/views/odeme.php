<?php  $this->load->view('header_ozel.php'); ?>	

<h2><?php echo $data["uye_id"]; ?> Kullanım süreniz sona ermiştir ,
<br>
Sistemi kullanmaya devam edebilmek için <?php echo $data["odeme_miktar"]; ?> TL ödeme Yapınız.<br> Ödemeyi tamamlamak için 

<form action="<?php echo base_url(); ?>Odeme/odeme_2" method="Post">
<input type="hidden" name="id" value="<?php echo $data["uye_id"]; ?>" >
<input type="hidden" name="amount" value="<?php echo $data["odeme_miktar"]; ?>" >
<input type="submit"  value="Tıklayınız" >

</form>





<?php  $this->load->view('footer_ozel.php'); ?>	
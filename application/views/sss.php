<?php  $this->load->view('header_ozel.php'); ?> 

<h2>Kullanım Kılavuzu</h2>

<div class="accordion__inner">

  <?php if( $data["sss"] ) :  foreach( $data["sss"] as $dizi ) :  ?>

    <button class="accordion"><?php echo $dizi["soru"]; ?></button>

    <div class="panel">
      <p><?php echo $dizi["cevap"]; ?></p>
    </div>

  <?php endforeach; endif; ?>

</div>

<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      panel.classList.toggle("active__panel");
      if (panel.style.maxHeight){
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      } 
    });
  }
</script>





<?php  $this->load->view('footer_ozel.php'); ?> 
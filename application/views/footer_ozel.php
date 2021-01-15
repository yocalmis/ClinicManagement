<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

 </div>  
</main> 
<div class="s-n_o"></div> 
<script> 
  "use strict";

  document.body.onload = function () {
    setTimeout(function () {
      var preloader = document.getElementById('preloader');

      if (!preloader.classList.contains('done')) {
        preloader.classList.add('done');
        setTimeout(function () {
          preloader.parentNode.removeChild(preloader);
        }, 300);
      }
    }, 150);
  };
</script> 

<script type="text/javascript" src="<?php echo site_url('assets') ?>/simplebar.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('assets') ?>/jquery-3.4.1.min.js"></script> 
<script type="text/javascript" src="<?php echo site_url('assets') ?>/jquery.sumoselect.min.js"></script> 
<script type="text/javascript" src="<?php echo site_url('assets') ?>/function.js"></script> 
 

</body>
</html>

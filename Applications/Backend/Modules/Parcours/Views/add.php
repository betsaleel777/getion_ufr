<div class="outer-w3-agile mt-3">
 <?php if(isset($form)){ echo $form ; } ?>
</div>
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <center><h3> <?php if(isset($title)){ echo $title ; } ?></h3></center>
 <?php if(isset($form)){ echo $form ; } ?>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>


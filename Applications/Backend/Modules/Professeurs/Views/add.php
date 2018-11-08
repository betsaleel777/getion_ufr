<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
 <?php if(isset($form)){ echo $form ; } ?>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>
<script src="js/datepicker.min.js"></script>
<script type="text/javascript">
$( "#id_date_naissance" ).datepicker({
  changeYear: true,
  yearRange: "1930:2022"
});
</script>

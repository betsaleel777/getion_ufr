<div class="outer-w3-agile mt-3">
  <a href="ecuesAdd.html"><i class="fas fa-plus fa-sm"></i>ajouter</a>
</div>
<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
    <h4 class="tittle-w3-agileits mb-4"><?php if(isset($titre)){ echo $titre ;} ?></h4>
    <?php if(isset($tableau)){ echo $tableau ;}else{ echo "les styliste vont s'en occupé"; } ?>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

<div class="outer-w3-agile mt-3">
  <div class="row">
    <div class="col-md-2">
      <a href="parcoursAdd.html" class="btn btn-primary"><i class="fas fa-plus"></i>ajouter</a>
    </div>
    <div class="col-md-2">
      <a href="semestres_parcoursAdd.html" class="btn btn-primary"><i class="fas fa-plus"></i> ajouter semestre parcours</a>
    </div>
  </div>
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

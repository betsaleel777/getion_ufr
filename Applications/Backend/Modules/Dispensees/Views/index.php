<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <a href="dispenseesAdd.html">ajouter</a>
</div>
<div class="outer-w3-agile mt-3">
    <h4 class="tittle-w3-agileits mb-4"><?php if(isset($titre)){ echo $titre ;} ?></h4>
    <?php if(isset($tableau)){ echo $tableau ;} ?>
</div>

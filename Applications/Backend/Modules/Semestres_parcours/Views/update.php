<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <center><h3><?php if(isset($title)){echo $title;}?></h3></center>
  <form method="post">
      <input type="hidden" name="uniqid" <?php if(isset($uniqid)){ echo 'value="'.$uniqid.'"' ;} ?>>
      <div class="form-group">
        <label for="firstName"><strong>Nom:</strong></label>
        <input <?php if(isset($old)){ $texte ='value="%s"' ; echo sprintf($texte,$old['nom']); } ?> type="text" class="form-control" id="firstName" placeholder="" name="nom" required="">
        <?php if(isset($semestre_parcour)){ echo $semestre_parcour::MESSAGE_ERREUR_NOM ; } ?>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1"><strong>Parcours:</strong></label>
        <?php if(isset($semestre_parcour)){ echo $semestre_parcour::MESSAGE_ERREUR_PARCOUR ; } ?>
        <select  name="parcour" onchange="loadSemestre(this.value);" class="form-control" id="exampleFormControlSelect1">
          <option selected <?php if(isset($old)){ $texte = 'value="%d"' ; echo sprintf($texte,$old['parcour']); } ?> ><?php if(isset($old)){ echo $old['parcoursString']; } ?></option>
          <?php
          if(isset($parcours)){
            foreach ($parcours as $parcour) {
              $texte = '<option value="%d">%s</option>' ;
              echo sprintf($texte,$parcour['parcour'],$parcour['nom']) ;
            }
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="semestres"><strong>Semestre correspondant:</strong></label>
        <?php if(isset($semestre_parcour)){ echo $semestre_parcour::MESSAGE_ERREUR_SEMESTRE ; } ?>
        <select name="semestres_niveau" class="form-control" id="semestres">
          <option selected <?php if(isset($old)){ $texte = 'value="%d"' ; echo sprintf($texte,$old['semestre_niveau']); } ?>><?php if(isset($old)){ echo $old['semestre']; } ?></option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect3"><strong>Domaine:</strong></label>
        <?php if(isset($semestre_parcour)){ echo $semestre_parcour::MESSAGE_ERREUR_DOMAINE ; } ?>
        <select name='domaine' class="form-control" id="exampleFormControlSelect3">
        <option selected <?php if(isset($old)){ $texte = 'value="%d"' ; echo sprintf($texte,$old['domaine']); } ?>><?php if(isset($old)){ echo $old['domaineString']; } ?></option>
        <?php
        if(isset($domaines)){
          foreach ($domaines as $domaine) {
            $texte = '<option value="%d">%s</option>' ;
            echo sprintf($texte,$domaine['id'],$domaine['nom']) ;
          }
        }
        ?>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </div>
    </form>
</div>
<script src="js/loadSemestre.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

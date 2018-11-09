<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
    <h4 class="tittle-w3-agileits mb-4"><i class="fas fa-plus"></i>Ajouter une UE</h4>
    <form action="#" method="post">
      <input type="text" name="uniqid" value="<?php echo $uniqid ; ?>" hidden>
      <input type="text" name="annee" value="<?php echo $annee ; ?>" hidden>
      <div class="form-group">
        <label for="inputAddress">Code:</label>
        <?php
        $ue = new \Library\Entities\Ues() ;
        if(isset($erreurs)){ if(in_array($ue::ERREUR_CODE,$erreurs)){ echo $ue::MESSAGE_ERREUR_CODE ; } }  ?>
        <input type="text" name="code" class="form-control" id="inputAddress"  required="">
      </div>
      <div class="form-group">
        <label for="nom">Nom:</label>
        <?php if(isset($erreurs)){ if(in_array($ue::ERREUR_NOM,$erreurs)){ echo $ue::MESSAGE_ERREUR_NOM ; } } ?>
        <input type="text" name="nom" class="form-control" id="nom"  required="">
      </div>
      <div class="form-group">
          <label for="inputState">Semestre Parcours</label>
          <select name="semestre_parcour" id="inputState" class="form-control">
            <option selected value="choix">choix ....</option>
            <?php
            if(isset($semestres)){
              foreach ($semestres as $semestre) {
                $texte = '<option value="%d">%s</option>' ;
                echo sprintf($texte,$semestre['id'],$semestre['nom']) ;
              }
            }
            ?>
          </select>
        </div>
        <div class="row">
         <div class="col-md-10"></div>
         <div class="col-md-2">
             <button id="ecueCreateButton" type="button" onclick="formulaire();" class="btn btn-primary">Créer ECUE</button>
         </div>
        </div>
        <div id="ecueContent"></div>
      <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>
<script src="js/ecueForm.js"></script>
<script src="js/automatic.js"></script>

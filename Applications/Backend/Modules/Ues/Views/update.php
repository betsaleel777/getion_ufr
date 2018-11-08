<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
    <h4 class="tittle-w3-agileits mb-4">Ajouter une UE</h4>
    <form action="#" method="post">
      <input type="text" name="uniqid" value="<?php echo $uniqid ; ?>" hidden>
      <input type="text" name="ue" value="<?php echo $needs['id'] ; ?>" hidden>
      <input type="text" name="annee" value="<?php echo $annee ; ?>" hidden>
      <input type="text" name="dispenseeId" value="<?php echo $needs['dispenseeId'] ; ?>" hidden>
      <div class="form-group">
        <label for="inputAddress">Code:</label>
        <?php
        $ue = new \Library\Entities\Ues() ;
        if(isset($erreurs)){ if(in_array($ue::ERREUR_CODE,$erreurs)){ echo $ue::MESSAGE_ERREUR_CODE ; } }  ?>
        <input <?php $texte='value="%s"'; echo sprintf($texte,$needs['code']) ?> type="text" name="code" class="form-control" id="inputAddress"  required="">
      </div>
      <div class="form-group">
        <label for="inputAddress2">Nom:</label>
        <?php if(isset($erreurs)){ if(in_array($ue::ERREUR_NOM,$erreurs)){ echo $ue::MESSAGE_ERREUR_NOM ; } } ?>
        <input <?php $texte='value="%s"'; echo sprintf($texte,$needs['nom']) ?> type="text" name="nom" class="form-control" id="inputAddress2"  required="">
      </div>
      <div class="form-group">
          <label for="inputState">Semestre Parcours</label>
          <select name="semestre_parcour" id="inputState" class="form-control">
            <option selected <?php $texte='value="%d"'; echo sprintf($texte,$needs['idSempar']) ?>><?php echo $needs['sempar'] ; ?></option>
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
        <?php
          if(isset($ecues)){
            $max = count($ecues) ;
            for ($i=0; $i <$max ; $i++) {
          ?>
          <h3 class="tittle-w3-agileits mb-4">ECUE <?php echo $i+1 ; ?></h3>
          <div class="form-group">
            <label for="inputName">Nom ECUE:</label>
            <input type="text" hidden <?php $texte='name="id%d"'; echo sprintf($texte,$i+1) ; ?> <?php $texte='value="%d"'; echo sprintf($texte,$ecues[$i]['id']) ; ?> >
            <input type="text" <?php $texte='name="nomEcue%d"'; echo sprintf($texte,$i+1) ; ?> class="form-control" id="inputName"
              <?php $texte='value="%s"'; echo sprintf($texte,$ecues[$i]['nom']) ?> required="">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCm">Heures CM</label>
              <input type="text" <?php $texte='name="cm%d"'; echo sprintf($texte,$i+1) ; ?> class="form-control" id="inputCm"
               <?php $texte='value="%s"'; echo sprintf($texte,$ecues[$i]['cm']) ?> required="">
            </div>
            <div class="form-group col-md-4">
              <label for="inputtp">Heures TP</label>
              <input type="text" <?php $texte='name="tp%d"'; echo sprintf($texte,$i+1) ; ?> class="form-control" id="inputtp"
              <?php $texte='value="%s"'; echo sprintf($texte,$ecues[$i]['tp']) ?> >
            </div>
            <div class="form-group col-md-4">
              <label for="inputtd">Heures TD</label>
              <input type="text" <?php $texte='name="td%d"'; echo sprintf($texte,$i+1) ; ?> class="form-control" id="inputtd"
               <?php $texte='value="%s"'; echo sprintf($texte,$ecues[$i]['td']) ?> >
            </div>
          </div>
          <div class="form-group">
            <label for="inputCredit">Credits:</label>
            <input type="text" <?php $texte='name="credits%d"'; echo sprintf($texte,$i+1) ; ?> class="form-control" id="inputCredit"
            <?php $texte='value="%d"'; echo sprintf($texte,$needs['idSempar']) ?> required="">
          </div>
         <?php
            }
          }
         ?>
        <div id="ecueContent"></div>
      <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

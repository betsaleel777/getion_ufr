<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <center><h3><?php if(isset($title)){echo $title;}?></h3></center>
      <div class="row">
      <div class="col-6">
        <form method="post">
            <input type="hidden" name="uniqid" <?php if(isset($uniqid)){ echo 'value="'.$uniqid.'"' ;} ?>>
            <div class="form-group">
              <label for="annee"><strong>Année universitaire:</strong></label>
              <?php if(isset($dispensee)){ echo $dispensee::MESSAGE_ERREUR_ANNEE ; } ?>
              <select name="annees_universitaires" class="custom-select" id="annee">
                <option selected value="choix">choix ....</option>
                <?php
                if(isset($annees_universitaires)){
                  foreach ($annees_universitaires as $annee_universitaire) {
                    $texte = '<option value="%d">%s</option>' ;
                    echo sprintf($texte,$annee_universitaire['id'],$annee_universitaire['nom']) ;
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="semestre"><strong>Semestre Parcour:</strong></label>
              <?php if(isset($dispensee)){ echo $dispensee::MESSAGE_ERREUR_SEMESTRE ; } ?>
              <select name="semestre_parcour" class="custom-select" id="semestre">
                <option selected value="choix">choix ....</option>
                <?php
                if(isset($semestres_parcours)){
                  foreach ($semestres_parcours as $semestre_parcour) {
                    $texte = '<option value="%d">%s</option>' ;
                    echo sprintf($texte,$semestre_parcour['id'],$semestre_parcour['nom']) ;
                  }
                }
                ?>
              </select>
            </div>
                <div class="form-group">
                   <label for="ue"><strong>UES assignées:</strong></label>
                   <?php if(isset($dispensee)){ echo $dispensee::MESSAGE_ERREUR_UE ; } ?>
                   <select id="ue" class="custom-select form-control">
                     <option selected value="choix">choix ....</option>
                     <?php
                     if(isset($ues)){
                       foreach ($ues as $ue) {
                         $texte = '<option value="%d">(%s)  %s</option>' ;
                         echo sprintf($texte,$ue['id'],$ue['code'],$ue['nom']) ;
                       }
                     }
                     ?>
                   </select>
                 </div>
                <div class="col-2 col-md-2">
                <div class="form-group">
                  <button type="button" onclick="assigner();" class="btn btn-primary mb-2">assigner</button>
                </div>
                </div>
          </form>
        </div>
       <div class="col-6">
        <ul class="list-group mb-3" id='listing'>
        </ul>
       </div>
         </div>
      <div class="row">
        <div class="col-4 col-md-4">
        </div>
        <div class="col-4 col-md-4">
          <div class="form-group">
            <button type="button" onclick="enregistrer();" class="btn-lg btn-primary mb-2">Submit</button>
          </div>
        </div>
        <div class="col-4 col-md-4"></div>
      </div>
</div>
<script src="js/assignation.js"></script>
<script src="js/poubelle.js"></script>
<script src="js/enregistrer.js"></script>
<script src="js/jquery-customselect.js"></script>
					<script>
          (function($) {
            $(function() {
            $("#semestre,#ue,#annee").customselect({
            "csclass":"custom-select",  // Class to match
            "search": true, // Is searchable?
            "numitems":     5,    // Number of results per page
            "searchblank":  false,// Search blank value options?
            "showblank":    true, // Show blank value options?
            "searchvalue":  false,// Search option values?
            "hoveropen":    false,// Open the select on hover?
            "emptytext":    "",   // Change empty option text to a set value
            "showdisabled": true,// Show disabled options
          });
            });
})(jQuery);
					</script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/bootstrap-notify.min.js"></script>
          <script src="js/notifier.js"></script>

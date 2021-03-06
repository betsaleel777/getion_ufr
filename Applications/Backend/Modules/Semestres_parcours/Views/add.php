<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <center><h3><?php if(isset($title)){echo $title;}?></h3></center>
  <form method="post">
      <input type="hidden" name="uniqid" <?php if(isset($uniqid)){ echo 'value="'.$uniqid.'"' ;} ?>>
      <div class="form-group">
        <label for="firstName"><strong>Nom:</strong></label>
        <input readonly type="text" class="form-control" id="firstName" placeholder="" name="nom" required="">
      </div>
      <div class="form-group">
        <label for="parcour"><strong>Parcours:</strong></label>
        <select name="parcour" onchange="loadSemestre(this.value);" class="form-control" id="parcour">
          <option selected value="choix">choix ....</option>
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
        <select onchange="nommer();" name="semestres_niveau" class="form-control" id="semestres">
          <option selected value="choix">choix ....</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect3"><strong>Domaine:</strong></label>
        <select name='domaine' class="form-control" id="exampleFormControlSelect3">
        <option selected value="choix">choix ....</option>
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
<script type="text/javascript">
 function nommer(){
    var semestreSelect = document.getElementById('semestres') ;
    var parcoursSelect = document.getElementById('parcour') ;
    var parcour = parcoursSelect.options[parcoursSelect.selectedIndex].value ;
    var semestre = semestreSelect.options[semestreSelect.selectedIndex].value ;
    var parcourText = parcoursSelect.options[parcoursSelect.selectedIndex].text ;
    var semestreText = semestreSelect.options[semestreSelect.selectedIndex].text ;
   if( semestre !=='choix' && parcour !=='choix'){
     document.getElementById('firstName').value=parcourText + ' ' + semestreText ;
   }
 }
</script>
<script src="js/jquery-customselect.js"></script>
<script>
          (function($) {
            $(function() {
            $("#parcour").customselect({
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

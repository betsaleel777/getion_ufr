<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
 <?php if(isset($form)){ echo $form ; } ?>
 <h4 class="tittle-w3-agileits mb-4">Assigner les Ecues</h4>
 <div class="row">
 <div class="col-6">
 <form method="post">
      <div class="form-group">
        <input id="id" type="hidden" name="id" <?php if(isset($id)){ echo 'value="'.$id.'"' ;} ?>>
        <label for="ecue"><strong>Ecues:</strong></label>
        <select name='ecues' class="custom-select" id="ecue">
          <option selected value="choix">choix ....</option>
          <?php
          if(isset($ecues)){
            foreach ($ecues as $ecue) {
              $texte = '<option value="%d">%s (%s)</option>' ;
              echo sprintf($texte,$ecue['id'],$ecue['nom'],$ecue['code_ecue']) ;
            }
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <button onclick="assignerEcue();" type="button" class="btn-xs btn-primary mb-2"><i class="fas fa-plus fa-xs"></i></button>
      </div>
      <!-- <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </div> -->
    </form>
 </div>
 <div class="col-6" >
  <ul class="list-group mb-3" id='listing'>
    <?php if(isset($oldEcues)){
      $max = count($oldEcues) ;
      for ($i=0; $i < $max ; $i++) {
        $texte = '<li class="list-group-item d-flex justify-content-between lh-condensed">
                   <div>
                    <h6 class="my-0">%s</h6>
                    <small class="text-muted" hidden>%d</small>
                    <em hidden>%d</em>
                   </div>
                   <span class="text-muted">
                    <button class="btn-xs btn-primary mb-2" type="button" onclick="poubelle(this.parentElement)">
                     <i class="fas fa-trash"></i>
                    </button>
                   </span>
                  </li>' ;
        echo sprintf($texte,$oldEcues[$i]['nom'],$oldEcues[$i]['ecue'],$oldEcues[$i]['id']) ;
      }
    } ?>
  </ul>
 </div>
 </div>
 <button  onclick="updateProf()" class="btn btn-primary btn-lg btn-block" type="button">Validation de l'ajout</button>
 </div>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-notify.min.js"></script>
 <script src="js/poubelle.js"></script>
 <script src="js/assignationEcueProf.js"></script>
 <script src="js/updateProfesseur.js"></script>
 <script src="js/notifier.js"></script>
 <script src="js/datepicker.min.js"></script>
 <script type="text/javascript">
 $( "#id_date_naissance" ).datepicker({
  changeYear: true,
  changeMonth: true,
  yearRange: "1930:2000"
 });
 </script>
 <script src="js/jquery-customselect.js"></script>
 <script>
          (function($) {
            $(function() {
            $("#ecue").customselect({
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

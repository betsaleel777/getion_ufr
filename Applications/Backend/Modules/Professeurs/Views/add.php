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
        <input type="hidden" name="id" <?php if(isset($id)){ echo 'value="'.$id.'"' ;} ?>>
        <label for="ecue"><strong>Ecues:</strong></label>
        <select name='ecues' class="custom-select" id="ecue">
          <option selected value="choix">choix ....</option>
          <?php
          if(isset($ecues)){
            foreach ($ecues as $ecue) {
              $texte = '<option value="%d">%s</option>' ;
              echo sprintf($texte,$ecue['id'],$ecue['nom']) ;
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
  </ul>
</div>
</div>
<button  onclick="insererProf()" class="btn btn-primary btn-lg btn-block" type="button">Validation de l'ajout</button>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/poubelle.js"></script>
<script src="js/assignationEcueProf.js"></script>
<script src="js/insererProfesseur.js"></script>
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

<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <form method="post">
      <input type="hidden" name="uniqid" <?php if(isset($uniqid)){ echo 'value="'.$uniqid.'"' ;} ?>>
      <div class="form-group">
        <label for="annee"><strong>UE:</strong></label>
        <?php if(isset($message)){ echo $message ;} ?>
        <select name="ue" class="custom-select" id="ue">
          <option selected <?php if(isset($old)){ $texte = 'value="%d"'; echo sprintf($texte,$old['id']) ;} ?>><?php echo $old['nom']; ?></option>
          <?php
          if(isset($ues)){
            foreach ($ues as $ue) {
              $texte = '<option value="%d">%s</option>' ;
              echo sprintf($texte,$ue['id'],$ue['nom']) ;
            }
          }
          ?>
        </select>
      </div>
      <div class="col-4 col-md-4">
        <div class="form-group">
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
      </div>
  </form>
</div>
<script src="js/jquery-customselect.js"></script>
					<script>
          (function($) {
            $(function() {
            $("#ue").customselect({
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

<div class="outer-w3-agile mt-3">
  <div class="row">
    <div class="col-md-2">
      <a href="parcoursAdd.html" class="btn btn-primary"><i class="fas fa-plus"></i>ajouter</a>
    </div>
  </div>
</div>
<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
    <h4 class="tittle-w3-agileits mb-4"><i class="fas fa-list" aria-hidden="true"></i><?php if(isset($titre)){ echo $titre ;} ?></h4>
    <center>
        <table id='indexTable' style="width:90%;" class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">N</th>
                    <th scope="col">semestre parcour</th>
                    <th scope="col">année</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
              <?php if(isset($tableau)){
                $max = count($tableau) ;
                 for ($i=0; $i <$max ; $i++) {
                   $texte = '<tr>
                              <th scope="row">%d</th>
                              <td>%s</td>
                              <td>%s</td>
                              <td>
                               <a href="parcoursUpdate-%d-%d.html">
                                 <i class="fas fa-edit" aria-hidden="true"></i>
                               </a>&nbsp
                               <a href="dispenseesShow-%d.html">
                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                               </a>&nbsp
                               <a href="parcoursMaquette-%d.html">
                                <i class="fas fa-map" aria-hidden="true"></i>
                               </a>
                              </td>
                             </tr>' ;
                  echo sprintf($texte,$i+1,$tableau[$i]['semestres_parcour'],$tableau[$i]['annees_universitaire'],
                               $tableau[$i]['parc'],$tableau[$i]['semp'],$tableau[$i]['semp'],$tableau[$i]['semp']) ;
                 }
              }else {
                echo '<tr><td colspan="4">Aucune informations</td></tr>' ;
              }
              ?>
            </tbody>
        </table>
    </center>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>
<script type="text/javascript">
$(document).ready( function () {
  $('#indexTable').DataTable();
} );
</script>

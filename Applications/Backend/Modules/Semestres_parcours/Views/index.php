<div class="outer-w3-agile mt-3">
  <div id="notifier" hidden>
  	<?php if($user->hasFlash()){echo $user->getFlash();} ?>
  </div>
  <div class="row">
    <div class="col-md-3">
      <a href="semestres_parcoursAdd.html" class="btn btn-primary"><i class="fas fa-plus"></i>ajouter</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
</div>
<center>
<div class="outer-w3-agile mt-3">
    <h4 class="tittle-w3-agileits mb-4"><i class="fas fa-list" aria-hidden="true"></i>
<?php if(isset($titre)){ echo $titre ;} ?></h4>
    <table style="width:70%;" class="table table-striped">
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
                           <a href="semestres_parcoursUpdate-%d.html">
                             <i class="fas fa-edit" aria-hidden="true"></i>
                           </a>&nbsp
                           <a href="dispenseesShow-%d.html">
                            <i class="fas fa-binoculars" aria-hidden="true"></i>
                           </a>
                          </td>
                         </tr>' ;
              echo sprintf($texte,$i+1,$tableau[$i]['semestres_parcour'],$tableau[$i]['annees_universitaire'],$tableau[$i]['semp'],$tableau[$i]['semp']) ;
             }
          }else {
            echo '<tr><td colspan="4">Aucune informations</td></tr>' ;
          }
          ?>
        </tbody>
    </table>
</div>
</center>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

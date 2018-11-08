<div class="outer-w3-agile mt-3">
  <div class="row">
    <div class="col-md-3">
      <a href="uesAdd.html" class="btn btn-primary"><i class="fas fa-plus"></i>ajouter</a>
    </div>
    <div class="col-md-6">
    </div>
  </div>
</div>
<div class="outer-w3-agile mt-3">
    <h4 class="tittle-w3-agileits mb-4"><i class="fas fa-list" aria-hidden="true"></i>
<?php if(isset($titre)){ echo $titre ;} ?></h4>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N</th>
                <th scope="col">Code</th>
                <th scope="col">Nom</th>
                <th scope="col">ECUE</th>
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
                          <td>%s</td>
                          <td>
                           <a href="uesUpdate-%d.html">
                             <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                           </a>
                          </td>
                         </tr>' ;
              echo sprintf($texte,$i+1,$tableau[$i]['code'],$tableau[$i]['nom'],$tableau[$i]['ecues'],$tableau[$i]['id']) ;
             }
          }else {
            echo '<tr><td colspan="4">Aucune informations</td></tr>' ;
          }
          ?>
        </tbody>
    </table>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

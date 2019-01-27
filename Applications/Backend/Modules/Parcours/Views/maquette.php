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
                    <th scope="col">code ue</th>
                    <th scope="col">ue</th>
                    <th scope="col">code ecue</th>
                    <th scope="col">ecue</th>
                    <th scope="col">cm</th>
                    <th scope="col">td</th>
                    <th scope="col">tp</th>
                    <th scope="col">projet</th>
                    <th scope="col">total</th>
                    <th scope="col">tpe</th>
                    <th scope="col">credit</th>
                    <th scope="col">enseignant</th>
                </tr>
            </thead>
            <tbody>
              <?php if(isset($maquette)){
                $max = count($maquette) ;
                 for ($i=0; $i <$max ; $i++) {
                   $texte = '<tr>
                              <th scope="row">%d</th>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%d</td>
                              <td>%s</td>
                             </tr>' ;
                  echo sprintf($texte,$i+1,$maquette[$i]['code'],$maquette[$i]['ue'],$maquette[$i]['code_ecue'],$maquette[$i]['ecue'],
                  $maquette[$i]['cm'],$maquette[$i]['td'],$maquette[$i]['tp'],$maquette[$i]['projet'],$maquette[$i]['total'],$maquette[$i]['tpe'],
                  $maquette[$i]['credits'],$maquette[$i]['enseignant']) ;
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

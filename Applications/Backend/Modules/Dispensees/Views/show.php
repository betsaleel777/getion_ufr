<div class="outer-w3-agile mt-3">
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">N</th>
              <th scope="col">UE</th>
              <th scope="col">Options</th>
          </tr>
      </thead>
      <tbody>
        <?php if(isset($lignes)){
          $max = count($lignes) ;
           for ($i=0; $i <$max ; $i++) {
             $texte = '<tr>
                        <th scope="row">%d</th>
                        <td>%s</td>
                        <td><a href="uesUpdate-%d.html">modifier</a></td>
                       </tr>' ;
            echo sprintf($texte,$i+1,$lignes[$i]['ue'],$lignes[$i]['ueId']) ;
           }
        }else {
          echo '<tr><td>Aucune informations</td></tr>' ;
        }
        ?>
      </tbody>
  </table>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>
<script src="js/notifier.js"></script>

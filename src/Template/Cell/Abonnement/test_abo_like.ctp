
<span id="actionabo">

<?php


            if($abonnement == 0) // je ne suis pas abonné
             {
              ?>
              <button type="button" class="btn btn-info">En attente</button>
              
             
            
            <?php
          }
            elseif($abonnement == 1) // je suis abonné
            {
                
?>

  <button data-username="<?= $suivi ;?>" data-action="delete" title="Ne plus suivre <?= $suivi ;?>"  id="aboact" class="btn btn-danger" onclick="return false;">Ne plus suivre</button>

  <?php
                  
            }
            elseif ($abonnement == 2) {
              ?>
              <button data-username="<?= $suivi ;?>" data-action="add" title="Suivre <?= $suivi ;?>"  id="aboact" class="btn btn-success" onclick="return false;">Suivre</button>
              <?php
            }
          
          ?>
</span>

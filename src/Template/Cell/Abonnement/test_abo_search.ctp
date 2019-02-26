<span id = "abosearch">
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

  <a href="#" data-username="<?= $suivi ;?>" data-action="delete" title="Ne plus suivre <?= $suivi ;?>"  id="aboact" class="btn btn-info" onclick="return false;">Ne plus suivre</a>

  <?php
                  
            }
            elseif ($abonnement == 2) {
              ?>
              <a href="#" data-username="<?= $suivi ;?>" data-action="add" title="Suivre <?= $suivi ;?>"  id="aboact" class="btn btn-success navbar-btn" onclick="return false;">Suivre</a>
              <?php
            }
          
          ?>
</span>
</span>
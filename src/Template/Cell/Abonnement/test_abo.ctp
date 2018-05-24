<span id = "abosearch">
<span id="actionabo">

<?php


            if($abonnement === 0) // je ne suis pas abonné
             {
              ?>
              
              
             <a href="#" data-username="<?= $suivi ;?>" data-action="add" title="Suivre <?= $suivi ;?>"  id="aboact" class="btn btn-success navbar-btn" onclick="return false;"><span class="glyphicon glyphicon-plus"></span></a>
            
            <?php
          }
            elseif($abonnement === 1) // je suis abonné
            {
                
?>

            <button data-toggle="modal" data-target="#modalmessage" class="btn btn-primary navbar-btn" title="Envoyer un message à <?= $suivi ;?>" type="button"><span class="glyphicon glyphicon-envelope"></span></button> - <a href="#" data-username="<?= $suivi ;?>" data-action="delete" title="Ne plus suivre <?= $suivi ;?>"  id="aboact" class="btn btn-danger" onclick="return false;"><span class="glyphicon glyphicon-minus"></span></a>

  <?php
                  
            }
          
          ?>
</span>
</span>
<!-- modal envoi de message -->
<?= $this->element('modalmessage',['destinataire' => $suivi]) ?>
<!-- fin modal envoi de message -->
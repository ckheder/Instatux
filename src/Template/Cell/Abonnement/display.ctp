
             <!-- nombre d'abonnement et d'abonné -->

                       <li><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;<a href="/instatux/abonne/<?= $this->request->getParam('username')?>"<?php if (!isset($authname)){ echo 'class="disabled_link"';}?>>Abonné <?= $nb_abonnes ?></a></li>
                      <li> <span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;<a href="/instatux/abonnement/<?= $this->request->getParam('username')?>" <?php if (!isset($authname)){ echo 'class="disabled_link"';}?>>Abonnement <?= $nb_abonnement ?></a></li>
              <!-- fin nombre d'abonnement et d'abonné -->

<?php

if(isset($authname))
{

   if($this->request->getParam('username') == $authname)
            {
             ?>

<?php
}

            if($this->request->getParam('username') != $authname) // si c'est pas moi
{

            if($abonnement == 0) // demande d'abonnement en cours
             {
              ?>
              
              <li id="actionabo"> <!-- lien nouvel abonnement : public ou privé -->
                  <button type="button" class="btn btn-info">En attente</button>
            </li>
             
               
               
            <?php
          }
           elseif($abonnement == 1) // je suis abonné
            {
                
?>
                <li id="actionabo">
                  <button data-username="<?= $this->request->getParam('username') ;?>" data-action="delete" title="Ne plus suivre <?= $this->request->getParam('username') ;?>" type="button"  id="aboact" class="btn btn-danger navbar-btn" onclick="return false;">Ne plus suivre</button> - 
                <?= $this->Form->button('Envoyer un message', // lien pour envoyer un message
                [ 'data-toggle' => 'modal',
                  'data-target' => '#modalmessage',
                  'class' => 'btn btn-primary navbar-btn',
                  'title' => 'Envoyer un message à '.$this->request->getParam('username').'',
                  'type' => 'button']);
                  ?>        
                </li>
                <?php  
            }
            elseif($abonnement == 2) // nouvel abonnement
            {
              ?>
              <li id="actionabo">
                <button data-username="<?= $this->request->getParam('username') ;?>" data-action="add" title="Suivre <?= $this->request->getParam('username') ;?>"  id="aboact" class="btn btn-success" onclick="return false;">Suivre</button>
              </li>
              <?php
            }
            if($etat_blocage === 1) // utilisateur bloqué
            {
              ?>
              <li id="block">
                  <a href="#" data-username="<?= $this->request->getParam('username') ;?>" data-action="delete" title="Débloquer <?= $this->request->getParam('username') ;?>"  id="addblock" class="btn btn-success" onclick="return false;">Débloquer</a>
                </li>
                <?php
            }
            else
            {
              ?>
              <li id="block">
                <a href="#" data-username="<?= $this->request->getParam('username') ;?>" data-action="add" title="Bloquer <?= $this->request->getParam('username') ;?>"  id="addblock" class="btn btn-danger" onclick="return false;">Bloquer</a>
              </li>
              <?php
            }
          }
          } 
          ?>
            

</ul>
<!-- modal envoi de message -->
<?= $this->element('modalmessage',["destinataire" => $this->request->getParam('username')]) ?>
<!-- fin modal envoi de message -->


             <!-- nombre d'abonnement et d'abonné -->

                       <li><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;<a href="/instatux/abonnement/<?= $this->request->getParam('username')?>#abonne" <?php if (!isset($authname)){ echo 'class="disabled_link"';}?>>Abonné <?= $nb_abonnes ?></a></li>
                      <li> <span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;<a href="/instatux/abonnement/<?= $this->request->getParam('username')?>#abonnement" <?php if (!isset($authname)){ echo 'class="disabled_link"';}?>>Abonnement <?= $nb_abonnement ?></a></li>
              <!-- fin nombre d'abonnement et d'abonné -->
          
<?php

if(isset($authname))
{

            if($this->request->getParam('username') != $authname) // si c'est pas moi
{
            if($abonnement === 0) // je ne suis pas abonné
             {
              ?>
              
              <li>
                <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', 


                '/abonnement/add/'.h($this->request->getParam('username')).'',
                [
                'title' => 'Suivre '.$this->request->getParam('username').'',
                'class' => 'btn btn-success', 
                'role' => 'button',
                'escape' => false]);
                  ?> 
            </li>
            
            <?php
          }
            elseif($abonnement === 1) // je suis abonné
            {
                
?>
                <li>
                <?= $this->Form->button('<span class="glyphicon glyphicon-envelope"></span>', // lien pour envoyer un message
                [ 'data-toggle' => 'modal',
                  'data-target' => '#modalmessage',
                  'class' => 'btn btn-primary navbar-btn',
                  'title' => 'Envoyer un message à '.$this->request->getParam('username').'',
                  'type' => 'button']);
                  ?> - 
                              <?= $this->Html->link('<span class="glyphicon glyphicon-minus"></span>', // lien pour supprimer l'abonnement


                '/abonnement/delete/'.h($this->request->getParam('username')).'',
                [
                'title' => 'Ne plus suivre '.$this->request->getParam('username').'',
                'class' => 'btn btn-danger', 
                'role' => 'button',
                'escape' => false]);
                ?>
                </li>
                <?php  
            }

            if($etat_blocage === 1) // utilisateur bloqué
            {
              ?>
              <li>
              <?=$this->Html->link('<span class="glyphicon glyphicon-minus-sign"></span>', // lien pour supprimer ce blocage


                '/blocage/delete/'.h($this->request->getParam('username')).'',
                [
                'title' => 'Debloqué '.$this->request->getParam('username').'',
                'class' => 'btn btn-info', 
                'role' => 'button',
                'escape' => false]);
                ?>
                  
                </li>
                <?php
            }
            else
            {
              ?>
              <li>

              <?= $this->Html->link('<span class="glyphicon glyphicon-plus-sign"></span>', // lien pour supprimer l'abonnement


                '/blocage/add/'.h($this->request->getParam('username')).'',
                [
                'title' => 'Bloqué '.$this->request->getParam('username').'',
                'class' => 'btn btn-info', 
                'role' => 'button',
                'escape' => false]);
                ?>
              </li>
              <?php
            }
          }
          } 
          ?>
            

</ul>
<!-- modal envoi de message -->
<?= $this->element('modalmessage') ?>
<!-- fin modal envoi de message -->


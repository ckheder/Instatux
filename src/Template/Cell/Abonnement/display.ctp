
            <?php 

                       echo '<li><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;Abonné '.$nb_abonnes;
                ?></li>

                <li>
                <?php
             echo '<span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;Abonnement '.$nb_abonnement;
?>
</li>
<?php
            if($this->request->getParam('username') != $authname)
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
                  
            }
          } 
          ?>
            
</li>
</ul>
<!-- modal envoi de message -->
<?= $this->element('modalmessage') ?>
<!-- fin modal envoi de message -->


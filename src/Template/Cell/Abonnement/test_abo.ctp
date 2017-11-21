<?php


            if($abonnement === 0) // je ne suis pas abonné
             {
              ?>
              
              
                <?= $this->Html->link('Suivre', 


                '/abonnement/add/'.h($suivi).'',
                [
                'title' => 'Suivre '.$suivi.'',
                'class' => 'btn btn-success bouton_abo_search', 
                'role' => 'button',
                'escape' => false]);
                  ?> 
            
            
            <?php
          }
            elseif($abonnement === 1) // je suis abonné
            {
                
?>

                              <?= $this->Html->link('Ne plus suivre', // lien pour supprimer l'abonnement


                '/abonnement/delete/'.h($suivi).'',
                [
                'title' => 'Ne plus suivre '.$suivi.'',
                'class' => 'btn btn-danger bouton_abo_search', 
                'role' => 'button',
                'escape' => false]);
                  
            }
          
          ?>

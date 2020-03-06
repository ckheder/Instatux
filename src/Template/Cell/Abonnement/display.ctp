<!--

 * display.ctp
 *
 * Affichage des informations utilisateurs sur un profil qui n'est pas le mien
 *
 */

        nombre d'abonnement et d'abonné et lien vers la liste-->

          <li> <!-- lien vers les abonnés de la personne, désactivé pour les non connecté -->
              <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;
                <a href="/instatux/abonne/<?= $this->request->getParam('username')?>"><?= $nb_abonnes ?> abonné(s) </a>
          </li>

          <li> <!-- lien vers les abonnement de la personne, désactivé pour les non connecté -->
              <span class="glyphicon glyphicon-hand-left"></span>&nbsp;&nbsp;
                <a href="/instatux/abonnement/<?= $this->request->getParam('username')?>" ><?= $nb_abonnement ?> abonnement(s) </a>
          </li>

<?php

      if(isset($authname))
    {
          if($this->request->getParam('username') != $authname) // si c'est pas moi
        {
              if($abonnement == 0) // demande d'abonnement en cours
            {
              ?>
              <!-- lien nouvel abonnement : public ou privé -->
                <li id="actionabo"> 
                  <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;<a href="" data-username="<?= $this->request->getParam('username') ;?>" data-action="deleterequest" title="Annuler la demande d'abonnement" type="button"  id="aboact" onclick="return false;">Demande envoyée</a>
                </li> 
              <?php
            }
              elseif($abonnement == 1) // je suis abonné
            {              
              ?>
              <!-- lien pour envoyer un message -->
              <li>
                <span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#modalmessage" title="Envoyer un message à <?= $this->request->getParam('username') ?>">Envoyer un message</a>
              </li>
                <li id="actionabo">
              <!-- lien de désabonnement -->
                  <span class="glyphicon glyphicon-eye-close"></span>&nbsp;&nbsp;<a href="" data-username="<?= $this->request->getParam('username') ;?>" data-action="delete" title="Ne plus suivre <?= $this->request->getParam('username') ;?>" type="button"  id="aboact" onclick="return false;">Ne plus suivre</a>                      
                </li>
                <?php  
            }
              elseif($abonnement == 2) // nouvel abonnement
            {
              ?>
                <li id="actionabo">
                  <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<a href="" data-username="<?= $this->request->getParam('username') ;?>" data-action="add" title="Suivre <?= $this->request->getParam('username') ;?>"  id="aboact" onclick="return false;">Suivre</a>
                </li>
              <?php
            }
              if($etat_blocage === 1) // si j'ai bloqué cet utilisateur
            {
              ?>
                <li id="block">
                  <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $this->request->getParam('username') ;?>" data-action="delete" title="Débloquer <?= $this->request->getParam('username') ;?>"  id="addblock" onclick="return false;">Débloquer</a>
                </li>
                <?php
            }
              else
            {
              ?>
                <li id="block">
                  <span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $this->request->getParam('username') ;?>" data-action="add" title="Bloquer <?= $this->request->getParam('username') ;?>"  id="addblock" onclick="return false;">Bloquer</a>
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

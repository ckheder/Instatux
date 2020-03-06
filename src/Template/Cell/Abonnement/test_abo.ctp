<!--

 * test_abo_search.ctp
 *
 * Test de l'abonnement sur les résultats du moteur de recherche
 *
 */

-->

          <span id = "abosearch">
            <span id="actionabo<?= $suivi ;?>"> <!-- Utiliser en AJAX pour mettre à jour le bouon suite à une action -->

              <?php

                  if($abonnement == 0) // demande envoyé
                {
                  ?>

                      <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;<a href="" data-username="<?= $suivi ;?>" data-action="deleterequest" title="Annuler la demande d'abonnement" type="button"  id="aboact" onclick="return false;">Demande envoyée</a>

                  <?php
                }
                  elseif($abonnement == 1) // je suis abonné
                {

                  ?>

                      <span class="glyphicon glyphicon-eye-close"></span>&nbsp;&nbsp;<a href="" data-username="<?= $suivi ;?>" data-action="delete" title="Ne plus suivre <?= $suivi ;?>" type="button"  id="aboact" onclick="return false;">Ne plus suivre</a>&nbsp;

                  <?php

                }
                  elseif ($abonnement == 2) // je ne suis pas abonné
                {

                  ?>

                      <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;<a href="" data-username="<?= $suivi ;?>" data-action="add" title="Suivre <?= $suivi ;?>"  id="aboact" onclick="return false;">Suivre</a>&nbsp;

                  <?php
                }

                  ?>
            </span>
        </span>

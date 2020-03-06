<?php
/**
 * Abonnes.ctp
 *
 * Affichage des abonnés du profil en cours de visite
 *
 */


    // si je suis sur mon compte

          if(isset($nbabonne_valide) AND $this->request->getParam('username') == $authName)
        {
            echo '<div class="text-center" id="nbabo">Personne ne vous suit.</div>';
        }
         else if(isset($nbabonne_valide) AND $this->request->getParam('username') != $authName) // si je ne suis pas sur mon compte et que la personne ne suit personne
        {
            echo '<div class="text-center" id="nbabo">Personne ne suit '.$this->request->getParam('username').' pour le moment.</div>';
        }

          else
        {
            echo '<div class="nbfollow">'; // nombre d'abonnés

                if($this->request->getParam('username') != $authName) // je ne suis pas sur mon compte
              {
                  echo ''.$this->request->getParam('username').' à '.$count_abonnes.' abonné(s).';
              }
                else
              {
                  echo 'Vous avez '.$count_abonnes.' abonné(s).';
              }

              ?>

        </div>

        <!-- liste de mes abonnés -->

        <div id="listabonne">

          <br />

            <?php foreach ($abonne_valide as $abonne_valide): ?>

                <div class="liste_abo">

                  <?= $this->Html->image('/img/avatar/'.$abonne_valide->Users['username'].'.jpg', array('alt' => 'image utilisateur','class'=>' img-circle', 'title' => ''.h($abonne_valide->Users['username']).'')) ?>

                  <p>

                    <?= $this->Html->link(''.h($abonne_valide->Users['username']).'','/'.h($abonne_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

                    <span class="alias_tweet">@<?= $abonne_valide->Users['username'] ;?></span>

                  <br />

                    <?= $abonne_valide->Users['description']; ?>

                  </p>

            <!-- test si je suis également mes abonnés -->

            <?php

              if($abonne_valide->Users['username'] != $authName )
            {

              echo $this->cell('Abonnement::test_abo', ['authname' => $authName, 'suivi' =>$abonne_valide->Users['username']]);

            }

            ?>

            <span id="etatblocageabonnes">

              <?= $this->cell('Abonnement::testblocage', ['authname' => $authName, 'suivi' => $abonne_valide->Users['username']]) ; ?>

            </span>

                </div>

            <?php endforeach; ?>

        </div>

        <?php
        }
        ?>

<!-- pagination -->

         <div id="pagination">

            <?= $this->Paginator->options([
                                            'url' => array('controller' => '/abonne/'.$this->request->getParam('username').'')

                                          ]);?>

            <?= $this->Paginator->next('Next page'); ?>


          </div>

<!-- configuation IAS -->

            <script>
              var ias = jQuery.ias({
  container:  '#listabonne',
  item:       '.liste_abo',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
            </script>


<!-- fin abonnement validé -->

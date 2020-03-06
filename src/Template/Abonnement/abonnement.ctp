<?php
/**
 * Abonnement.ctp
 *
 * Affichage des abonnements du profil en cours de visite
 *
 */
           // si je suis sur mon compte et que je ne suis personne

            if(isset($nbabonnement_valide) AND $this->request->getParam('username') == $authName)
          {
            echo '<div class="text-center" id="nbabo">Vous ne suivez personne.</div>';
          }

          // si je ne suis pas sur mon compte et que la personne ne suit personne

            else if(isset($nbabonnement_valide) AND $this->request->getParam('username') != $authName)
          {
            echo '<div class="text-center" id="nbabo">'.$this->request->getParam('username').' ne suit personne pour le moment.</div>';
          }
            else
          {
             ?>
             <div class="text-center" id="nbabo">

              <?php

              if($this->request->getParam('username') != $authName) // je ne suis pas sur mon compte
              {


                echo ''.$this->request->getParam('username').' suit <span id="nbabonnement">'.$count_abonnement.'</span> personne(s).';

              }
              else
              {
                echo 'Vous suivez <span id="nbabonnement">'.$count_abonnement.'</span> personne(s).';
              }

              ?>

            </div><!-- // nombre d'abonnements -->

            <!-- liste d'abonnement -->

            <div id="listabovalide">

              <br />

            <?php foreach ($abonnement_valide as $abonnement_valide): ?>


                <div class="liste_abo" data-username="<?= $abonnement_valide->Users['username'] ;?>">

                  <!-- avatar -->

                    <?= $this->Html->image('/img/avatar/'.$abonnement_valide->Users['username'].'.jpg', array('alt' => 'image utilisateur', 'class'=>' img-circle', 'title' => ''.h($abonnement_valide->Users['username']).'')) ?>

                    <p>

                  <!-- lien profil -->

                    <?= $this->Html->link(''.h($abonnement_valide->Users['username']).'','/'.h($abonnement_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>

                  <!-- @username -->

                    <span class="alias_tweet">@<?= $abonnement_valide->Users['username'] ;?></span>

                    <br />

                  <?= $abonnement_valide->Users['description']; ?>

                  </p>

                             <?php

              if($abonnement_valide->Users['username'] != $authName)
            {

              echo $this->cell('Abonnement::test_abo', ['authname' => $authName, 'suivi' =>$abonnement_valide->Users['username']]); 

            }


                              ?>
            </div>

            <?php endforeach; ?>

          </div>

<?php
        }
?>

        <!-- pagination -->

          <div id="pagination">

        <!-- lien personnaliser -->

              <?= $this->Paginator->options([
                                              'url' => array('controller' => '/abonnement/'.$this->request->getParam('username').'')
                                            ]);

              ?>

            <?= $this->Paginator->next('Next page'); ?>

          </div>
<!-- paramètre Infinite Ajax Scroll -->
<script>
              var ias = jQuery.ias({
  container:  '#listabovalide',
  item:       '.liste_abo',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
</script>

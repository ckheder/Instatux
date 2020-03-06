 <?php
/**

 * index.ctp
 *
 * Affichage dans une fenêtre modale des personnes qui like un post
 *
 */

        if(isset($nolike)) // personne n'aime ce contenu
      {
        
        echo '<div class="alert alert-warning text-center"><strong>Personne n\'aime ce contenu pour le moment.</strong> </div>';                     
      }
        else
      {
        ?>

          <div id="list_like">

            <?php foreach ($listlike as $listlike): ?>

              <div class="liste_like">

        <!-- avatar -->

        <img src="/instatux/img/avatar/<?= $listlike->Users['username']; ?>.jpg" alt="image utilisateur" class="img-circle vcenter likepic">

        <!-- lien vers profil -->

        <a href="./<?= $listlike->Users['username']; ?>" title="Voir le profil de <?= $listlike->Users['username']; ?>">
          <?= $listlike->Users['username']; ?>
        </a>

        <!-- alias -->

        <span class="alias_tweet">@<?= $listlike->Users['username'] ?></span>

        <!-- bouton d'abonnement ou de désabonnement  -->

        <span class="btn_like">

          <?php

                  if(isset($authName) AND $listlike->Users['username'] != $authName) // si je suis connecté et si ce n'est pas moi, on vérifie si je suis déjà abooné ou non à cette personne
               {
                
                echo $this->cell('Abonnement::test_abo', ['authname' => $authName, 'suivi' =>$listlike->Users['username']]) ;  

               }

          ?>

        </span>
        
               <br />

              </div>

            <?php endforeach ;?>

            <!-- pagination -->

                <div id="paginations">

                  <?= $this->Paginator->next('Next page'); ?>

                </div>

            </div>

            <!-- scroll infini -->

              <?= $this->Html->script('iaslike.js') ?>
        <?php
      }
        ?>
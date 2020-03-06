<!--

 * index.ctp
 *
 * Mise en page résultat recherche
 *
 */ -->

<?php
              if(isset($nb_resultat_users)) // si y'a des résultats utilisateurs
            {
              ?>
                <div class="text-center">

                  <h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?= $nb_resultat_users ?> membre(s) trouvé(s)</h4>

                </div>
<?php

// résultat users

                foreach ($resultat_users as $resultat_users): ?>

                  <div class="liste_abo">

                    <!-- avatar -->

                    <?= $this->Html->image('/img/avatar/'.$resultat_users->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle')) ?>

                    <p>

                    <!-- username -->

                    <?= $this->Html->link(h($resultat_users->username),'/'.h($resultat_users->username).'',['class' => 'link_username_tweet']) ;?>

                    <!-- alias -->

                    <span class="alias_tweet">@<?=$resultat_users->username ?></span>

                    <br />

                    <!--description utilisateur -->

                    <?php if (empty($resultat_users->description))
                    {
                      echo '<br /><br /><br />';
                    }

                    else
                    {
                      echo $resultat_users->description;
                    }

?>

                </p>
<?php

                if(isset($authName))
              {
                  if($resultat_users->username != $authName) // si ce n'est pas moi, on vérifie si je suis abonné ou non à cette personne
                {

                  echo $this->cell('Abonnement::test_abo', ['authname' => $authName, 'suivi' =>$resultat_users->username]) ;  
                }
             }

?>


              </div>

              <?php endforeach;

}

 //fin résultat users
?>

<!-- résultat publications -->

<div class="text-center">

  <h4><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<?= $nb_resultat_tweet ?> publication(s) trouvée(s)</h4>

</div>

<!-- résultat publications -->

<div id="list_search">

<?php

      foreach ($resultat_tweet as $resultat_tweet): ?>

        <!-- mise en page résultat -->

            <div class="tweet">

              <!-- avatar -->

              <?= $this->Html->image('/img/avatar/'.$resultat_tweet->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>

              <!-- username et lien vers profil -->

              <?= $this->Html->link(h($resultat_tweet->user->username),'/'.h($resultat_tweet->user->username).'',['class' => 'link_username_tweet']) ; ?>

              <span class="alias_tweet">@<?=$resultat_tweet->user->username ?></span> -

              <!-- date création -->

              <?= $resultat_tweet->created->i18nformat('dd MMMM YYYY');

              $resultat_tweet_contenu = preg_replace('/%23/', '#', $resultat_tweet->contenu_tweet); ?>

              <?= $resultat_tweet_contenu ?>

              <span class="nb_like"> <!-- like -->

                <span class="glyphicon glyphicon-heart" style="vertical-align:center"></span>

                <!-- voir les personnes aimant -->

                <a href="" data-idtweet="<?= $resultat_tweet->id ;?>" data-toggle="modal" data-target="#viewlike" data-remote="false" onclick="return false;">

                <!-- nombre de like -->

                <span id="compteur_like-<?= $resultat_tweet->id ;?>"> <?= $resultat_tweet->nb_like ;?></span></a>

              </span>

              <!-- commentaire / partage -->

              <span class="nb_comm_share">

                <span class="profilnbcomm_<?= $resultat_tweet->id_tweet ;?>"><?= $resultat_tweet->nb_commentaire ?></span> commentaire(s) - <?= $resultat_tweet->nb_partage ?> partage(s)

              </span>

                <br />
                <br />

              <span class="link_comm_share">

                  <?php

                  if(isset($authName))
                {
                  ?>

                  <!-- je suis authentifié, je peut liker -->

                  <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span>

                  <a href="#" data-value="<?= $resultat_tweet->id ;?>" class="link_like" onclick="return false;">J'aime</a>

                  &nbsp;&nbsp;&nbsp;

               <?php

                }

                  if($resultat_tweet->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<br /><br /><div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                  else
                {

                 ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span>

                  <a href="" data-idtweet="<?= $resultat_tweet->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false" onclick="return false;">Commenter</a>

               &nbsp;&nbsp;&nbsp;

               <?php

                }

                if(isset($authName))
              {

                  if($resultat_tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager
                {

                 ?>

                 <!-- partage -->

              <span class="sharelink" data-idtweet="<?= $resultat_tweet->id ;?>">

              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>

              <a href="#" data-idtweet="<?= $resultat_tweet->id ;?>" data-auteurtweet="<?= $resultat_tweet->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>

              </span>

                <?php

                }
              }
            ?>
          </span>
                </div>

            <?php endforeach; ?>

            </div>

            <!-- pagination -->

         <div id="pagination">

          <?= $this->Paginator->options([

                                          'url' => array('controller' => '/search-'.$search.'')

                                        ]);?>

          <?= $this->Paginator->next('Next page'); ?>

          </div>

<?= $this->Html->script('iassearch.js') ?>

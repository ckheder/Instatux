<!--

 * hashtag.ctp
 *
 * Mise en page résultat hashtag
 *
 */ -->

<div class="text-center">

  <h3><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;#<?= $search ?></h3> <!-- affichage de la recherche -->

</div>

<br />

<div class="text-center"> <!-- affichage du nombre de résultat dans les publications  -->

  <h4><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<?= $nb_resultat_tweet ?> publication(s) trouvée(s)</h4>

</div>

<div id="list_tweet"> <!-- liste résultat -->

<?php

        foreach ($resultat_tweet as $resultat_tweet): ?>

            <div class="tweet"> <!-- mise en page résultat -->

              <?= $this->Html->image('/img/avatar/'.$resultat_tweet->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>

              <?= $this->Html->link(h($resultat_tweet->user->username),'/'.h($resultat_tweet->user->username).'',['class' => 'link_username_tweet']) ; ?>

              <span class="alias_tweet">@<?=$resultat_tweet->user->username ?></span> - 

              <?= $resultat_tweet->created->i18nformat('dd MMMM YYYY'); // date tweet

                  $resultat_tweet_contenu = preg_replace('/%23/', '#', $resultat_tweet->contenu_tweet); 

                  $resultat_tweet_contenu ?> <!-- contenu tweet -->

              <!-- nombre de like -->
                                                 
              <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $resultat_tweet->id ;?>"><?= $resultat_tweet->nb_like ;?></span></span>

              <!-- nombre de commentaire/partage -->

              <span class="nb_comm_share"><?= $resultat_tweet->nb_commentaire ?> commentaire(s) - <?= $resultat_tweet->nb_partage ?> partage(s)</span>

                <br />

                <br />

                <span class="link_comm_share">

                <?php
                      if(isset($authName))
                    {

                                  ?>

                    <!-- lien like -->

                    <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                    <a href="#" data-value="<?= $resultat_tweet->id ;?>" class="link_like" onclick="return false;">J'aime</a>&nbsp;&nbsp;&nbsp;
               
                      <?php

                    }  
                               
                  if($resultat_tweet->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<br /><br /><div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                  else
                {

                 ?>

                 <!-- lien commenter -->

                  <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 
                  
                  <?= $this->Html->link('Commenter', '/post/'.$resultat_tweet->id.''); ?>

                  &nbsp;&nbsp;&nbsp;

                  <?php   
                }

                if(isset($authName))
              {
           
                  if($resultat_tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager
                {
                  ?>

              <!-- lien de partage -->
              
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
                                            'url' => array('controller' => '/search/hashtag/'.$search.'')
        
                                          ]);?>                            

           <?= $this->Paginator->next('Next page'); ?>


          </div>

<?= $this->Html->script('iassearch.js') ?> 

 
          


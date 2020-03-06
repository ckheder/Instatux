<!--

 * actualites.ctp
 *
 * Mise en page actualité offline (personne non connectée)
 *
 */ -->

<?php

  use Cake\I18n\Time;

?>

      <div id="list_actu_offline">

        <?php

             foreach ($actu as $actu): ?>

              <!--mise en page tweet -->
         
              <div class="tweet">

<?php
          echo  $this->Html->image('/img/avatar/'.$actu->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')); // avatar

          echo  $this->Html->link($actu->user->username,'/'.$actu->user->username.'',['class' => 'link_username_tweet']) ;?><!--username -->

          <span class="alias_tweet">@<?=$actu->user->username ?></span> <!--alias -->
            
          <?= $actu->created->i18nformat('dd MMMM YYYY - HH:mm'); //date création
                       
          $resultat_tweet_contenu = preg_replace('/%23/', '#', $actu->contenu_tweet); // on remplace %23 par #

          echo $resultat_tweet_contenu ?> <!-- contenu tweet -->

          <!-- nombre like -->

          <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $actu->id ;?>"><?= $actu->nb_like ;?></span></span>

          <!-- nombre commentaire -->

          <span class="nb_comm_share"><?= $actu->nb_commentaire ?> commentaire(s) - <?= $actu->nb_partage ?> partage(s)</span>

          <br />
          <br />

          <span class="link_comm_share">
                    
                <?php
                
                  if($actu->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                  else
                {
                  ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 

                <a href="" data-idtweet="<?= $actu->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false" onclick="return false;">Lire</a>

                <?php

                }
                    
?>
          </span>

            </div>
  <?php

 endforeach; ?>

            </div>

            <!--pagination -->

          <div id="pagination">

            <?= $this->Paginator->next('Page suivante'); ?>

          </div>

<?= $this->Html->script('offlinenews.js') ?>




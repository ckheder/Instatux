<!--

 * media.ctp
 *
 * Affichage de tous les tweets contenant un média uploadé
 *
 */ -->

<?php

    use Cake\I18n\Time;

?>

<!--vérification profil -->

              <div id="list_tweet_<?= $this->request->getParam('username') ;?>">
    <?php

              if(isset($no_follow)) // impossible de voir le profil
            {
                echo '<div class="alert alert-danger">
                          Impossible de voir ce profil
                        <br />
                          Raisons possibles :
                        <ul>
                          <li>Ce profil est privé, vous devez vous abonner pour en voir le contenu.</li>
                          <li>Cet utilisateur vous à bloqué.</li>
                        </ul>
                        </div>';

            }

              else
            {
                ?>


 <!--liste des tweets -->

<?php 

                  foreach ($tweet_media as $tweet_media): ?>

            <div class="tweet" data-idtweet="<?= $tweet_media->id_tweet ;?>">

              <?php

                if(isset($authName)) // affichage bouton d'option si ej suis authentifié
              {
                ?>

                  <div class="dropdown">

                    <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    ...
                  </button>

                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

<?php

                  if($tweet_media->user_timeline == $authName) // si je suis sur mon mur
                {
                ?>
                  <li> <!-- je peut effacer mon post -->
                      <a href="#" data-idtweet="<?= $tweet_media->id_tweet ;?>"  title="Effacer ce tweet"  class="deletetweet" onclick="return false;">Effacer ce tweet</a>
                  </li>

                <?php

                    if($tweet_media->allow_comment == 1) // si les comms ne sont pas bloqués, j'ai accès à la publication pour les réactiver ou commenter
                 {
                    ?>

                    <li>
                          <?= $this->Html->link('Voir la publication ', ['action' => 'view',  $tweet_media->id]); ?>
                    </li>

<?php
                 }
                 
                }
                    else
                  {
                    ?>
                      <li>

                        <?= $this->Html->link('Signaler ce post ', ['action' => 'view',  $tweet_media->id]); ?></li> <!-- lien de signalement pour les autres -->
                    <?php

                  }

                ?>
  </ul>
</div>
<!-- fin bouton dropdown tweet -->
            <?php
          }

              if($tweet_media->share == 1) // si tweet partagé, on indique que je l'ai partagé
            {

              echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'
                    <br />';

            }

            //avatar

            echo $this->Html->image('/img/avatar/'.$tweet_media->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));

            // username

            echo  $this->Html->link($tweet_media->user->username,'/'.$tweet_media->user->username.'',['class' => 'link_username_tweet']) ?>

            <!--alias -->

            <span class="alias_tweet">@<?=$tweet_media->user->username?></span> -

            <!-- date publication -->

            <?= $tweet_media->created->i18nformat('dd MMMM YYYY - HH:mm');

            //remplacement des %23 par #

             $contenu_tweet = str_replace('%23', '#', $tweet_media->contenu_tweet);

            // affichage du corps du tweet

            echo $contenu_tweet;

            ?>

            <!-- affichage du nombre de like et lien pour voir la la liste des personnes aimant ce post -->

            <span class="nb_like">
                <span class="glyphicon glyphicon-heart" style="vertical-align:center"></span>
                  <a href="" data-idtweet="<?= $tweet_media->id ;?>" data-toggle="modal" data-target="#viewlike" data-remote="false" onclick="return false;">
                    <span id="compteur_like-<?= $tweet_media->id ;?>"> <?= $tweet_media->nb_like ;?></span>
                  </a>
            </span>

            <!-- affichage du nombre de commentaire et de partage -->

            <span class="nb_comm_share">
              <span class="profilnbcomm_<?= $tweet_media->id_tweet ;?>"><?= $tweet_media->nb_commentaire ;?></span> commentaire(s) - <?= $tweet_media->nb_partage ?> partage(s)
            </span>

                <br />
                <br />

            <div class="link_comm_share">
                <?php
                      if(isset($authName)) // si je suis authentifié, affichage d'un lien, "J'aime"
                    {
                ?>
                      <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span>

                      <a href="#" data-value="<?= $tweet_media->id ;?>" class="link_like" onclick="return false;">J'aime</a>

                      &nbsp;&nbsp;&nbsp;

              <?php
                      if($tweet_media->user_timeline != $authName) // si la timeline est différente de l'utilisateur courant, on affiche un lien de partage
                    {
              ?>

                      <span class="partage" data-idtweet="<?= $tweet_media->id ;?>">

                        <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>

                          <a href="#" data-idtweet="<?= $tweet_media->id ;?>" data-auteurtweet="<?= $tweet_media->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>

                      </span>

                      &nbsp;&nbsp;&nbsp;
                <?php
                    }

                     }

                    if($tweet_media->allow_comment == 1) // si les commentaires sont désactivés, affichage d'un message
                  {

                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';

                  }
                    else // si les commentaires sont activés,affichage d'un lien pour commenter
                  {
                    ?>

                      <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span>

                      <a href="" data-idtweet="<?= $tweet_media->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false">Commenter</a>

                    <?php
                  }
                    ?>

            </div>
    </div>

        <?php  endforeach; ?>

        <!--pagination -->

        <div id="pagination">

          <?= $this->Paginator->options([

                                          'url' => array('controller' => '/'.$tweet_media->user->username.'/media')

                                        ]);?>

          <?= $this->Paginator->next('Next page'); ?>

        </div>

 <?php

        }

  ?>
</div>
<script>
    var media = "media"; // page des médias
    var currentprofil = "<?= $this->request->getParam('username') ;?>"; // profil courant, servira en JS quand on postera un nouveau tweet à bien l'afficher sur mon profil et non sur un autre profil si je tweet en visitant un autre profil
</script>
<?= $this->Html->script('/js/iasdeletetweet.js') ?> <!-- suppression d'un tweet + scroll ajax liste des tweets -->

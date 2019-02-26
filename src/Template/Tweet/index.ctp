<?php
use Cake\I18n\Time;
?>

 <div id="list_tweet_<?= $this->request->getParam('username') ;?>">
    <?php

if(isset($no_follow))
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
            elseif(isset($nb_tweet))
            {
                echo '<div class="alert alert-info" id="notweet">
                        Aucun tweet à afficher
                        </div>';
                        
            }

            else
            {
                ?>
               
                    
                
                <?php foreach ($tweet as $tweet): ?> 
                    
                
                 
            <div class="tweet" data-idtweet="<?= $tweet->id_tweet ;?>">
              <?php
              if(isset($authName))
              {
                ?>
                                <!-- bouton dropdown tweet -->
                        <div class="dropdown">
                
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php
                
            
                if($tweet->user_timeline == $authName) // si je suis sur mon mur
                {
                ?>
                <li>
                  <a href="#" data-idtweet="<?= $tweet->id_tweet ;?>"  title="Effacer ce tweet"  class="deletetweet" onclick="return false;">Effacer ce tweet</a>
                 <!-- je peut effacer mon post -->
            </li>
                <?php
                 if($tweet->allow_comment == 1) // si les comms sont bloqués, j'ai accès à la publication pour les réactiver ou faire le ménage
                 {
                    ?>
                    <li>

                       <?= $this->Html->link('Voir la publication ', ['action' => 'view',  $tweet->id]);
                 }
                 ?>
             </li>
             <?php
                }
                else
                    {
                        ?>
                        <li><?= $this->Html->link('Signaler ce post ', ['action' => 'view',  $tweet->id]); ?></li> <!-- un post qui ne m'appartient pas , je peut le signaler -->


                        <?php
                    
                }
                
                ?>
  </ul>
</div>
<!-- fin bouton dropdown tweet -->
            <?php
          }

            if($tweet->share == 1) // si tweet partagé
            {
                echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'<br />';
                 
            }

            echo $this->Html->image('/img/avatar/'.$tweet->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span> -  

             <?= $tweet->created->i18nformat('dd MMMM YYYY - HH:mm'); 

             $contenu_tweet = str_replace('%23', '#', $tweet->contenu_tweet);

              echo $contenu_tweet;



                ?>


                  <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span><a href="" data-idtweet="<?= $tweet->id ;?>" data-toggle="modal" data-target="#viewlike" data-remote="false" onclick="return false;"><span id="compteur_like-<?= $tweet->id ;?>"> <?= $tweet->nb_like ;?></span></a>
                  </span>
                <span class="nb_comm_share"><span class="profilnbcomm_<?= $tweet->id_tweet ;?>"><?= $tweet->nb_commentaire ;?></span> commentaire(s) - <?= $tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <div class="link_comm_share">
                <?php
                                 if(isset($authName))
              {
                ?>
                
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <a href="#" data-value="<?= $tweet->id ;?>" class="link_like" onclick="return false;">J'aime</a>
               &nbsp;&nbsp;&nbsp;
               <?php
                     }          
                if($tweet->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                 ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 

                <a href="" data-idtweet="<?= $tweet->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false" onclick="return false;">Commenter</a>
             <?php
           }
           ?>&nbsp;&nbsp;&nbsp;
           <?php
                                if(isset($authName))
              {
           
               if($tweet->user_timeline != $authName) // si l'auteur du tweet est différends de l'utilisateur courant
            {
                 ?>

                  <span class="sharelink" data-idtweet="<?= $tweet->id ;?>">
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              
                

                <a href="#" data-idtweet="<?= $tweet->id_tweet ;?>" data-auteurtweet="<?= $tweet->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>
              </span>
                <?php
            }
          }
            ?>
        </div>
    </div>

        <?php  endforeach; ?>
        



            <div id="pagination">

                                                        <?= $this->Paginator->options([
    'url' => array('controller' => '/'.$tweet->user->username.'')
        
    ]);?>

            <?= $this->Paginator->next('Next page'); ?>

          </div>

 <?php         

        } 

        ?>
</div>
<script>
var currentprofil = "<?= $this->request->getParam('username') ;?>"; // id du tweet
</script>
<?= $this->Html->script('/js/iasdeletetweet.js') ?> <!-- suppression d'un tweet + scroll ajax liste des tweets -->






           

           




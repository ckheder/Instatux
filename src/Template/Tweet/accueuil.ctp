<?php
use Cake\I18n\Time;
?>
<div id="list_actu_online">
  <?php
if(isset($nb_tweet_accueuil))
{
          
         echo '<div class="alert alert-info">Aucun actualités à afficher.</div>';
        }
        else
        {

             foreach ($abonnement as $abonnement): ?>
            
              <div class="tweet">
                                       <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                <li>
                 <?= $this->Html->link('Ne plus suivre '.$abonnement->user_timeline.'',array('controller'=>'abonnement','action'=>'delete',$abonnement->user->username)); ?>
                <!-- je ne m'abonne plus -->
            </li>
                
                    
                    <li>

                    <?= $this->Html->link('Signaler ce post ', ['action' => 'view']); ?>  
                 
             </li> <!--signaler un post-->


                       
  </ul>
</div>
              <?php
                          if($abonnement->share == 1) // si c'est un partage
            {
              ?>
                <br />
                
                  <span class="glyphicon glyphicon-share-alt blue_actu"></span>&nbsp;
<?= $this->Html->image( '/img/avatar/'.$abonnement->user_timeline.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>
<?= $this->Html->link(h($abonnement->user_timeline),'/'.h($abonnement->user_timeline).''); ?>
&nbsp;à partagé cette publication.<hr>
<?php
            } 
     
            
            echo  $this->Html->image('/img/avatar/'.$abonnement->user->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'',['class' => 'link_username_tweet']) ;?>
            <span class="alias_tweet">@<?=$abonnement->user->username ?></span> - 

            <?= $abonnement->created->i18nformat('dd MMMM YYYY - HH:mm');
                      

                $resultat_tweet_contenu = preg_replace('/%23/', '#', $abonnement->contenu_tweet); 

                
                echo $resultat_tweet_contenu ?>

                <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $abonnement->id ;?>"><?= $abonnement->nb_like ;?></span></span>

                <span class="nb_comm_share"><span class="profilnbcomm_<?= $abonnement->id_tweet ;?>"><?= $abonnement->nb_commentaire ?></span> commentaire(s) - <?= $abonnement->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                        <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                  <a href="#" data-value="<?= $abonnement->id ;?>" class="link_like" onclick="return false;">J'aime</a>
               &nbsp;&nbsp;&nbsp;
               <?php
                
                if($abonnement->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                  ?>

                <span class="glyphicon glyphicon-comment" style="vertical-align:center"></span> 
 

                                    <a href="" data-idtweet="<?= $abonnement->id_tweet ;?>" data-toggle="modal" data-target="#viewtweet" data-remote="false" onclick="return false;">Commenter</a>
                                    <?php

             }
               ?>
               &nbsp;&nbsp;&nbsp;
               <?php
           
               if($abonnement->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
              ?>
                                <span class="sharelink" data-idtweet="<?= $abonnement->id ;?>">
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              
                

                <a href="#" data-idtweet="<?= $abonnement->id_tweet ;?>" data-auteurtweet="<?= $abonnement->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>
              </span>

                <?php
            }
    
?>
</span>
            </div>
            <?php endforeach; ?>
           

            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>

 <?php         

        } ?>
 </div>

<?= $this->Html->script('onlinenews.js') ?>





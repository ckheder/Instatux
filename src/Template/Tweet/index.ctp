<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

            if(isset($nb_tweet))
            {
                echo '<div class="alert alert-info">
                        Aucun tweet à afficher
                        </div>';
                        
            }
            elseif(isset($no_follow))
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
                <div id="list_tweet">
                    
                
                <?php foreach ($tweet as $tweet): ?> 
                    
                
                 
            <div class="tweet" data-idtweet="<?= $tweet->id ;?>">
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
                  <a href="#" data-idtweet="<?= $tweet->id ;?>"  title="Effacer ce tweet"  class="deletetweet" onclick="return false;">Effacer ce tweet</a>
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
                 echo  $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span> - 
            <?php
            }
            else
            {
            echo $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span> - 
            <?php
            }

?>
             <?= $tweet->created->i18nformat('dd MMMM YYYY'); ?>
             <?php

             $contenu = str_replace('</p>', '', $tweet->contenu_tweet);
             ?>
                <?= $this->Text->autoParagraph($contenu); 



                ?>


                  <span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-<?= $tweet->id ;?>"><?= $tweet->nb_like ;?></span></span>

                <span class="nb_comm_share"><?= $tweet->nb_commentaire ?> commentaire(s) - <?= $tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                <?php
                                 if(isset($authName))
              {
                ?>
                
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <?= $this->Html->link('J\'aime', '/like-'.$tweet->id.'', array('data-value' => ''.$tweet->id.'','class' => 'link_like')); 
                   
                     ?>
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
                  
               <?= $this->Html->link('Commenter', ['action' => 'view',  $tweet->id]); 

               ?>
               &nbsp;&nbsp;&nbsp;
               <?php

               
           }
                                if(isset($authName))
              {
           
               if($tweet->user_id != $authName AND $tweet->share == 0) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
                 ?>

                  <span class="sharelink" data-idtweet="<?= $tweet->id ;?>">
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              
                

                <a href="#" data-idtweet="<?= $tweet->id ;?>" data-auteurtweet="<?= $tweet->user_id ;?>" title="Partager"  class="addshare" onclick="return false;">Partager</a>
              </span>
                <?php
            }
          }
            ?>
        </span>
    </div>

        <?php  endforeach; ?>
        
</div>


            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>

 <?php         

        } 

        ?>

<?= $this->Html->script('/js/iasdeletetweet.js') ?> <!-- suppression d'un tweet + scroll ajax liste des tweets -->





           

           




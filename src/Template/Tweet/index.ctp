<?php
use Cake\I18n\Time;

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
                
                 foreach ($tweet as $tweet):   
                    ?>
                
                 
            <div class="tweet">
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
                <?= $this->Html->Link("Effacer ce tweet", ['controller' => 'Tweet','action' => 'delete',$tweet->id ]) ?> <!-- je peut effacer mon post -->
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


                        <?
                    
                }
                ;
                ?>
  </ul>
</div>
<!-- fin bouton dropdown tweet -->
            <?php
            if($tweet->share == 1) // si tweet partagé
            {
                echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'<br />';
                 echo  $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span> - 
            <?
            }
            else
            {
            echo $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span> - 
            <?php
            }

?>
             <?= $tweet->created->i18nformat('dd MMMM YYYY'); ?>
             <?php

             $contenu = str_replace('</p>', '', $tweet->contenu_tweet);
             ?>
                <?= $this->Text->autoParagraph($contenu); ?>

                
                <span class="nb_comm_share"><?= $tweet->nb_commentaire ?> commentaire(s) - <?= $tweet->nb_partage ?> partage(s)</span>
                <br />
                <br />
                <span class="link_comm_share">
                     <span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> 

                     <?= $this->Html->link('J\'aime', ['action' => 'view']); 

                     ?>
               &nbsp;&nbsp;&nbsp;
               <?
                               
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
               <?

               
           }
           
               if($tweet->share != 1 AND $tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
                 ?>
              <span class="glyphicon glyphicon-share" style="vertical-align:center"></span>
              <?php
                echo $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.''); 
                
            }
            ?>
        </span>
    </div>
        <?php  endforeach; 
        }?>






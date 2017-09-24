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
                        Ce profil est privé, vous devez vous abonner pour en voir le contenu.
                        </div>';

            }
            else
            {
                
                 foreach ($tweet as $tweet):   
                    ?>
                
                 
            <div class="tweet">
            <?php
            if($tweet->share == 1) // si tweet partagé
            {
                echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'<br />';
                 echo  $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span>
            <?
            }
            else
            {
            echo $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username?></span>
            <?php
            }

            $time = new Time($tweet->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>

             <span class="date_tweet">Posté <?= $date_tweet ?></span>
            
             <?php

             $contenu = str_replace('</p>', '', $tweet->contenu_tweet);
             ?>
                <?= $this->Text->autoParagraph($contenu); 

 
                
                if($tweet->allow_comment == 1) // si les commentaires sont désactivés
                {
                    echo '<div class="alert alert-info">Les commentaires sont désactivés pour cette publication</div>';
                }
                else
                {
                    ?>
               <span class="glyphicon glyphicon-comment green"></span>&nbsp;<?= $this->Html->link(''.$tweet->nb_commentaire.'', ['action' => 'view',  $tweet->id]); }?>

                

               <span class="glyphicon glyphicon-share-alt blue"></span>&nbsp;<?= $tweet->nb_partage ?>
               <?php
            if($tweet->share != 1 AND $tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
            ?>

            <span class="glyphicon glyphicon-share green_share"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.'');
        }      
            
                if($tweet->user_timeline == $authName) // si je suis sur mon mur
                {
                ?>
                
                <?= $this->Html->Link("Effacer ce tweet", ['controller' => 'Tweet','action' => 'delete',$tweet->id ], ['title' =>'delete', 'class' =>'deletetweet' ]) ?>
                <?php
                };
                ?>
    </div>
        <?php  endforeach; 
        }?>






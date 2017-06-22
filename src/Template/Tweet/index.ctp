<?php
use Cake\I18n\Time;
?>


<div class="col-sm-6">

            <?php

            if(isset($nb_tweet))
            {
                echo '<div class="alert alert-info">
                                Aucun tweet à afficher
                        </div>';
            }
            else
            {
?>
            <?php foreach ($tweet as $tweet): ?>
            <div class="tweet">
            <?php
            if($tweet->partage == 1)
            {
                echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'<br />';
            }
            ?>
            <?= $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
            <?=  $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'') ?>
            <?php
            $time = new Time($tweet->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
             <span class="date_tweet">Posté <?= $date_tweet ?></span>
            

                <?= $this->Text->autoParagraph($tweet->contenu_tweet); ?>

                <?php if($tweet->user_id == $authUser)
                {
                ?>
                
                <?= $this->Html->Link("Delete", ['controller' => 'Tweet','action' => 'delete',$tweet->id ], ['title' =>'delete', 'class' =>'deletetweet' ]) ?>
                <?php
                };
                ?>
               <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link(''.$tweet->nb_commentaire.' commentaires', ['action' => 'view',  $tweet->id]) ?>

                

               <span class="glyphicon glyphicon-share-alt"></span>&nbsp;<?= 'Partager '.$tweet->nb_partage.' fois' ?>
               <?php
            if($tweet->partage != 1 AND $tweet->user_id != $authUser) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager
            {
            ?>

            <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.'');
        }
        elseif($tweet->partage == 1)
        {

            ?>

             <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link('Supprimer ce partage', array('controller' => 'tweet', 'action' => 'delete', $tweet->id)) ;

            };


           

            
            ?>

    </div>
        <?php endforeach; }?>

</div>






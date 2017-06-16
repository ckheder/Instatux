<?php
use Cake\I18n\Time;
?>


<div class="col-sm-6">



            <?php foreach ($tweet as $tweet): ?>
            <div class="tweet">
            <?php
            if($tweet->user->username != $this->request->getParam('username'))
            {
                echo '<span class="glyphicon glyphicon-share-alt"></span>&nbsp; Partagé par '.$this->request->getParam('username').'<br /><br />';
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
            if($tweet->user_id != $authUser)
            {
            ?>

            <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.'') ?>

            <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link('Supprimer ce partage', array('controller' => 'partage', 'action' => 'delete', $tweet->partage->id_partage)) ;

            }
            ?>

    </div>
        <?php endforeach; ?>

</div>






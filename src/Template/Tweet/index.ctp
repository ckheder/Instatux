<?php
use Cake\I18n\Time;
?>


<div class="col-sm-6">



            <?php foreach ($tweet as $tweet): ?>
            <div class="tweet">
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

                 

    </div>
        <?php endforeach; ?>

</div>






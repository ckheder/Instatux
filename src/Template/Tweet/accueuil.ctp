<?php
use Cake\I18n\Time;
?>

<div class="col-sm-6">

        <?php



        ?>
            <?php foreach ($abonnement as $abonnement): ?>
            
              <div class="tweet">  
            <?= $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
            <?= $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'')?>
                        <?php
            $time = new Time($abonnement->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                <span class="date_tweet">Posté <?= __(h($date_tweet)) ?></span>
                <?= $this->Text->autoParagraph($abonnement->contenu_tweet) ?>

                    <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link(''.$abonnement->nb_commentaire.' commentaires', ['action' => 'view',  $abonnement->id]) ?>
               <span class="glyphicon glyphicon-comment"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$abonnement->id.'/'.$abonnement->user_id.'');
               ?>
            </div>
            <?php endforeach; ?>

</div>



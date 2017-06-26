<?php
use Cake\I18n\Time;
?>

<div class="col-sm-6">

        <?php



        ?>
            <?php foreach ($abonnement as $abonnement): ?>
            
              <div class="tweet">
              <?
                          if($abonnement->partage == 1)
            {
                echo '<br />';
                echo  $this->cell('Abonnement::avatar_user', ['user' => $abonnement->user_timeline, $abonnement]) ; 
            } 
            ?> 
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
                    <?php if($abonnement->user_id != $authUser)
                    {
                        ?>
               <span class="glyphicon glyphicon-share-alt"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$abonnement->id.'/'.$abonnement->user_id.'');
           }
               ?>
                <?= ' - Partager '.$abonnement->nb_partage.' fois' ?>
                <?= $abonnement->user->user_id ;?>
            </div>
            <?php endforeach; ?>

</div>



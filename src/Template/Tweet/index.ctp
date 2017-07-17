<?php
use Cake\I18n\Time;

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
            if($tweet->share == 1)
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
            
             <?php // parsage des #
             $contenu = preg_replace( "/#([^\s]+)/",$this->Html->link('#$1','/search-%23$1'), $tweet->contenu_tweet); 
             $contenu = str_replace('</p>', '', $contenu);
             ?>
                <?= $this->Text->autoParagraph($contenu); ?>

                <?php if($tweet->user_timeline == $authName)
                {
                ?>
                
                <?= $this->Html->Link("Effacer ce tweet", ['controller' => 'Tweet','action' => 'delete',$tweet->id ], ['title' =>'delete', 'class' =>'deletetweet' ]) ?>
                <?php
                };
                ?>
               <span class="glyphicon glyphicon-comment green"></span>&nbsp;<?= $this->Html->link(''.$tweet->nb_commentaire.'', ['action' => 'view',  $tweet->id]) ?>

                

               <span class="glyphicon glyphicon-share-alt blue"></span>&nbsp;<?= $tweet->nb_partage ?>
               <?php
            if($tweet->share != 1 AND $tweet->user_id != $authName) // si l'auteur du tweet est différends de l'utilisateur courant on peut partager et que le tweet n'est pas un partage
            {
            ?>

            <span class="glyphicon glyphicon-share green_share"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$tweet->id.'/'.$tweet->user_id.'');
        }
        if($tweet->share == 1 AND $tweet->user_timeline == $authName)
        {

            ?>

             <span class="glyphicon glyphicon-remove red"></span>&nbsp;<?= $this->Html->link('Supprimer ce partage', array('controller' => 'tweet', 'action' => 'delete', $tweet->id)) ;

            };


           

            
            ?>

    </div>
        <?php endforeach; }?>






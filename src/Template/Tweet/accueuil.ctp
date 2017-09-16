<?php
use Cake\I18n\Time;
?>



            <?php foreach ($abonnement as $abonnement): ?>
            
              <div class="tweet">
              <?
                          if($abonnement->share == 1)
            {
                echo '<br />';
                echo  $this->cell('Abonnement::avatar_user', ['user' => $abonnement->user_timeline, 'share' => $abonnement->share,'other'=> $abonnement->other_user, $abonnement]) ; 
            } 
            else
            {
            echo  $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
            echo  $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'',['class' => 'link_username_tweet']) ;?>
            <span class="alias_tweet">@<?=$abonnement->user->username ?></span>
             <?php
            }
 
            
                       
            $time = new Time($abonnement->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                <span class="date_tweet">Posté <?= __(h($date_tweet)) ?></span>

                <?= $this->Text->autoParagraph($abonnement->contenu_tweet); ?>
    
                    <span class="glyphicon glyphicon-comment green"></span>&nbsp;<?= $this->Html->link(''.$abonnement->nb_commentaire.'', ['action' => 'view',  $abonnement->id]) ?>
            <?php if($abonnement->user_id != $authName)
                    {
                        ?>
               <span class="glyphicon glyphicon-share-alt blue"></span>&nbsp;<?= $this->Html->link('Partager', '/partage/add/'.$abonnement->id.'/'.$abonnement->user_id.'');
           }
               ?>
                 <span class="glyphicon glyphicon-share-alt blue"></span>&nbsp;<?= $abonnement->nb_partage ?>
                <?= $abonnement->user->user_id ;?>
            </div>
            <?php endforeach; ?>





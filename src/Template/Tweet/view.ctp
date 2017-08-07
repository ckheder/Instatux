<?php
use Cake\I18n\Time;
use Cake\Network\Request;


 foreach ($tweet as $tweet): ?>

<div class="tweet">
            <?= $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
            <?= $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$tweet->user->username ?></span>
            
                        <?php
            $time = new Time($tweet->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
             <span class="date_tweet">Posté <?=  h($date_tweet) ?></span>

<?= $this->Text->autoParagraph($tweet->contenu_tweet); ?>

         
</div>

 <?= $this->Form->create('Commentaires', array('url'=>array('controller'=>'commentaires', 'action'=>'add'))) ?>
<?= $this->Form->input('comm', ['placeholder' => 'Commentaire...', 'label'=> '']) ?>
<?= $this->Form->hidden('id', ['value' => $this->request->getParam('id')]) // id du tweet?>
<?= $this->Form->hidden('userosef', ['value' => $tweet->user->username]) // auteur du tweet?>
<div class="text-center">
<?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
<?= $this->Form->end(); ?>
<br />
        <?php foreach ($tweet->commentaires as $commentaires): ?>
            <div class="tweet">
 <?= $this->Html->image(''.$commentaires->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
 <?= $this->Html->link($commentaires->user->username,'/'.$commentaires->user->username.'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$commentaires->user->username ?></span>

                         <?php
            $time = new Time($commentaires->created);
            $time->toUnixString();
            $date_comm = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            

?>
 <span class="date_tweet">Commenté <?= $date_comm ?></span>

<?= $this->Text->autoParagraph(strip_tags($commentaires->comm, '<a>')) ; ?>
<span class="glyphicon glyphicon-comment"></span>&nbsp;
<?php if($tweet->user_id == $authName or $commentaires->auteur == $authUser)

    echo  $this->Html->link("Delete", ['controller' => 'Commentaires','action' => 'delete', $commentaires->id, $tweet->id],['title' =>'delete', 'class' =>'deletetweet' ]);


?>


        </div>
        <?php endforeach; ?>


<?php endforeach; ?>


<?php
use Cake\I18n\Time;
use Cake\Network\Request;
?>
<div class="col-sm-6">
<?php foreach ($tweet as $tweet): ?>

<div class="tweet">
            <?= $this->Html->image(''.$tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
            <?= $this->Html->link($tweet->user->username,'/'.$tweet->user->username.'') ?>
            
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
<br />
 <?= $this->Form->create('Commentaires', array('class'=>'form-inline','url'=>array('controller'=>'commentaires', 'action'=>'add'))) ?>
<?= $this->Form->Textarea('comm', ['rows' => '2', 'cols' => '58', 'placeholder' => 'Commentaire...']) ?>
<?= $this->Form->hidden('id', ['value' => $this->request->getParam('id')]) // id du tweet?>
<?= $this->Form->hidden('userosef', ['value' => $tweet->user_id]) // auteur du tweet?>
<br />
<br />
<div class="text-center">
<?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
<?= $this->Form->end(); ?>
<br />
        <?php foreach ($tweet->commentaires as $commentaires): ?>
            <div class="tweet">
 <?= $this->Html->image(''.$commentaires->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
 <?= $this->Html->link($commentaires->user->username,'/'.$commentaires->user->username.'') ?>

                         <?php
            $time = new Time($commentaires->created);
            $time->toUnixString();
            $date_comm = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>

 <span class="date_tweet">Commenté <?= $date_comm ?></span>
<?php //parsage comm hashtag
  $comm = preg_replace( "/#([^\s]+)/",$this->Html->link('#$1','/search-%23$1'), $commentaires->comm); 
             
?>
<?= $this->Text->autoParagraph(strip_tags($comm, '<a>')) ; ?>
<span class="glyphicon glyphicon-comment"></span>&nbsp;
<?php if($tweet->user_id == $authUser or $commentaires->auteur == $authUser)

    echo  $this->Html->link("Delete", ['controller' => 'Commentaires','action' => 'delete', $commentaires->id, $tweet->id],['title' =>'delete', 'class' =>'deletetweet' ]);


?>


        </div>
        <?php endforeach; ?>


<?php endforeach; ?>
</div>

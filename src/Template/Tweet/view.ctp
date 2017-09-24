<?php
use Cake\I18n\Time;
use Cake\Network\Request;

           if(isset($test_tweet))
            {
                echo '<div class="alert alert-info">
                                Ce tweet n\'existe pas
                        </div>';
            }
                        elseif(isset($no_follow))
            {
                echo '<div class="alert alert-danger">
                        Cette publication est privée, vous devez vous abonner à son auteur pour en voir le contenu.
                        </div>';

            }
            else
            {


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

<?php if(!$tweet->allow_comment == 1) // si les commentaires sont autorisés
{
   echo $this->Form->create('Commentaires', array('url'=>array('controller'=>'commentaires', 'action'=>'add'))) ?>

<?= $this->Form->input('comm', ['placeholder' => 'Commentaire...', 'label'=> '']) ?>
<?= $this->Form->hidden('id', ['value' => $this->request->getParam('id')]) // id du tweet?>
<?= $this->Form->hidden('userosef', ['value' => $tweet->user->username]) // auteur du tweet?>
<div class="text-center">
<?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
<?= $this->Form->end(); ?>
<hr>
<?php

//Bloquer les commentaires 

if($tweet->user_id == $authName AND $tweet->allow_comment == 0)
{
    echo $this->Form->create('', array('url'=>array('controller'=>'tweet', 'action'=>'allow_comment')));
    echo $this->Form->hidden('allow_comment', ['value' => $tweet->allow_comment]); 
    echo $this->Form->hidden('id_tweet', ['value' => $this->request->getParam('id')]); ?>

<div class="text-center">

<?= $this->Form->button('Désactiver les commentaires', array('class'=>'btn btn-danger')) ?>
<hr>
</div>
<?= $this->Form->end();
}


?>
<!-- Fin bloquer les commentaires -->
<?php
if($tweet->nb_commentaire == 0)
{
    echo '<div class="alert alert-info">Aucun commentaire pour cette publication</div>';
}
else
{
    ?>
<div class="text-center"><h3><?= $tweet->nb_commentaire ;?>&nbsp commentaire(s)</h3></div>

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
        <?php endforeach; 
}
}
else
{
// commentaires non autorisés
 echo '<div class="alert alert-danger">Les commentaires sont désactivés pour cette publication</div>';
 if($tweet->user_id == $authName)
{
    echo $this->Form->create('', array('url'=>array('controller'=>'tweet', 'action'=>'allow_comment')));
    echo $this->Form->hidden('allow_comment', ['value' => $tweet->allow_comment]); 
    echo $this->Form->hidden('id_tweet', ['value' => $this->request->getParam('id')]); ?>

<div class="text-center">

<?= $this->Form->button('Activer les commentaires', array('class'=>'btn btn-success')) ?>
<hr>
</div>
<?= $this->Form->end();
}

}
endforeach;}?>


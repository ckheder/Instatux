<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

                echo $this->Form->button('Répondre', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalConv',
                  'class' => 'btn btn-info pull-left']) ;

                  
?>

 <div class="dropdown pull-right">
  <button class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><?= $this->html->link('Supprimer cette conversation', [
                 'controller' => 'Conversation',
                  'action' => 'edit',
                  $this->request->getParam('id')]) ?></li>
    <li><?= $this->Html->link('Bloquer '.$destinataire.'', ['controller' => 'Blocage','action' => 'add', $destinataire]); ?></li>
    <li><a href="#">JavaScript</a></li>
  </ul>
</div> 

<br />
<br />
Nombre de message : <?= $nb_msg;?>
<br />
<br />

 <?= $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add'))); ?>
                
<textarea name="message" class="textarea_message" placeholder=" Répondre à <?= $destinataire ?>..."></textarea>
<br />
<?= $this->Form->hidden('conversation', ['value' => $this->request->getParam('id')]) // id de la conv ?>  
<?= $this->Form->hidden('destinataire', ['value' => $destinataire]) // id du destinataire?>

                <br />
<div class="text-center">
                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
                <br />

                <?= $this->Form->end(); ?>


            <?php foreach ($message as $message): ?>
            
            <?php if($message->user_id == $authName) 
            {
               
               echo  $this->Html->image(''.$message->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter_left')); 
               ?>
            <div class="bubble me">
                <?php 
            }
            else
                { 
                    echo  $this->Html->image(''.$message->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter_right')) ; ?>
                    <div class="bubble other">
                    <?php
                }
                ?>
           
            <?= $this->Html->link(h($message->user->username),'/'.h($message->user->username).'',['class' => 'link_username_tweet']) ?><span class="alias_tweet">@<?=$message->user->username ?></span>
<br />
                                    <?php
            $time = new Time($message->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);

            $date_tweet = str_replace('il y a','', $date_tweet)
            ?>
             <span class="date_message"> <?=  h($date_tweet) ?></span>

                <?= $this->Text->autoParagraph(strip_tags($message->message, '<a>'))  ?>
                
            </div>
            
<br />
<br />
<br />
<br />
<br />



            <?php endforeach; ?>


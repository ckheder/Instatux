<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

                  
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
    <li><a href="#">Signaler</a></li>
  </ul>
</div> 
<br />
<br />

 <?= $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add'))); ?>
                
<?= $this->Form->Textarea ('message' ,['cols' => 45, 'rows' => 3, 'placeholder'=> 'Répondre à '.$destinataire.' ...']); ?>
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
            
            <?php if($message->user_id == $authName) // moi 
            {
               echo ' <div class="messagemoi">';
               echo  $this->Html->image(''.$message->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail')); 
 
            }
            else
                { 
                  echo '<div class="messagemoi other">'; // destinataire
                    echo  $this->Html->image(''.$message->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail right'));
                }
                ?>           

                <p><?= $this->Text->autoParagraph(strip_tags($message->message, '<a>'))  ?></p>

                  <span class="date_message"> <?=  $message->created->i18nformat('dd MMMM YYYY') ?></span>
                
            </div>
            




            <?php endforeach; ?>


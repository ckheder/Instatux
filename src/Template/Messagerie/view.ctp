<?php
use Cake\I18n\Time;
use Cake\Routing\Router;
?>
<div class="col-sm-6">
<?php


                echo $this->Form->button('Répondre', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalConv',
                  'class' => 'btn btn-success pull-left']) ;

                  echo $this->html->link('Supprimer cette conversation', [
                 'controller' => 'Conversation',
                  'action' => 'edit',
                  $this->request->getParam('id')],[
                  'class' => 'btn btn-danger pull-right',
                  'confirm' => ('Are you sure you want to delete ?')]) ;
?>

<br />
<br />
Nombre de message : <?= $nb_msg;?>
<br />



            <?php foreach ($message as $message): ?>
            
            <?php if($message->user_id == $authUser) 
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
           
            <?= $this->Html->link($message->user->username,'/'.$message->user->username.''); ?>
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
             <?php
               $contenu_message = preg_replace( "/#([^\s]+)/",$this->Html->link('#$1','/search-%23$1'), $message->message); 
             ?>

                <?= $this->Text->autoParagraph(strip_tags($contenu_message, '<a>'))  ?>
                
            </div>
            
<br />
<br />
<br />
<br />
<br />

                        <?php
if($message->user_id == $authUser)
{
 $destinataire = $message->destinataire;
 }
 else
 {
 $destinataire = $message->user_id;
 }
?>

            <?php endforeach; ?>
            



</div>
<?php
echo $this->Modal->create(['id' => 'ModalConv']) ;
                echo $this->Modal->header('Répondre', ['close'=>false]) ;
                echo $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'add')));
                ?>
<textarea name="message" class="textarea_message" placeholder="Message..."></textarea>
<br />
<?= $this->Form->hidden('conversation', ['value' => $this->request->getParam('id')]) // id de la conv ?>  
<?= $this->Form->hidden('user_id', ['value' => $destinataire]) // id du destinataire?>

                <br />
<div class="text-center">
                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
                <br />

                <?= $this->Form->end(); 
               echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]);
                echo $this->Modal->end() ;


?>

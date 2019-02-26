<?php
use Cake\I18n\Time;                
?>
<div class="text-center"><h3>Répondre à <?= $destinataire ;?></h3></div>
<?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'form_message')); ?>
                
<?= $this->Form->Textarea('message' ,['id'=> 'message','placeholder'=> 'Votre message...','label'=> '','class' =>'emojis-plain']); ?>
<br />
<?= $this->Form->hidden('conversation', ['id'=>'conversation','value' => $this->request->getParam('id')]) // id de la conv ?>  
<?= $this->Form->hidden('destinataire', ['id'=> 'destinataire','value' => $destinataire]) // id du destinataire?>



                <?= $this->Form->end(); ?>

<p id="etattype"></p>

                <div id="list_conv">

            <?php foreach ($message as $message): ?>
            
            <?php if($message->user_id == $authName) // moi 
            {
               echo ' <div class="messagemoi">';
               echo  $this->Html->image('/img/avatar/'.$message->user_id.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail')); 
 
            }
            else
                { 
                  echo '<div class="messagemoi other">'; // destinataire
                    echo  $this->Html->image('/img/avatar/'.$message->user_id.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail'));
                }
                ?>           

               <?= $message->message;  ?>

                  <span class="datemessage"> <?=  $message->created->i18nformat('dd MMMM YYYY - HH:mm') ?></span>
                
            </div>
            
            <?php endforeach; ?>

          </div>

            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>

          </div>
    

<script type="text/javascript">

  var authname = "<?= $authName ?>"; // expediteur
  var destinataire  = "<?= $destinataire ?>"; // destinataire
  var room = "<?= $this->request->getParam('id') ?>"; // id de conversation

</script>


<?= $this->Html->script('/js/clientmessagerie.js') ?>



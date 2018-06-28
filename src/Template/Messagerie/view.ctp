<?php
use Cake\I18n\Time;
use Cake\Routing\Router;
                  
?>

                <div id="etatco"></div>



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

<?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'form_message')); ?>
                
<?= $this->Form->Textarea('message' ,['id'=> 'message','placeholder'=> 'Répondre à '.$destinataire.' ...','label'=> '','class' =>'emojis-plain textarea_comm']); ?>
<br />
<?= $this->Form->hidden('conversation', ['id'=>'conversation','value' => $this->request->getParam('id')]) // id de la conv ?>  
<?= $this->Form->hidden('destinataire', ['id'=> 'destinataire','value' => $destinataire]) // id du destinataire?>
<!-- pour le js node -->
<?= $this->Form->hidden('avatar', ['id'=> 'avatar','value' => $authAvatar]) // id du destinataire?>


                <?= $this->Form->end(); ?>

<p id="etattype"></p>

                <div id="list_conv">

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

               <?= $message->message;  ?>

                  <span class="date_message"> <?=  $message->created->i18nformat('d MMMM YYYY HH:mm') ?></span>
                
            </div>
            




            <?php endforeach; ?>

          </div>

            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>
    <?= $this->Html->script('/js/iasmessage.js') ?>    

<script type="text/javascript">

  var authname = "<?= $authName ?>"; // expediteur
  var destinataire  = "<?= $destinataire ?>"; // destinataire
  var room = "<?= $this->request->getParam('id') ?>"; // id de conversation

</script>


<?= $this->Html->script('/js/clientmessagerie.js') ?>



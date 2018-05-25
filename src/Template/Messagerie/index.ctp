<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

if (isset($authName))
{
  ?>
<div class="text-center">


                <?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'new_message')); ?>
                <?= $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'destinataire', 'required'=> 'required']) ;?>
                <?=$this->Form->hidden('indexmess', ['value' => 1]) ; // signal au controller que je suis sur la page d'accueil des messages?> 

                <?=$this->Form->Textarea('message', ['placeholder' =>'Votre message...']) ;?>
<!-- <textarea name="message" class="textarea_message" placeholder="Message..."></textarea> -->
<br /> 

                <br />
<div class="text-center">
                <?= $this->Form->button('Envoyer', array('class'=>'btn btn-success')) ?>
</div>
                <?= $this->Form->end(); 

?>

<br />
<br />
</div>

            <?php foreach ($message as $message): ?>
            <div class="tweet">

                                      <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                <li>
                <?= $this->Html->Link("Effacer cette conversation", ['controller' => 'Conversation','action' => 'edit',$message->conv ]) ?> <!-- je peut effacer mon post -->
            </li>

             </li>

                        <li><?= $this->Html->link('Signaler ', ['action' => 'view']); ?></li> <!-- un post qui ne m'appartient pas , je peut le signaler -->
  </ul>
</div>
                <?= $this->cell('Avatarmessage', ['user_id' => $message->user_id , 'destinataire' => $message->destinataire, 'authname' => $authName]) ;  ?>
                              - <span class="date_message"> <?=  $message->created->i18nformat('dd MMMM YYYY') ?></span>

            <?php 
            $last_message = strip_tags($message->message,'<a>');
            ?>
                   
                <?= $this->Text->autoParagraph($this->Html->link($last_message,'/conversation-'.$message->conv.'')); ?>

                
            </div>
            <?php endforeach; ?>

<?= $this->Html->script('messagerie.js') ?> <!-- message depuis les fenetres modals , la page d'accueil de la messagerie et l'auto completion des abonnements -->                 
<?php } ?>



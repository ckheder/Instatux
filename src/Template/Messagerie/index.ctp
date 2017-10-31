<?php
use Cake\I18n\Time;
use Cake\Routing\Router;
?>
<div class="text-center">
<?php
                echo $this->Form->button('Nouveau message', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalNewMessage',
                  'class' => 'btn btn-info']) ;
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


    <script type="text/javascript">
      $(function() 
      {

    $( "#autocomplete").autocomplete({

source:'<?php echo Router::url(array("controller" => "Abonnement", "action" => "indexmessagerie")); ?>',

select: function( event, ui ) {


             
            $("#destinataire").val(ui.item.username);
            


     }})});


      
</script>                                       

<!-- modal envoi de message -->
<?= $this->element('modalnewmessage') ?>
<!-- fin modal envoi de message -->



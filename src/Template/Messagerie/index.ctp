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
Nombre de conversation : <?= $nb_conv ?>
<br />
<br />
            <?php foreach ($message as $message): ?>
            <div class="tweet">
                <?= $this->cell('Avatarmessage', ['user_id' => $message->user_id , 'destinataire' => $message->destinataire, 'authname' => $authName]) ;  ?>
                            <?php
            $time = new Time($message->created);
            $time->toUnixString();
            $date_message = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                   <span class="date_tweet">Dernier message <?= $date_message ?></span>
                <?= $this->Text->autoParagraph($this->Html->link(h($message->message),'/conversation-'.$message->conv.'')); ?>

                <span class="glyphicon glyphicon-envelope"></span><?= $this->cell('Nbmessage', ['conv' => $message->conv]);?> message(s)
            
            
              <?= $this->Form->postLink("Delete", ['controller' =>'Conversation' ,'action' => 'edit',$message->conv ], ['title' =>'delete', 'class' =>'deletetweet' ], ['confirm' => __('Are you sure you want to delete # {0}?', $message->conv)]) ?>
                
            </div>
            <?php endforeach; ?>
<?php
echo $this->Modal->create(['id' => 'ModalNewMessage']) ;
                echo $this->Modal->header('Nouveau Message', ['close'=>false]) ;
                ?>

                <?php
                echo $this->Form->create('Messagerie', array('class'=>'form-inline','url'=>array('controller'=>'messagerie', 'action'=>'addprofil')));

                echo $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'destinataire']) ;

                //echo $this->Form->hidden('destinataire', ['id' => 'idmembre', 'placeholder' => 'id']) ;



?>
                <br />
                <br />
<textarea name="message" class="textarea_message" placeholder="Message..."></textarea>
<br /> 

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

    <script type="text/javascript">
      $(function() 
      {

    $( "#autocomplete").autocomplete({

source:'<?php echo Router::url(array("controller" => "Abonnement", "action" => "indexmessagerie")); ?>',

select: function( event, ui ) {


             
            $("#destinataire").val(ui.item.username);
            


     }})});


      
</script>



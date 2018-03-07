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
                
<?= $this->Form->Textarea ('message' ,['id'=> 'message','placeholder'=> 'Répondre à '.$destinataire.' ...']); ?>
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

               <?= $this->Text->autoParagraph(strip_tags($message->message, '<a>'))  ?>

                  <span class="date_message"> <?=  $message->created->i18nformat('d MMMM YYYY HH:mm') ?></span>
                
            </div>
            




            <?php endforeach; ?>

          </div>

            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>
           

            <script>
              var ias = jQuery.ias({
  container:  '#list_conv',
  item:       '.messagemoi',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin de la conversation"}));
  ias.extension(new IASPagingExtension());
</script>

<script type="text/javascript">

  var authname = "<?= $authName ?>"; // expediteur
  var destinataire  = "<?= $destinataire ?>"; // destinataire

</script>

<script>
    $(document).ready(function() {
      $("#message").keypress(function(e) {
        if (e.which == 13) {
             
    $('#form_message').submit();
  }
   });
    $('#form_message').submit(function(e){

      e.preventDefault();
      
          moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LLL'); // mise en forme
        $.ajax({
                type: 'POST',
                url: '/instatux/message/add',
                dataType: 'json',
                data: $('#form_message').serialize(),
    success: function(data){
    
     $('#list_conv').prepend('<div class="messagemoi"><img src="img/' + data.avatar_session + '"alt="image utilisateur" class="img-thumbail"/><p>' + data.message +'</p><span class="date_message">' + date_msg + '</span></div>');

$('#message').val('');

    },
    error: function(data)
    {
        alert('fail');       
    }
                
         });
    });
  


    });
</script>



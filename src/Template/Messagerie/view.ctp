<!--

 * view.ctp
 *
 * Visualisation d'une conversation
 *
 */ -->
<?php

      use Cake\I18n\Time;   

?>

<!-- formulaire de réponse -->

<?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'form_message')); ?>

<!-- textarea -->
                
<textarea name="message" class="form-control emojis-plain" id="message" placeholder="Votre message..."  rows="3"></textarea>

<!-- lien ajouter un média -->

<a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="media-button-mess"  title = "Ajouter un média" data-target="#modalmedia"><span class="glyphicon glyphicon-facetime-video"></span></a>

<?= $this->Form->hidden('conversation', ['id'=>'conversation','value' => $this->request->getParam('id')]) // id de la conv ?>

<?= $this->Form->hidden('typeconv', ['value' => $type_conv]); // type de la conv : duo ou multiple 

  if(isset($destinataire)) // si conversation duo, récupération et transmission du destinataire pour les test de notif
{
  echo $this->Form->hidden('destinataire', ['value' => $destinataire]); // type de la conv : duo ou multiple 
}

echo $this->Form->end(); // fin de formulaire

echo $this->element('conversation') ;

echo $this->element('modaladdconv'); ?>

<!-- preview d'une image uploadée -->
      
<div id="previewmediamess" contenteditable="true"></div> 

<!-- Node JS indiquera ici si mon destinataire est en train d'écrire -->

<p id="etattype"></p>

<!-- liste des messages -->

          <div id="list_conv">

              <?php foreach ($message as $message): ?>
            
                <div class="messagemoi">

                <!-- avatar -->

                <?= $this->Html->image('/img/avatar/'.$message->user_id.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail'));?>

                <!-- date message -->

                <span class="datemessage"> <?=  $message->created->i18nformat('dd MMMM YYYY - HH:mm') ?></span> 

                <!-- message -->        

                  <?= $message->message;  ?>
     
          </div>
            
              <?php endforeach; ?>

          </div>

<!-- pagination -->

            <div id="pagination">

                                      <?= $this->Paginator->options([

                                          'url' => array('controller' => '/conversation-'.$this->request->getParam('id').'')

                                        ]);?>

              <?= $this->Paginator->next('Next page'); ?>

            </div>

<script type="text/javascript"> // pour Node JS

  var authname = "<?= $authName ?>"; // expediteur
  var room = "conv<?= $this->request->getParam('id') ?>"; // id de conversation
  var typeconv = "<?= $type_conv ?>"; // type de conversation duo | multiple

</script>

<?= $this->Html->script('/js/clientmessagerie.js') ?>



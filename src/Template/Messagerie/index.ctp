<!--

 * index.ctp
 *
 * Page d'accueil de la messagerie
 *
 */ -->

<div id="displayconv">
  <br />
<div class="text-center">
  <h4>
    <span class="glyphicon glyphicon-envelope"></span>
     Nouveau message
  </h4>
</div>

<!-- formulaire de nouveau message -->

                <?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'new_message')); ?>

                <?= $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'À :','prepend' => ' <span class="glyphicon glyphicon-user"></span> ','label'=>'', 'required'=> 'required']) ;?>

                <?=$this->Form->Textarea('message', ['class' => 'emojis-plain', 'id' =>'textarea_message','placeholder' =>'Votre message...','rows' => '7', 'required'=> 'required']) ;?>

                  <div class="text-center">

                    <br />

                <?= $this->Form->input('Envoyer', array('type'=>'submit')) ?>

                <br />

                <br />

                  </div>

                <?= $this->Form->end(); ?>

</div>


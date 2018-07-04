<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

?>

<div class="text-center">

  <h3>Nouveau Message </h3>


                <?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'new_message')); ?>
                <?= $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'destinataire','prepend' => ' <span class="glyphicon glyphicon-user"></span> ','label'=>'', 'required'=> 'required']) ;?>

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
</div>
<div class="text-center">
 <h4>Mes conversations </h4>
 <br />
 </div>

            <?php foreach ($conv as $conv): ?>
            <div class="tweet">

                                      <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                <li>
                <?= $this->Html->Link("Effacer cette conversation", ['controller' => 'Conversation','action' => 'edit',$conv->conv ]) ?> <!-- je peut effacer mon post -->
            </li>

             </li>

                        <li><?= $this->Html->link('Signaler ', ['action' => 'view']); ?></li> <!-- un post qui ne m'appartient pas , je peut le signaler -->
  </ul>
</div>
               <?= $this->Html->image(''.$conv->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>

<?= $this->Html->link(h($conv->participant2),'/'.h($conv->participant2).'',['class' => 'link_username_tweet']) ?>
                              
<span class="date_message">- Dernier message :  <?=  $conv->created->i18nformat('dd MMMM YYYY HH:mm:ss') ?></span>
                   
                <?= $this->Html->link('Voir la conversation','/conversation-'.$conv->Messagerie['conv'].'',['class' => 'link_conv']); ?>

                
            </div>
            <?php endforeach; ?>

                 



<?php
use Cake\I18n\Time;
use Cake\Routing\Router;

?>

                <?= $this->Form->create('Messagerie', array('url'=>array('controller'=>'messagerie', 'action'=>'add'),'id'=>'new_message')); ?>
                
                <?= $this->Form->input('destinataire', ['id' => 'autocomplete', 'placeholder' => 'À :','prepend' => ' <span class="glyphicon glyphicon-user"></span> ','label'=>'', 'required'=> 'required']) ;?>

                <?=$this->Form->Textarea('message', ['id' =>'textarea_message','placeholder' =>'Votre message...','rows' => '7', 'required'=> 'required']) ;?>
                <!-- envoi depuis messagerie  -->


<div class="text-center">
                <?= $this->Form->input('Envoyer', array('type'=>'submit')) ?>
</div>
                <?= $this->Form->end(); 

?>
<br />

<div id = "conv">
 <?php if($nb_conv == 0)
 {
  echo '<div class="alert alert-warning text-center" id="noconv">
                        Aucune conversation active.
                        </div>';
 }
 else
{
?>
<div class="text-center"><h4><span class="glyphicon glyphicon-cog"></span><span id="nb_conv">&nbsp;<?= $nb_conv ;?></span> conversation(s) active(s)</h4></div>
<?php
           foreach ($conv as $conv): ?>
            <div class="tweet" data-conv ="<?= $conv->Messagerie['conv'] ;?>">

                                      <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

                <li>
                 <a href="#" data-conv="<?= $conv->Messagerie['conv'] ;?>"  title="Effacer ce commentaire"  class="deleteconv" onclick="return false;">Effacer cette conversation</a>
            </li>

             </li>

                        <li><?= $this->Html->link('Signaler ', ['action' => 'view']); ?></li> <!-- un post qui ne m'appartient pas , je peut le signaler -->
  </ul>
</div>
               <?= $this->Html->image('/img/avatar/'.$conv->participant2.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>

<?= $this->Html->link(h($conv->participant2),'/'.h($conv->participant2).'',['class' => 'link_username_tweet']) ?>
                              
<span class="date_message">- Dernier message :  <?=  $conv->created->i18nformat('dd MMMM YYYY HH:mm:ss') ?></span>
                   
                <?= $this->Html->link('Voir la conversation','/conversation-'.$conv->Messagerie['conv'].'',['class' => 'link_conv']); ?>

                
            </div>
            <?php endforeach;} ?>

      </div>           
<?= $this->Html->script('deleteconv.js') ?>


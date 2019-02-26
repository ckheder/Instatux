<div class="info_conv">


 	<?= $this->Html->image('/img/avatar/'.$destinataire.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-thumbail')); ?>
 	<?= $destinataire ;?> : <span id="etatco"></span>
 		
 
</div>

<div class="text-center"><h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Options</h4></div>
  <ul class="statut_notif">
    <li><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;<a href="#" data-idconv="<?= $this->request->getParam('id') ;?>"  title="Supprimer cette conversation"  id="deleteconv"  onclick="return false;">Supprimer cette conversation</a></li>              
    <li><span class="glyphicon glyphicon-ban-circle"></span>&nbsp; <a href="#" data-username="<?= $destinataire ;?>" data-action="add" title="Bloquer <?= $destinataire ;?>"  id="addblock"  onclick="return false;">Bloquer <?= $destinataire ;?></a></li>
    <li><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<a href="#">Signaler</a></li>
  </ul>

<?php foreach ($avatar_user as $avatar): ?>
	<span class="glyphicon glyphicon-share-alt blue_actu"></span>&nbsp;
<?= $this->Html->image(''.$avatar->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link(h($user),'/'.h($user).'');
echo ' à partagé la '; ?><?= $this->Html->link('publication', ['action' => 'view',  $abonnement->id]) ?>
<?php echo ' de '.$this->Html->link(h($abonnement->user->username),'/'.h($abonnement->user->username).'').'<hr>'?>
<?php endforeach; ?>
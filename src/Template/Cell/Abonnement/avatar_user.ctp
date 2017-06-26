<?php foreach ($avatar_user as $avatar): ?>
<?= $this->Html->image(''.$avatar->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link($user,'/'.$user.'');
echo ' à partagé la '; ?><?= $this->Html->link('publication', ['action' => 'view',  $abonnement->id]) ?>
<?php echo ' de '.$this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'').'<hr>'?>
<?php endforeach; ?>
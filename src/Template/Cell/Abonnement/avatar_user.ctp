<?php foreach ($avatar_user as $avatar): 

// partie partage

if(isset($share))
{
?>

	<span class="glyphicon glyphicon-share-alt blue_actu"></span>&nbsp;
<?= $this->Html->image(''.$avatar->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link(h($user),'/'.h($user).'');
echo ' à partagé la '; ?><?= $this->Html->link('publication', ['action' => 'view',  $abonnement->id]) ?>
<?php echo ' de '.$this->Html->link(h($abonnement->user->username),'/'.h($abonnement->user->username).'').'<hr>';

}

elseif(isset($other))
{
	?>
		<span class="glyphicon glyphicon-play-circle blue_actu"></span>&nbsp;
<?= $this->Html->image(''.$avatar->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link(h($user),'/'.h($user).'');?>
&nbsp;<span class="glyphicon glyphicon-triangle-right blue_actu"></span>&nbsp;
<?= $this->Html->link(h($abonnement->user_timeline),'/'.h($abonnement->user_timeline)).'<hr>';
}




endforeach;
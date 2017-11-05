<?php foreach ($avatar_user as $avatar): 

// partie partage

if(isset($share)) // affichage de l'avatar de celui qui partage 
{
?>

	<span class="glyphicon glyphicon-share-alt blue_actu"></span>&nbsp;
<?= $this->Html->image(''.$avatar->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link(h($user),'/'.h($user).'');
echo ' à partagé la '; ?><?= $this->Html->link('publication', ['action' => 'view',  $abonnement->id]) ?>
<?php echo ' de '.$this->Html->link(h($abonnement->user->username),'/'.h($abonnement->user->username).'').'<hr>';

// affichage de l'avatar de celui qui est partagé

echo  $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter'));
echo  $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'',['class' => 'link_username_tweet']) ;?>
<span class="alias_tweet">@<?=$abonnement->user->username ?></span> - <?php

}






endforeach;
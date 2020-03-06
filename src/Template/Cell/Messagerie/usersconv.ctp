
<?php 
	foreach ($usersconv as $usersconv): ?>
      
     	<div>

     		<!--avatar -->

     		<img src="/instatux/img/avatar/<?= $usersconv->user_conv; ?>.jpg" title="<?= $usersconv->user_conv; ?>" alt="image utilisateur" class="img-circle img_listconv">

     		<!--lien vers profil -->

			<a href="/instatux/<?= $usersconv->user_conv; ?>" class="link_username_tweet"><?= $usersconv->user_conv; ?></a>

		</div>
<?php 
	endforeach ;
?>

<?php
use Cake\Network\Request;
?>
<div class="inscriptionoffline">
	<?php
	if($this->request->getParam('username'))
	{
		?>
		<h3>Rejoignez Instatux aujourd'hui.</h3>
Connectez-vous ou inscrivez-vous pour suivre <?= $this->request->getParam('username') ;?>.
<br />
		<?php
	}
	else
	{
		?>
<h3>Rejoignez Instatux aujourd'hui.</h3>
Découvrez ce qui se passe dans le monde en temps réel.
<br />
<?php
}
?>
 <?= $this->Html->link('Inscription', // lien pour supprimer l'abonnement


                '/',
                [
                'title' => 'Inscription',
                'class' => 'btn btn-info navbar-btn', 
                'role' => 'button',
                'escape' => false]);
                ?>

              
</div>
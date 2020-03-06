<!--

 * encartinscriptionoffline.ctp
 *
 * Affichage d'informations sur la page d'accueil ou de profil pour les non inscrits
 *
 */

-->

<div class="inscriptionoffline">

	<?php

		if($this->request->getParam('username')) // si je visite un profil
	{
		?>
			<h3>Rejoignez Instatux aujourd'hui.</h3>

				Connectez-vous ou inscrivez-vous pour suivre <?= $this->request->getParam('username') ;?>.

			<br />

		<?php
	}
		else // page d'actualité offline
	{
		?>
			<h3>Rejoignez Instatux aujourd'hui.</h3>

				Découvrez ce qui se passe dans le monde en temps réel.

			<br />
<?php

	}

?>
 		<?= $this->Html->link('Inscription', // lien d'inscription
                							'/',
                								[
                									'title' => 'Inscription',
                									'class' => 'btn btn-info navbar-btn', 
                									'role' => 'button',
                									'escape' => false
                								]);
        ?>    
</div>
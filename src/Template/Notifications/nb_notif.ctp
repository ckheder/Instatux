<!--

 * nb_notif.ctp
 *
 * Affichage du nombre de notifications sur la barre de menu et sur l'onglet du navigateur
 *
 */ -->

<?php

		if($nb_notif > 0)
	{
?>
<script>

	var nb_notif = <?= $nb_notif ?>; // nombre de notification

	var title = $( ".titlepage" ).text(); // récupère le titre de page

	title = title.replace(/ *\([^)]*\) */g, ''); // empeche le (nb_notif) de se multiplier à l'affichage, réaffiche le titre

</script>

<sup>

	<span class="badge badge-notify"><?= $nb_notif ?></span> <!-- affichage sur la barre de menu -->

</sup>

<script>
			$( ".titlepage" ).empty().prepend( "(" + nb_notif + ") " + title ); // mise à jour du titre sur l'onglet
</script>

<?php
}
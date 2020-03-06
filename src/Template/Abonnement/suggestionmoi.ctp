<!--

 * suggestionmoi.ctp
 *
 * Affichage de 5 suggestions de suivi , visible uniquement sur mon profil
 *
 */

-->
<div id="list_sugg">
	
		<div id="suggestion">

				<div class="text-center">
					<h4><span class="glyphicon glyphicon-globe"></span>&nbsp;Vous pouvez suivre</h4>
					<hr>
				</div>

 				<ul class="liste_suggestion"> <!-- liste de résultat -->

					<?php foreach ($suggestionmoi as $suggestionmoi): ?>

					<li class="sugg" data-username="<?= $suggestionmoi->username ;?>">

<!-- avatar -->

<?= $this->Html->image('/img/avatar/'.$suggestionmoi->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle')); ?>

	<p>

<?= $this->Html->link(h($suggestionmoi->username),'/'.h($suggestionmoi->username).'');?> <!-- lien vers profil -->

	<br />

<!-- bouton suivre -->

<a href="#" data-username="<?= $suggestionmoi->username ;?>" data-action="add" title="Suivre <?= $suggestionmoi->username ;?>" id="aboact" class="btn btn-default" onclick="return false;">Suivre</a>

	</p>

					</li>

					<?php endforeach; ?>

				</ul>

				<div class="text-center">

					<!-- lien d'actualisation -->

					<a href="#" id="resetsugg" onclick="return false;">Actualiser</a> 

				</div>
		</div>
</div>

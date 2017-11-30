<!-- mise à jour du profil -->
<div class="text-center">
<h4> <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Définition de mon profil</h4>
</div>
<?php 
if($setup_profil == 0)
{
	echo '<div class="alert alert-success">

	<ul>
	<li>Tous le monde peut voir vos publications.</li>
	<li>Les demandes d\'abonnement sont acceptés automatiquement.</li>
	</ul>
	</div>';
	?>

<?= $this->Form->create('', array('url'=>array('controller'=>'settings', 'action'=>'setup_profil_prive' )));?>
<br />

<div class="text-center">

<?= $this->Form->button('Passer mon profil à privé', array('class'=>'btn btn-danger')) ?>
</div>
<?= $this->Form->end();
}
else
{
	echo '<div class="alert alert-danger">

	<ul>
	<li>Seules vos abonnés voient vos publications.</li>
	<li>Vous pouvez choisir d\'accepter ou non un abonnement.</li>
	</ul>

	</div>';
	?>
<?= $this->Form->create('', array('url'=>array('controller'=>'settings', 'action'=>'setup_profil_public' )));?>

<div class="text-center">

<?= $this->Form->button('Passer mon profil à public', array('class'=>'btn btn-success')) ?>
</div>
<?= $this->Form->end();

 }

 ?>
<!-- fin mise à jour type profil -->
<!-- notifications -->
<hr>
<div class="text-center">
<h4> <span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications</h4>
</div>
<!-- notification de message -->
<label for"notifmessage">Notification de message</label>
<select name="notif_message" id="notifmess">
	<option value="oui" <?php if($notif_message == 'oui') echo 'selected' ; ?> >oui</option>
	<option value="non"<?php if($notif_message == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_message" class="spannotif"></span>
<!-- fin notification de message -->
<br />
<!-- notification de citation -->
<label for"notifcite">Notification de citation</label>
<select name="notif_cite" id="notifcite">
	<option value="oui" <?php if($notif_cite == 'oui') echo 'selected' ; ?> >oui</option>
	<option value="non"<?php if($notif_cite == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_cite" class="spannotif"></span>
<!-- fin notification de citation -->
<br />
<!-- notification de partage -->
<label for"notifcite">Notification de partage</label>
<select name="notif_partage" id="notifpartage">
	<option value="oui" <?php if($notif_partage == 'oui') echo 'selected' ; ?> >oui</option>
	<option value="non"<?php if($notif_partage == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_partage" class="spannotif"></span>
<!-- notification de partage -->
<br />
<!-- notification d'abonnement -->
<label for"notifabo">Notification d'abonnement</label>
<select name="notif_abo" id="notifabo">
	<option value="oui" <?php if($notif_abo == 'oui') echo 'selected' ; ?> >oui</option>
	<option value="non"<?php if($notif_abo == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_abo" class="spannotif"></span>
<!-- fin notification d'abonnement -->
<br />
<!-- notification commentaire -->
<label for"notifcomm">Notification de commentaires</label>
<select name="notif_comm" id="notifcomm">
	<option value="oui" <?php if($notif_comm == 'oui') echo 'selected' ; ?> >oui</option>
	<option value="non"<?php if($notif_comm == 'non') echo 'selected' ; ?>>non</option>
</select>
<span id="result_comm" class="spannotif"></span>
    <!-- fin notification de commentaire -->
<br />
<!-- fin notifications -->
<!-- modifier ma descritpion -->
<hr>
<div class="text-center">
<h4> <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Changer ma description</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editdescription' )));?>

<?= $this->Form->Textarea('description', ['label'=>'','placeholder' => 'Parler de moi...'],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de ma description', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
<!-- fin modifier ma descritpion -->
<!-- modifier mon lieu -->
<hr>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editlieu' )));?>

<?= $this->Form->input('lieu', ['prepend' => ' <span class="glyphicon glyphicon-map-marker"></span> ','label'=>'','placeholder' => 'Ex: Paris, New York, Montréal,...'],array('class'=>'form-controle')) ?>
<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon lieu', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
<!-- fin modifier mon lieu -->
<!-- modifier mon site web -->
<hr>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editwebsite' )));?>

<?= $this->Form->input('website', ['type' => 'url','prepend' => ' <span class="glyphicon glyphicon-globe"></span> ','label'=>'','placeholder' => 'http://www.monsite.com'],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon site web', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
<!-- fin modifier mon site web -->
<!-- modifier mon avatar -->
<hr>
<div class="text-center">
<h4><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Changer ma photo de profil</h4>
</div>
<br />
<?= $this->Form->create('',array('url'=>array('controller'=>'users', 'action'=>'avatar' ),'type' => 'file')) ?>
<?= $this->Form->input('Nouvel avatar (jpg/jpeg/png) 1mo maximum ', array('type' => 'file')); ?>
<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon avatar', array('class'=>'btn')) ?>
</div>
<!-- supprimer mon compte -->
<hr>
<div class="text-center">
<?= $this->Form->button(__('<i class="glyphicon glyphicon-trash"></i>&nbsp;Supprimer mon compte'), ['controller'=>'users', 'action' => 'delete', 'class' => 'btn btn-danger', $authUser], ['confirm' => __('Are you sure you want to delete # {0}?', $authUser)]) ?>
</div>
<br />
<!-- fin supprimer mon compte -->



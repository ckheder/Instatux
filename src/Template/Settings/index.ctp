<!-- mise à jour du profil -->
<div class="text-center">
<h4> <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Définition de mon profil</h4>
</div>
<?php 
if($setup_profil == 0)
{
	echo '<div class="alert alert-success">Votre profil est actuellement public</div>';
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
	echo '<div class="alert alert-danger">Votre profil est actuellement privé</div>';
	?>
<?= $this->Form->create('', array('url'=>array('controller'=>'settings', 'action'=>'setup_profil_public' )));?>
<br />

<div class="text-center">

<?= $this->Form->button('Passer mon profil à public', array('class'=>'btn btn-success')) ?>
</div>
<?= $this->Form->end();

 }

 ?>

<hr>
<div class="text-center">
<h4> <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Changer ma description</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editdescription' )));?>

<?= $this->Form->Textarea('description', ['label'=>''],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de ma description', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
<hr>
<div class="text-center">
<h4><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Changer mon lieu d'habitation</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editlieu' )));?>

<?= $this->Form->input('lieu', ['label'=>''],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon lieu', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
<hr>
<div class="text-center">
<h4><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Mon site web</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editwebsite' )));?>

<?= $this->Form->url('website', ['label'=>''],array('class'=>'form-controle', 'placeholder' => 'http://www.monsite.com')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon site web', array('class'=>'btn')) ?>
</div>
<?= $this->Form->end() ?>
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
<?= $this->Form->end() ?>

<hr>
<div class="text-center">
<?= $this->Form->button(__('<i class="glyphicon glyphicon-trash"></i>&nbsp;Supprimer mon compte'), ['controller'=>'users', 'action' => 'delete', 'class' => 'btn btn-danger', $authUser], ['confirm' => __('Are you sure you want to delete # {0}?', $authUser)]) ?>
</div>
<br />


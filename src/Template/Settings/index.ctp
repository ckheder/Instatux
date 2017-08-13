
<div class="text-center">
<h4> <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Changer ma description</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editdescription' )));?>

<?= $this->Form->Textarea('description', ['label'=>''],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de ma description', array('class'=>'btn btn-info')) ?>
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
<?= $this->Form->button('Mise à jour de mon lieu', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>
<hr>
<div class="text-center">
<h4><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Mon site web</h4>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'editwebsite' )));?>

<?= $this->Form->url('website', ['label'=>''],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour de mon site web', array('class'=>'btn btn-info')) ?>
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
<?= $this->Form->button('Mise à jour de mon avatar', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>

<hr>
<div class="text-center">
<?= $this->Form->button(__('<i class="glyphicon glyphicon-trash"></i>&nbsp;Supprimer mon compte'), ['controller'=>'users', 'action' => 'delete', 'class' => 'btn btn-danger', $authUser], ['confirm' => __('Are you sure you want to delete # {0}?', $authUser)]) ?>
</div>
<br />


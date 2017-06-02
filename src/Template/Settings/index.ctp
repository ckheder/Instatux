<div class="col-sm-6">
<div class="text-center">
<h2>Changer ma description</h2>
</div>
<?= $this->Form->create('', array('url'=>array('controller'=>'users', 'action'=>'edit' )));?>

<?= $this->Form->Textarea('description', ['label'=>''],array('class'=>'form-controle')) ?>


<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>
<div class="text-center">
<h3>Changer ma photo de profil</h3>
</div>
<?= $this->Form->create('',array('class'=>'navbar-form navbar-left','url'=>array('controller'=>'users', 'action'=>'avatar' ),'type' => 'file')) ?>
<?= $this->Form->input('Nouvel avatar (jpg/jpeg/png) 1mo maximum ', array('type' => 'file')); ?>
<br />
<br />
<div class="text-center">
<?= $this->Form->button('Mise à jour', array('class'=>'btn btn-info')) ?>
</div>
<?= $this->Form->end() ?>
<br />
<br />
<?= $this->Form->button(__('Supprimer mon compte'), ['controller'=>'users', 'action' => 'delete', 'class' => 'btn btn-danger', $authUser], ['confirm' => __('Are you sure you want to delete # {0}?', $authUser)]) ?>
</div>

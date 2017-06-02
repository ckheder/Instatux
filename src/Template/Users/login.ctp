<!-- src/Template/Users/login.ctp -->

<h1>Connexion</h1>
<?= $this->Form->create() ?>
<label  for="username">Nom d'utilisateur</label>
<?= $this->Form->input('username', ['label'=>'']) ?>
<label  for="password">Mot de passe</label>
<?= $this->Form->input('password', ['label'=>'']) ?>
<?= $this->Form->button('Connexion', array('class'=>'btn btn-info')) ?>
<?= $this->Form->end() ?>
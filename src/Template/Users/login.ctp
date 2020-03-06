<!-- src/Template/Users/login.ctp -->
    <div class="text-center">
      <div class="alert alert-danger">
        Vous devez vous connecter pour voir cette page.
      </div>
<h1>Connexion</h1>
<br />
</div>
<?= $this->Form->create('Users', array(
  'url'=>array(
                'controller'=>'users', 'action'=>'login'),
                                      'id'=>'form_log',
                                      'class'=>'form_log'));?>
 <fieldset>
        <div class="input-group">
        <div class="input-group-addon">
  <span class="glyphicon glyphicon-user"></span>
   </div>
        <?php
            echo $this->Form->text('username', ['placeholder'=>'Nom d\'utilisateur']);
            ?>
            </div>
            <br />
            <br />
             <div class="input-group">
                    <div class="input-group-addon">
  <span class="glyphicon glyphicon-lock"></span>
   </div>
            <?php
            echo $this->Form->password('password', ['placeholder'=>'Mot de passe']);?>


            </div>

            <?= $this->Form->hidden('urlorigin', ['value' => $this->request->getQuery('redirect')]) // auteur du tweet?>

    </fieldset>
    <br />
    <br />
    <div class="text-center">
    <?= $this->Form->button('Connexion', array('class'=>'btn btn-info')) ?>
    <?= $this->Form->end() ?>
    <br />
    <br />
</div>

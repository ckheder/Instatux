<!-- src/Template/Users/login.ctp -->
    <div class="text-center">
<h1>Connexion</h1>
<br />
</div>
<?= $this->Form->create() ?>     
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
            
    </fieldset>
    <br />
    <br />
    <div class="text-center">
    <?= $this->Form->button('Connexion', array('class'=>'btn btn-info')) ?>
    <?= $this->Form->end() ?>
    <br />
    <br />
</div>
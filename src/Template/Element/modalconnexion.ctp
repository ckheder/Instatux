<?php
echo $this->Modal->create(['id' => 'ModalConnexion']) ;
                echo $this->Modal->header('Connexion', ['close'=>false]) ;
                echo $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'login'))) ?>
      
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
             <div class="input-group">
                    <div class="input-group-addon">
  <span class="glyphicon glyphicon-lock"></span> 
   </div>
            <?php
            echo $this->Form->password('password', ['placeholder'=>'Mot de passe']);
            ?>
            </div>
            
    </fieldset>
    <br />
    <div class="text-center">
    <?= $this->Form->button('Connexion', array('class'=>'btn btn-success')) ?>
    <?= $this->Form->end() ?>
    <br />
    <br />
     <a href="#">Mot de passe oublié ? </a>
         <br />
             <br />
</div>

<?php
                echo $this->Modal->footer([
                    $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                    ]);
                    
                echo $this->Modal->end() ;


?>

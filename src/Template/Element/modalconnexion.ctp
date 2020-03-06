<!--

 * modalconnexion.ctp
 *
 * Fenêtre modale de connexion
 *
 */

-->

<?php
        echo $this->Modal->create(['id' => 'ModalConnexion']) ; // création modal
        
        echo $this->Modal->header('Connexion', ['close'=>false]) ; // titre

                //formulaire de connexion
        
        echo $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'login'))) ?>
      
            <fieldset>
              <div class="input-group">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-user"></span> 
                </div>
        <?php

            echo $this->Form->text('username', ['placeholder'=>'Nom d\'utilisateur']); // input nom d'utilisateur

        ?>
            </div>

            <br />

             <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-lock"></span> 
            </div>

            <?php

            echo $this->Form->password('password', ['placeholder'=>'Mot de passe']); // input mot de passe

            ?>
              </div>
            
            </fieldset>

    <br />

    <div class="text-center">

    <?= $this->Form->button('Connexion', array('class'=>'btn btn-success')) ?> <!-- bouton de connexion -->

    <?= $this->Form->end() ?>

    <!-- fin formulaire de connexion -->

    <br />

    <br />

     <a href="#">Mot de passe oublié ? </a> <!-- mot de passe oublié -->

    <br />

    <br />

    </div>

<?php // footer -> bouton de fermeture modale
      echo $this->Modal->footer([
                                  $this->Form->button('Fermer', ['data-dismiss' => 'modal', 'class' =>'btn btn-danger'])
                                ]);
                    
      echo $this->Modal->end(); // fermeture modale
?>

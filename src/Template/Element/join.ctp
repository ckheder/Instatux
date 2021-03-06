<!--

 * join.ctp
 *
 * Formulaire d'inscription sur la page d'accueil
 *
 */

-->

    <!-- création formulaire -->

    <?= $this->Form->create('Users', array(
      'url'=>array(
                    'controller'=>'users', 'action'=>'add'), 
                                          'id'=>'form_insc', 
                                          'class'=>'form_insc'));?>

    
              <div class="text-center">
                <h4>
                  <span class="glyphicon glyphicon-check"></span>&nbsp;Inscription
                </h4>
              </div>

        <br />
        <div class="input-group">
          <div class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span> 
          </div>

        <?php // input username

            echo $this->Form->text('username', ['id'=> 'insc_username','placeholder'=>'Nom d\'utilisateur','maxlength'=>'20','required' =>'required', 'data-toggle' => 'tooltip', 'data-placement' => 'top','title' => 'Entre 5 et 20 caractères, les caractères spéciaux ne sont pas autorisés.']);
            
            ?>

        </div>
        <!-- informations -->

             <span class="help-block">Entre 5 et 20 caractères, les caractères spéciaux ne sont pas autorisés.</span>
             <div class="input-group">

        <!-- mot de passe -->

            <div class="input-group-addon">
              <span class="glyphicon glyphicon-lock"></span> 
            </div>

            <?php
            echo $this->Form->password('password', ['placeholder'=>'Mot de passe','required' =>'required']);
            ?>
            </div>
            <br />

            <!-- adresse mail -->

             <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-envelope"></span> 
              </div>
            <input type="email" name="email" class="form-control" placeholder="Adresse mail" required="required" id="email">
            </div>
            <br />
      <p>
        En cliquant sur Inscription, vous acceptez nos <a href="#">Conditions générales</a>.
      </p>
    <br />
    <div class="text-center"> <!-- bouton inscription -->

    <?= $this->Form->button('Inscription', array('class'=>'btn btn-info')) ?>

    <?= $this->Form->end() ?>

    </div>



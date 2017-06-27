<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

?>
<div class="container">
  <div class="row">
  <h1 class="text-muted text-center">Bienvenue sur Instatux </h1>
  <div class="col-sm-6">

<?= $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'login'))) ?>
      
 <fieldset>
        <legend><?= __('Connexion') ?></legend>
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
            <br />
    </fieldset>
    <br />
    <div class="text-center">
    <?= $this->Form->button('Connexion', array('class'=>'btn btn-success')) ?>
    <?= $this->Form->end() ?>
</div>
  </div>
  <div class="col-sm-6">

    <?= $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'add')));?>

    
    <fieldset>
        <legend><?= __('Inscription') ?></legend>
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
            <br />
             <div class="input-group">
              <div class="input-group-addon">
  <span class="glyphicon glyphicon-envelope"></span> 
   </div>
            <?php
            echo $this->Form->input('email', ['label'=> '','placeholder'=>'Adresse mail']);
            ?>
            </div>
            <br />
        
    </fieldset>
    <br />
    <div class="text-center">
    <?= $this->Form->button('Inscription', array('class'=>'btn btn-info')) ?>
    <?= $this->Form->end() ?>
</div>
  </div>

</div>
</div>
        
          
            
        


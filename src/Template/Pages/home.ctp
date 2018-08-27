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
   <div class="container" style="border:1px solid #cecece;">
        <?= $this->Flash->render() ?>
  <div class="row">
         <div class="col-sm-3">
    <?= $this->Form->create('Users', array('url'=>array('controller'=>'users', 'action'=>'add'), 'id'=>'form_insc'));?>

    
        <div class="text-center"><h4><span class="glyphicon glyphicon-check"></span>&nbsp;Inscription</h4></div>
        <br />
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
    <p>
      En cliquant sur Inscription, vous acceptez nos <a href="#">Conditions générales</a>.
    </p>
    <br />
    <div class="text-center">
    <?= $this->Form->button('Inscription', array('class'=>'btn btn-info')) ?>
    <?= $this->Form->end() ?>
</div>
<br />
</div>
<div class="col-sm-5">

<p class="home">Découvrez ce qui se passe dans le monde en temps réel.
  <br />
Rejoignez Instatux aujourd'hui.
<hr>
<ul class="list_accueil">
  <li><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Crée votre profil.</li>
  <li><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Connectez-vous à vos amis ou aux personnes partageant les mêmes centres d'intérêt.</li>
  <li><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Discussion en temps réel.</li>
  <li><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Réagissez aux sujets qui vous intéressent.</li>
</ul>
</p>
      </div>
<div class="col-sm-4">
<br />
        <?= $this->cell('Hashtag');?>
      </div>

  </div>
    <footer class="footer">
  <div class="container">
   <a href="#">Conditions d'utilisation - </a><a  href="https://github.com/ckheder/Instatux">Contribuer - </a><a href="#">Contact</a>
  </div>
    </footer>
</div>
</div>

            
        


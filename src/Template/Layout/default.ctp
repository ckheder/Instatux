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

$cakeDescription = ' Instatux. Ce qu\'il se passe.';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>
        <?= $cakeDescription ?>
        
    </title>
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->css('/js/emoji/jquery.emojiarea.css') ?>
        <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->fetch('meta') ?>

</head>

<body>


   <div class="container">

        
  <div class="row-no-gutters">
    <?= $this->element('accueilmenu')?>
    <?= $this->Flash->render() ?>
         <div class="col-md-6">
   
        <?= $this->fetch('content') ?>

</div>
<div class="col-md-6">
 <?= $this->element('join')?>
 <br />
    </div>

    

    <footer class="footer container">
  <div class="container-fluid">
   <a href="#">Conditions d'utilisation - </a><a  href="https://github.com/ckheder/Instatux">Contribuer - </a><a href="#">Contact</a>
  </div>
</footer>
<?= $this->element('modalconnexion') ?>
    </div>
  </div>
</body>
</html>

<!--

 * general.ctp
 *
 * Layout général
 *
 */

-->

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
  
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="titlepage"></title> 
<!--favicon -->   
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
<!--css -->
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->css('/js/emoji/jquery.emojiarea.css') ?>
<!-- Javascript -->
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/fr.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
<!-- meta -->
    <?= $this->fetch('meta') ?>
</head>
<body>

     <div class="container">

      <p id="etatnotif"></p> <!-- notifications -->
         
        <?= $this->Flash->render() ?>

<div class="row-no-gutters row-eq-height">

  <?= $this->element('navbar') ; ?>

<div class="col-sm-8">

        <?= $this->fetch('content') ?>
</div>

<div class="col-sm-4">

  <?php
  
      echo $this->element('modaltweet'); // modal nouveau tweet
      echo $this->element('helpmodal'); // modal information tweet
      echo $this->element('conversation') ; // options sur les conversations
      echo $this->element('modaladdconv'); // ajouter à une conversation

  ?>

</div>

          <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat -->
          <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->

          <?= $this->Html->script('messagerie.js') ?> <!-- message depuis les fenetres modals , la page d'accueil de la messagerie et l'auto completion des abonnements -->       
</div>
</div>
</body>
</html>

<!--

 * settings.ctp
 *
 * Layout de la page de configuration
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
    <title class="titlepage"><?= $title ?></title>
<!-- favicon -->
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
<!-- CSS -->
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
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
<!-- meta -->
    <?= $this->fetch('meta') ?>

</head>

<body>

   <div class="container">

    <p id="etatnotif"></p>

      <div class="row-no-gutters">

        <?= $this->element('navbar') ; ?>

<div class="col-md-3 col-sm-5">

  <!-- lien de navigation sur la page des settings -->

    <ul id="myTab" class="nav nav-pills nav-stacked">

      <li class="active"><a href="#infos" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Mon profil</a></li>

      <li><a href="#notifs" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications</a></li>

      <li><a href="#blocks" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Utilisateurs bloqués</a></li>

    </ul>

</div>

<div class="col-md-6 col-sm-7" style="padding: 10px;background-color: white;">

        <?= $this->fetch('content') ?>
</div>

<?= $this->element('modaltweet'); ?>

<?= $this->element('helpmodal'); ?> <!-- modal information tweet -->

<footer>
    </footer>
      <?= $this->Html->script('settings.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
      <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->

      <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat -->
    </div>
  </div>
</body>
</html>

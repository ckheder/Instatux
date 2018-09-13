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
    <title>
        <?= $title ?>

    </title>
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
     <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->fetch('meta') ?>

</head>
<body>
  <?=  $this->element('onlinemenu') ;?>
   <div class="container" style="border:1px solid #cecece;">
    <p id="etatnotif"></p>
  <div class="row">
<div class="col-sm-3">
<ul id="myTab" class="nav nav-tabs nav-stacked">
      <li class="active"><a href="#infos" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Mes informations</a></li>
      <li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Paramètre profil</a></li>
      <li><a href="#notifs" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Notifications</a></li>
      <li><a href="#blocks" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Utilisateurs bloqués</a></li>
      <li><a href="#deleteaccount" data-toggle="tab"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Supprimer mon compte</a></li>


 </ul>
</div>
<div class="col-sm-5">

        <?= $this->fetch('content') ?>
</div>
<div class="col-sm-4">
<br />
        <?= $this->cell('Hashtag');?>

 <?= $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ;

?>
</div>
<?= $this->element('modaltweet') ?>
<footer>
    </footer>
      <?= $this->Html->script('settings.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
</body>
</html>

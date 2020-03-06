<!--

 * onlinenews.ctp
 *
 * Layout de l'accueil pour les connectés
 *
 */

-->

<?php
use Cake\Routing\Router;
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
<!-- Favicon -->
    <?= $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'))."\n"; ?>
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
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/fr.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js') ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->Html->script('/js/modal.js') ?>
<!-- meta -->
    <?= $this->fetch('meta') ?>

</head>
<body>

   <div class="container">

        <p id="etatnotif"></p>

 <div class="row-no-gutters">

    <?= $this->element('navbar') ; ?>
    <?= $this->element('modalview'); ?>
    <?= $this->element('viewlike'); ?>

    <!-- lien de tri pour l'affichage des news online -->

     <div class="col-md-3 col-sm-4" style="padding-left: 14px;margin-top : 15px;">

         <ul id="myTab" class="nav nav-tabs nav-stacked">

            <li class="list-group-item list-group-item-info">Filtrer l'actualités.</li>

    <!-- lien de résultat les plus récents -->

            <li><?= $this->Paginator->sort('created','<span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;Les plus récents',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>

    <!-- les plus partagés -->

            <li><?= $this->Paginator->sort('nb_partage','<span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;Les plus partagés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>

    <!-- les plus likés -->

            <li><?= $this->Paginator->sort('nb_like','<span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;Les plus likés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>

    <!-- les plus commentés -->

            <li><?= $this->Paginator->sort('nb_commentaire','<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Les plus commentés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>
        </ul>

        <br />

     </div>

 <div class="col-md-6 col-sm-8" style="padding-left: 10px;margin-top : 15px;">

        <?= $this->fetch('content') ?>
</div>

<div class="col-md-3" style="padding-left: 10px; margin-top : 15px; margin-bottom : 15px;">

  <?= $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ; ?> <!-- Cell de suggestion  de personne à suivre -->

</div>

<?=  $this->element('modaltweet');?>
<?=  $this->element('helpmodal');?>

<footer>
    </footer>
     <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->
     
     <?= $this->Html->script('actionabo.js') ?> <!-- script d'ajout/suppression d'un abo : utlisé sur profil, moteur de recherche et les suggestions-->
     <?= $this->Html->script('countlike.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
     <?= $this->Html->script('sharetweet.js') ?> <!-- script de partage d'un tweet : utlisé sur l'accueil, profil, moteur de recherche -->
     <?= $this->Html->script('screen.js') ?>
     </div>
     </div>
</body>
</html>

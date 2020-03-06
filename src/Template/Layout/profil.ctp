<!--

 * profil.ctp
 *
 * Layout profil
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
<!-- Favicon -->
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
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/fr.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->Html->script('/js/modal.js') ?>
<!-- Meta -->
    <?= $this->fetch('meta') ?>
</head>
<body>
<?php

$current_user = $this->request->getParam('username'); ?> <!-- nom du profil -->

     <div class="container">

      <p id="etatnotif"></p> <!-- notifications -->

        <?= $this->Flash->render() ?>

<div class="row-no-gutters row-eq-height">

  <?= $this->element('navbar') ; ?>

<div class="col-md-3 col-sm-5">

   <?php
        echo $this->element('modalview'); // modal vue de tweet
        echo $this->element('viewlike'); // modal vue des like aimant un tweet
        echo $this->cell('Info'); // info sur le profil que je visite
        echo $this->cell('Media'); // affichage des 8 derniers médias
        

   if (isset($authName)) // je suis authentifié
  {

      echo $this->cell('Abonnement', ['authname' => $authName]) ; // affichage de mes abonnements
      
  }

    else // je ne suis pas authentifié, je visite un profil
  {
     
      echo $this->cell('Abonnement', ['authname' => $current_user]) ; // affichage des abonnements

      echo $this->element('encartinscriptionoffline'); // informations offline

  }
  
?>

</div>

<div class="col-md-6 col-sm-7" style="margin-top : 15px;">

        <?= $this->fetch('content') ?>
</div>

<div class="col-md-3" style="margin-top : 15px;padding-left: 14px;">

  <?php

    if (isset($authName)) // je suis authentifié
  {

      echo $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ; // suggestion pour moi
      echo $this->element('modaltweet'); // modal nouveau tweet
      echo $this->element('helpmodal'); // modal information tweet
  }
    else
  {
      echo $this->element('modalconnexion');
  }


?>

</div>


<footer>
    </footer>
          <?= $this->Html->script('countlike.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
          <?= $this->Html->script('actionabo.js') ?> <!-- script d'ajout/suppression d'un abo : utlisé sur profil, moteur de recherche -->
          <?= $this->Html->script('sharetweet.js') ?> <!-- script de partage d'un tweet : utlisé sur l'accueil, profil, moteur de recherche -->
          <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat -->
          <?= $this->Html->script('messagerie.js') ?> <!-- message depuis les fenetres modals , la page d'accueil de la messagerie et l'auto completion des abonnements -->
          <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->

          <?= $this->Html->script('screen.js') ?> <!-- mise en forme rersponsive -->

</div>
</div>
</body>
</html>

<!--

 * follow.ctp
 *
 * Layout utilisé sur les pages d'abonnements : abonnement, abonné et demande
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
    <title class="titlepage">
        <?= $title ?>

    </title>
  <!--favicon -->
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
  <!-- css -->
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->css('/js/emoji/jquery.emojiarea.css') ?>
  <!-- javascript -->
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
  <!--meta -->
    <?= $this->fetch('meta') ?>

</head>

<body>

   <div class="container">

    <p id="etatnotif"></p> <!-- notifications -->

  <div class="row-no-gutters">

    <?= $this->element('navbar') ; ?>

      <div class="col-md-2 col-sm-4">

  <?php

    if($this->request->getParam('username')) // si un nom est renseigné en URL
  {
    $username = $this->request->getParam('username'); // nom du profil en cours
  } 
    else // sinon on utilise le nom de l'utilisateur courant
  {
    $username = $authName;
  }

    $current_url = Router::url(null, false); // url en cours

    $url_demande = Router::url(['_name' => 'demande']);// url demande d'abo

  // titre de page dynamique suivant le profil que je visite : si c'est moi sur mes abonnements/abonnes

    $titre_page_abonnement = "Mes abonnement(s)";

    $titre_page_abonne = "Mes abonné(s)";

   // titre de page dynamique suivant le profil que je visite : si c'est pas moi

    if($username != $authName)
  {
    $titre_page_abonnement = 'Abonnement(s) de '.$username.'' ;

    $titre_page_abonne = 'Abonné(s) de '.$username.'' ;
  }

  ?>

<!-- lien vers abonnement, abonné et demande uniquement si je suis sur mon profil -->

  <ul id="myTab" class="nav nav-tabs nav-stacked">

        <li>
          <a href="/instatux/abonnement/<?= $username ;?>"><span class="glyphicon glyphicon-user green"></span>&nbsp;&nbsp;<?= $titre_page_abonnement ;?></a>
        </li>

        <li>
          <a href="/instatux/abonne/<?= $username ;?>"><span class="glyphicon glyphicon-user red"></span>&nbsp;&nbsp;<?= $titre_page_abonne ;?></a>
        </li>

    <?php

     if($current_url == $url_demande OR $username == $authName) // je suis authentifié
   // moi seul vois la page des demandes
    {
      ?>
    <li>
        <a href="/instatux/demande"><span class="glyphicon glyphicon-plus green"></span>&nbsp;&nbsp;Mes demande(s)</a>
    </li>
  </ul>
  <?php
    }
    else
  {
    echo '</ul>';
  }
?>
</div>

  <div class="col-md-10 col-sm-8" style="padding-left: 10px;border-left:1px solid #cecece;">

    <?= $this->fetch('content') ?>

  </div>
        <?= $this->element('modaltweet'); ?>
        <?= $this->element('helpmodal'); ?> <!-- modal information tweet -->
<footer>
    </footer>

<!-- script javascript en fin de chargement de page -->

        <?= $this->Html->script('/js/settingsabo.js') ?>
        <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->
        <?= $this->Html->script('actionabo.js') ?> <!-- script d'ajout/suppression d'un abo : utlisé sur profil, moteur de recherche,gestion abonnement -->
        <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat,gestion abonnement -->
</div>
</div>
</body>
</html>

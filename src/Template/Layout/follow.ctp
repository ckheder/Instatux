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
    <title>
        <?= $title ?>

    </title>
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
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
  <?php
  $username = $this->request->getParam('username'); // nom du profil en cours
  $current_url = Router::url(null, false); // url en cours
  $url_demande = Router::url(['_name' => 'demande']);// url demande d'abo
     if($current_url == $url_demande OR $username == $authName) // je suis authentifié
   // si je suis le profil d'une autre personne ou le mien ou sur la page des demande

    {
      ?>
<ul id="myTab" class="nav nav-tabs nav-stacked">
    <li><a href="/instatux/abonnement/<?= $authName ;?>"><span class="glyphicon glyphicon-user green"></span>&nbsp;&nbsp;Mes abonnement(s)</a></li>
    <li><a href="/instatux/abonne/<?= $authName ;?>"><span class="glyphicon glyphicon-user red"></span>&nbsp;&nbsp;Mes abonné(s)</a></li>
    <li><a href="/instatux/demande"><span class="glyphicon glyphicon-plus green"></span>&nbsp;&nbsp;Mes demande(s)</a></li>
  </ul>
  <?php
}
else
{
?>
<ul id="myTab" class="nav nav-tabs nav-stacked">
    <li><a href="/instatux/abonnement/<?= $username ;?>"><span class="glyphicon glyphicon-user green"></span>&nbsp;&nbsp;Liste des abonnements de <?= $username ;?></a></li>
    <li><a href="/instatux/abonne/<?= $username ;?>"><span class="glyphicon glyphicon-user red"></span>&nbsp;&nbsp;Liste des abonnés de <?= $username ?></a></li>
  </ul>
<?php
}
?>
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
 <?= $this->Html->script('/js/settingsabo.js') ?>    

</body>
</html>
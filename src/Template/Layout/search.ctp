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
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->css('/js/emoji/jquery.emojiarea.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->fetch('meta') ?>

</head>
<body>
   <?php if (isset($authName)) // test de l'authentification
  {
  echo  $this->element('onlinemenu') ;
}
else
{
  echo  $this->element('offlinemenu') ;
}
?>
   <div class="container" style="border:1px solid #cecece;">
    <p id="etatnotif"></p>
  <div class="row">
<div class="col-sm-3"> 
  <?php
// texte à afficher sur le lien de la liste
if ($this->request->getQuery('direction') == "desc")
{
  $texte_link = '<span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;Les plus anciens';
}
else
{
  $texte_link = '<span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;Les plus récents';
}


  ?>
 <ul id="myTab" class="nav nav-tabs nav-stacked">
  <li class="list-group-item list-group-item-info">Filtrer les résultats de recherche pour les tweets.</li>
  <!-- lien de résultat les plus récents -->
  <li><?= $this->Paginator->sort('created',$texte_link,['escape' => false,'direction' => 'desc', 'lock' => false]);?></li>
        <!-- lien de résultat les plus anciens -->
  
      <!-- les plus partagés -->
        <li><?= $this->Paginator->sort('nb_partage','<span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;Les plus partagés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>
        <!-- les plus likés -->
      <li><?= $this->Paginator->sort('nb_like','<span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;Les plus likés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>
      <!-- les plus commentés -->
      <li><?= $this->Paginator->sort('nb_commentaire','<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Les plus commentés',['escape' => false,'direction' => 'desc', 'lock' => true]);?></li>
 </ul>
</div>
<div class="col-sm-5">

 <?= $this->fetch('content') ?>
</div>
<div class="col-sm-4">
<br />
        <?= $this->cell('Hashtag');?>

        <?php if (isset($authName)) // test de l'authentification
  {
echo $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ;
echo $this->element('modaltweet'); 
}
?>
</div>

<?= $this->element('modalconnexion'); ?>
<footer>
    </footer>
 
<?= $this->Html->script('instatuxeditor.js'); ?>
<?= $this->Html->script('countlike.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->  
</body>
</html>
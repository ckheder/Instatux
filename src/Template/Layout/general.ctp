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
    <?= $this->Html->css('/js/emoji/jquery.emojiarea.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('ckeditor/ckeditor.js') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/fr.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
     <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->fetch('meta') ?>

</head>
<body>
   <?php if (isset($authName))
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
<?= $this->Flash->render() ?>
  <div class="row">
<div class="col-sm-3">
<br />
   <?php if (isset($authName)) // je suis authentifié
  {

    if($this->request->getParam('username')) // si je suis le profil d'une autre personne ou le mien

    {
    
     echo $this->cell('Info'); // info sur le profil que je visite
     echo $this->cell('Abonnement', ['authname' => $authName]) ; // test de l'abonnement, blocage vis a vis du profil que je visite
    }

    else // info sur moi pour les autres pages que le profil
    {
    echo  $this->cell('Info::moi', ['authname' => $authUser]); 
    echo  $this->cell('Abonnement::moi', ['authname' => $authName]) ;
    }  
  }
else // je ne suis pas authentifié
{
  echo $this->element('encartinscriptionoffline');
}
?>

</div>
<div class="col-sm-5">

        <?= $this->fetch('content') ?>
</div>
<div class="col-sm-4">
<br />
        <?= $this->cell('Hashtag');?>
        <?php if (isset($authName))
{
 echo $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ;
}
?>
</div>
<?= $this->element('modaltweet') ?>
<?= $this->element('modalconnexion') ?>
<footer>
    </footer>
          <?= $this->Html->script('countlike.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
          <?= $this->Html->script('actionabo.js') ?> <!-- script d'ajout/suppression d'un abo : utlisé sur profil, moteur de recherche -->
          <?= $this->Html->script('sharetweet.js') ?> <!-- script de partage d'un twee : utlisé sur l'accueil, profil, moteur de recherche -->
          <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat -->
</body>
</html>

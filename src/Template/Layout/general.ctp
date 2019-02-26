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
  
  // variable URL
           $current_url = Router::url(null, false); // url en cours
  $url_notification = Router::url(['_name' => 'notifications']);// url notification
  $url_profil = Router::url(['_name' => 'profil', 'username' => $this->request->getParam('username')]);// url profil
  $url_conv = Router::url(['_name' => 'conversation', 'id' => $this->request->getParam('id')]);// url view tweet
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="titlepage">

        <?= $title ?>
        
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
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/fr.js'); ?>
    <?= $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js') ?>
    <?= $this->Html->script('/js/emoji/jquery.emojiarea.js') ?>
    <?= $this->Html->script('/js/emoji/emojis.js') ?>
    <?= $this->Html->script('/js/nbnotif.js') ?>
    <?= $this->Html->script('/js/search.js') ?>
    <?= $this->Html->script('/js/modal.js') ?>
    <?= $this->fetch('meta') ?>
</head>
<body>
<?php
$current_user = $this->request->getParam('username'); ?>
     <div class="container">
      <p id="etatnotif"></p>
        <?php
  if($current_url == $url_profil) // je suis sur un profil quelconque
    {
      ?>
            <div class="cover"><!-- image de couverture -->
  <!--<img src="https://pbs.twimg.com/profile_banners/702671204/1538668415" class="img-responsive">-->
  <?= $this->Html->image('media/'.$current_user.'/cover_'.$current_user.'', array('alt' => 'couverture utilisateur', 'class'=>'img-responsive')); ?>
  </div>
  <?php
}
?>
          
          <?= $this->Flash->render() ?>
<div class="row-no-gutters row-eq-height">
       <?php if (isset($authName))
  {
  echo  $this->element('onlinemenu') ;
}
else
{
  echo  $this->element('offlinemenu') ;
}
?>
<div class="col-md-4">

   <?php
echo $this->element('modalview');
echo $this->element('viewlike');
   if (isset($authName)) // je suis authentifié
  {

      if($current_url == $url_profil) // je suis sur un profil quelconque
    {

    echo $this->cell('Info'); // info sur le profil que je visite
    echo $this->cell('Abonnement', ['authname' => $authName]) ; // test de l'abonnement, blocage vis a vis du profil que je visite
    echo $this->cell('Media');
    


    }

    elseif($current_url == $url_notification) // mes paramètres de notifications
    {
      echo $this->cell('Notifications::notifications', ['authname' => $authName]) ;
      echo $this->element('modalview');
    }  
        
       elseif($current_url == $url_conv) // conversation
    {
      echo $this->element('conversation');
    }
  }
else // je ne suis pas authentifié
{
        if($current_url == $url_profil) // je suis sur un profil quelconque
    {

    echo $this->cell('Info'); // info sur le profil que je visite
    echo $this->cell('Media');

    }
  echo $this->element('encartinscriptionoffline');
}
?>

</div>
<div class="col-md-5">

        <?= $this->fetch('content') ?>
</div>
<div class="col-md-3">
        <?php if (isset($authName))
{
  if($current_url == $url_profil) // je suis sur un profil quelconque
    {
     echo $this->cell('Abonnement::suggestionmoi', ['authname' => $authName]) ;
   }
 echo $this->element('modaltweet');
echo  $this->element('helpmodal');
}

?>


</div>
<?= $this->element('modalconnexion') ?>
<footer>
    </footer>
          <?= $this->Html->script('countlike.js') ?> <!-- script d'ajoput/suppression de like : utlisé sur l'accueil, profil, moteur de recherche -->
           <?= $this->Html->script('actionabo.js') ?> <!-- script d'ajout/suppression d'un abo : utlisé sur profil, moteur de recherche -->
          <?= $this->Html->script('sharetweet.js') ?> <!-- script de partage d'un tweet : utlisé sur l'accueil, profil, moteur de recherche -->
          <?= $this->Html->script('blocage.js') ?> <!-- script de blocage d'un utlisateur : utlisé sur l'accueil, profil, moteur de recherche,viewtweet,chat -->
          <?= $this->Html->script('messagerie.js') ?> <!-- message depuis les fenetres modals , la page d'accueil de la messagerie et l'auto completion des abonnements -->
          <?= $this->Html->script('instatuxeditor.js') ?> <!-- posté des trucs -->
          <?= $this->Html->script('screen.js') ?>


</div>
</div>
</body>
</html>

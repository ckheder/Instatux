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
    <?= $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'))."\n"; ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('ckeditor/ckeditor.js') ?>
    <?= $this->Html->script('textarea_limit.js') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('fix.js') ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->fetch('meta') ?>
 <script type="text/javascript">


    var auto_refresh = setInterval(
  function ()
  {
    $('#count_nb_notif').load('<?php echo Router::url(array("controller" => "Notifications", "action" => "nbNotif")); ?>').fadeIn("slow");
  }, 1000); // rafraichis toutes les 10000 millisecondes

</script>
</head>
<body>

    

 
   <div class="container" style="border:1px solid #cecece;">
<?= $this->element('menuco') ?>
<?= $this->Flash->render() ?>
  <div class="row">
<div class="col-sm-3">
   <br />
<!-- partie tweet, selin id url -->
<?= $this->cell('Info', ['authuser' => $authUser]);?>
<?= $this->cell('Abonnement', ['authname' => $authName]) ;  

?>

</div>
<div class="col-sm-5">
<br />
        <?= $this->fetch('content') ?>
        </div>
        <div class="col-sm-4">
        <br />
<?= $this->cell('Hashtag');?>
</div>
<?= $this->element('modaltweet') ?>
    <footer>
    </footer>
</body>
</html>

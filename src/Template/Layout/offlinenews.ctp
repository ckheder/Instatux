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
       Instatux. Ce qu'il se passe.
        
    </title>
    <?= $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'))."\n"; ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('jquery-ias.min.js') ?>
    <?= $this->fetch('meta') ?>

</head>
<body>
  <?= $this->element('offlinemenu') ; ?>
   <div class="container" style="border:1px solid #cecece;">

 <div class="row">
     <div class="col-sm-3">
        <?= $this->element('encartinscriptionoffline'); ?>
     </div>
 <div class="col-sm-5">
<br />
        <?= $this->fetch('content') ?>
</div>
<div class="col-sm-4">
<br />
        <?= $this->cell('Hashtag');?>
</div>


</div>
<?= $this->element('modalconnexion') ?>
<footer>
    </footer>        
</body>
</html>

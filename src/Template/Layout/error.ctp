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
        Instatux | Erreur
    </title>
    <?= $this->Html->meta('favicon.ico','img/favicon.ico', ['type' => 'icon']); ?>
    <?= $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Athiti'); ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->Html->css('/js/jqueryui/jquery-ui.css') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
        <?= $this->Html->script('/js/search.js') ?>
    <?= $this->fetch('meta') ?>
</head>
<body>
<?php 
  echo  $this->element('onlineerrormenu') ;
?>
    <div id="container" class="container" style="border:1px solid #cecece;">
    <div class="row-no-gutters">
<div class="col-sm-8">
            <?= $this->Flash->render() ?>

            <div class="text-center">

                <h1>Oops !</h1>

            <?= $this->fetch('content') ?>

            <br />           

            <a href="javascript:history.back()" title="Retour" class="btn btn-default" role="button">Retour</a>

            </div>
        </div>
        <div class="col-sm-4">
<br />


</div>

    </div>

        <footer>
    </footer>
</div>
</body>
</html>
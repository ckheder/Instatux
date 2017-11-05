<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Partage'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Abonnement'), ['controller' => 'Abonnement', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Abonnement'), ['controller' => 'Abonnement', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tweet'), ['controller' => 'Tweet', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweet', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partage form large-9 medium-8 columns content">
    <?= $this->Form->create($partage) ?>
    <fieldset>
        <legend><?= __('Add Partage') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('tweet_partage');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

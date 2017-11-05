<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Partage'), ['action' => 'edit', $partage->id_partage]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partage'), ['action' => 'delete', $partage->id_partage], ['confirm' => __('Are you sure you want to delete # {0}?', $partage->id_partage)]) ?> </li>
        <li><?= $this->Html->link(__('List Partage'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Abonnement'), ['controller' => 'Abonnement', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Abonnement'), ['controller' => 'Abonnement', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tweet'), ['controller' => 'Tweet', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweet', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="partage view large-9 medium-8 columns content">
    <h3><?= h($partage->id_partage) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Abonnement') ?></th>
            <td><?= $partage->has('abonnement') ? $this->Html->link($partage->abonnement->id, ['controller' => 'Abonnement', 'action' => 'view', $partage->abonnement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tweet') ?></th>
            <td><?= $partage->has('tweet') ? $this->Html->link($partage->tweet->id, ['controller' => 'Tweet', 'action' => 'view', $partage->tweet->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Partage') ?></th>
            <td><?= $this->Number->format($partage->id_partage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tweet Partage') ?></th>
            <td><?= $this->Number->format($partage->tweet_partage) ?></td>
        </tr>
    </table>
</div>

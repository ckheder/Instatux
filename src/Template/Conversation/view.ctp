<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Conversation'), ['action' => 'edit', $conversation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Conversation'), ['action' => 'delete', $conversation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Conversation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conversation'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="conversation view large-9 medium-8 columns content">
    <h3><?= h($conversation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($conversation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participant1') ?></th>
            <td><?= $this->Number->format($conversation->participant1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participant2') ?></th>
            <td><?= $this->Number->format($conversation->participant2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Statut') ?></th>
            <td><?= $conversation->statut ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

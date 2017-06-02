<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id_notif]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id_notif], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id_notif)]) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notifications view large-9 medium-8 columns content">
    <h3><?= h($notification->id_notif) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $notification->has('user') ? $this->Html->link($notification->user->id, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Notif') ?></th>
            <td><?= $this->Number->format($notification->id_notif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Notif') ?></th>
            <td><?= h($notification->date_notif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Statut') ?></th>
            <td><?= $notification->statut ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notification') ?></h4>
        <?= $this->Text->autoParagraph(h($notification->notification)); ?>
    </div>
</div>

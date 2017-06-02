<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Conversation'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="conversation index large-9 medium-8 columns content">
    <h3><?= __('Conversation') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('participant1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('participant2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('statut') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conversation as $conversation): ?>
            <tr>
                <td><?= $this->Number->format($conversation->id) ?></td>
                <td><?= $this->Number->format($conversation->participant1) ?></td>
                <td><?= $this->Number->format($conversation->participant2) ?></td>
                <td><?= h($conversation->statut) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $conversation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $conversation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $conversation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conversation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

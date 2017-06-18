<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Partage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Abonnement'), ['controller' => 'Abonnement', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Abonnement'), ['controller' => 'Abonnement', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tweet'), ['controller' => 'Tweet', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweet', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partage index large-9 medium-8 columns content">
    <h3><?= __('Partage') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_partage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tweet_partage') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partage as $partage): ?>
            <tr>
                <td><?= $this->Number->format($partage->id_partage) ?></td>
                <td><?= $partage->has('abonnement') ? $this->Html->link($partage->abonnement->id, ['controller' => 'Abonnement', 'action' => 'view', $partage->abonnement->id]) : '' ?></td>
                <td><?= $this->Number->format($partage->tweet_partage) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partage->id_partage]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partage->id_partage]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partage->id_partage], ['confirm' => __('Are you sure you want to delete # {0}?', $partage->id_partage)]) ?>
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

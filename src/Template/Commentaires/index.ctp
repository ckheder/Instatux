<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Commentaire'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentaires index large-9 medium-8 columns content">
    <h3><?= __('Commentaires') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('tweet_id') ?></th>
                <th><?= $this->Paginator->sort('auteur') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentaires as $commentaire): ?>
            <tr>
                <td><?= $this->Number->format($commentaire->id) ?></td>
                <td><?= h($commentaire->tweet_id) ?></td>
                <td><?= h($commentaire->auteur) ?></td>
                <td><?= h($commentaire->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $commentaire->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commentaire->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commentaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentaire->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

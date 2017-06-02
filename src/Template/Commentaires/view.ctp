<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Commentaire'), ['action' => 'edit', $commentaire->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Commentaire'), ['action' => 'delete', $commentaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentaire->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Commentaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Commentaire'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commentaires view large-9 medium-8 columns content">
    <h3><?= h($commentaire->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Tweet Id') ?></th>
            <td><?= h($commentaire->tweet_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Auteur') ?></th>
            <td><?= h($commentaire->auteur) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($commentaire->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($commentaire->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comm') ?></h4>
        <?= $this->Text->autoParagraph(h($commentaire->comm)); ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Abonnement'), ['action' => 'edit', $abonnement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Abonnement'), ['action' => 'delete', $abonnement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $abonnement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Abonnement'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Abonnement'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="abonnement view large-9 medium-8 columns content">
    <h3><?= h($abonnement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($abonnement->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Suiveur') ?></th>
            <td><?= $this->Number->format($abonnement->suiveur) ?></td>
        </tr>
        <tr>
            <th><?= __('Suivi') ?></th>
            <td><?= $this->Number->format($abonnement->suivi) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($abonnement->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($abonnement->modified) ?></td>
        </tr>
    </table>
</div>

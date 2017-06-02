<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $messagerie->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $messagerie->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Messagerie'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messagerie form large-9 medium-8 columns content">
    <?= $this->Form->create($messagerie) ?>
    <fieldset>
        <legend><?= __('Edit Messagerie') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('destinataire');
            echo $this->Form->input('message');
            echo $this->Form->input('conversation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

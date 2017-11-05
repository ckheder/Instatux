<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Conversation'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="conversation form large-9 medium-8 columns content">
    <?= $this->Form->create($conversation) ?>
    <fieldset>
        <legend><?= __('Add Conversation') ?></legend>
        <?php
            echo $this->Form->input('participant1');
            echo $this->Form->input('participant2');
            echo $this->Form->input('statut');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

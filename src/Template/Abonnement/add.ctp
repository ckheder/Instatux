<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Abonnement'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="abonnement form large-9 medium-8 columns content">
    <?= $this->Form->create($abonnement) ?>
    <fieldset>
        <legend><?= __('Add Abonnement') ?></legend>
        <?php
            echo $this->Form->input('user_id');
            echo $this->Form->input('suivi');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>



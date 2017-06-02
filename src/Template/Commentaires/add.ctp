<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Commentaires'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="commentaires form large-9 medium-8 columns content">
    <?= $this->Form->create($commentaire) ?>
    <fieldset>
        <legend><?= __('Add Commentaire') ?></legend>
        <?php
            echo $this->Form->input('comm');
            echo $this->Form->input('tweet_id');
            echo $this->Form->input('user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

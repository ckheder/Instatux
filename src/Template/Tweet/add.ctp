<?= $this->element('menuco') ?>
<div class="container">
  <div class="row">
<div class="col-sm-6">
<?= $this->cell('Users');?>
</div>
<div class="col-sm-6">
    <?= $this->Form->create($tweet) ?>
    <fieldset>
        <legend><?= __('Add Tweet') ?></legend>
        <?php
            echo $this->Form->hidden('user_id', array('value'=>$authUser));
            echo $this->Form->input('contenu_tweet');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>
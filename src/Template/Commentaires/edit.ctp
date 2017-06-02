<div class="container">
  <div class="row">
<div class="col-sm-6">
<?= $this->cell('Info', ['authuser' => $authUser]);?>
<?= $this->cell('Abonnementinfo', ['authuser' => $authUser]) ;  ?>
</div>
<div class="col-sm-6">
    <?= $this->Form->create($commentaire) ?>
    <fieldset>
        <legend><?= __('Modifier un commentaire') ?></legend>
        <?php
            echo $this->Form->input('comm');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
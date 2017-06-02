<?php foreach ($info_message as $info_message): ?>
<?= $this->Html->image(''.$info_message->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link($info_message->username,'/'.$info_message->username.'') ?>
<?php endforeach; ?>

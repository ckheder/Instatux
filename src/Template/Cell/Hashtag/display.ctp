<div class="text-center">
<h4><span class="glyphicon glyphicon-fire"></span>&nbsp;Tendance</h4>
</div>
<ul class="hashtag">
<?php foreach ($hashtag as $hashtag): ?>
<li>
<?= $this->Html->link('#'.h($hashtag->tag),'/search-%23'.h($hashtag->tag).'');?>
<br />
<?php echo $hashtag->nb_tag.' tweet(s)';?>
</li>
<?php endforeach; ?>
</ul>
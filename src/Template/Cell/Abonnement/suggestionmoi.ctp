<div class="text-center">
<h4><span class="glyphicon glyphicon-globe"></span>&nbsp;Vous pouvez suivre aussi</h4>
</div>
<?php foreach ($suggestionmoi as $suggestionmoi): 

?>

 <div class="liste_suggestion">

<?php

echo  $this->Html->image(''.$suggestionmoi->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
echo  $this->Html->link(h($suggestionmoi->username),'/'.h($suggestionmoi->username).'');?><span class="alias_tweet">@<?=$suggestionmoi->username?></span>

</div>

<?php

endforeach;
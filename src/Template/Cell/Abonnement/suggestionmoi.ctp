<div id="suggestion">
<br />
<div class="text-center">
<h4><span class="glyphicon glyphicon-globe"></span>&nbsp;Vous pouvez suivre aussi</h4>
<br />
</div>
 <ul class="liste_suggestion">
<?php foreach ($suggestionmoi as $suggestionmoi): 

?>
<li>


<?php

echo  $this->Html->image('/img/avatar/'.$suggestionmoi->username.'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter'));
echo  $this->Html->link(h($suggestionmoi->username),'/'.h($suggestionmoi->username).'');?><span class="alias_tweet">@<?=$suggestionmoi->username?></span>

</li>

<?php

endforeach;

?>
</ul>
</div>
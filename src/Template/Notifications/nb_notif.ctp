<?php

if($nb_notif > 0)
{
?>
<script>
	var nb_notif = <?= $nb_notif ?>;
	var title = $( ".titlepage" ).text();
	title = title.replace(/ *\([^)]*\) */g, '');
</script>
<sup><span class="badge badge-notify"><?= $nb_notif ?></span></sup>
<script>
	 $( ".titlepage" ).empty();
	$( ".titlepage" ).prepend( "(" + nb_notif + ")" + title );
	</script>
<?php
}
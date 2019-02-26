  <?php

  if($blocage == 0) // follower non bloqué, ajout d'un lien de blocage
  {
  	?>
  <a href="#" data-username="<?= $suivi ;?>" data-action="add" title="Bloquer <?= $suivi ;?>"  id="addblock" class="link_delete_abo" onclick="return false;">Bloquer</a>
<?php
    }
    else
    {
    	?>
   	<a href="#" data-username="<?= $suivi ;?>" data-action="delete" title="Débloquer <?= $suivi ;?>"  id="addblock" class="link_delete_abo" onclick="return false;">Débloquer</a>
   	<?php
    }
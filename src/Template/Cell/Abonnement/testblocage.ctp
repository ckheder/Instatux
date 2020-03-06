<!--

 * testblocage.ctp
 *
 * Test du blocage sur mes followers
 *
 */

-->

      <?php

            if($blocage == 0) // follower non bloqué, ajout d'un lien de blocage
          {
  	       ?>

              <span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $suivi ;?>" data-action="add" title="Bloquer <?= $suivi ;?>"  id="addblock" onclick="return false;">Bloquer</a>

          <?php
          }
            else // follower bloqué, ajout d'un lien de déblocage
          {
    	     ?>

              <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $suivi ;?>" data-action="delete" title="Débloquer <?= $suivi ;?>"  id="addblock" onclick="return false;">Débloquer</a>

   	        <?php
          }
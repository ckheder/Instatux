<?php
            if($nb_notif == 0)
            {
                echo '<div class="alert alert-warning text-center">
                                <strong>Aucune notification.</strong>
                        </div>';
            }
            else
            {

?>

<div id="list_notif">

<div class="alert alert-warning text-center"><strong>Vous avez <span id="nb_notif"><?= $nb_notif ;?></span>&nbsp;notification(s).</strong></div>
<br />
 <div class="dropdown" id="optionnotif">
  <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Options
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><?= $this->Html->Link("Tout marquer comme lue",'#',array(
        'id' => 'allnotiflue','onclick' => 'return false'
    ));?></li>
    <li><?= $this->Html->Link("Tout effacer",'#',array(
        'id' => 'alldeletenotif','onclick' => 'return false'
    ));?> </li>
  </ul>
</div>
<br />


<?php

 foreach ($notification as $notification):

if($notification->statut == 0) // notif non lu
{

    echo '<div class="notif_non_lu" data-idnotif="'.$notification->id_notif.'">';

 }

else // notif lue
{

echo '<div class="notif_lu" data-idnotif="'.$notification->id_notif.'">';

}
     ?>

            <span class="date_notif">

            <?= $notification->created->i18nformat('dd MMMM YYYY - HH:mm'); ?>

             


             </span>


            <?= $notification->notification; ?>
<br />
<span class="notif_link"><a href="#" data-idnotif="<?= $notification->id_notif ;?>"  title="Marquer comme lue"  class="readnotif" onclick="return false;">Marquer comme lue</a> - <a href="#" data-idnotif="<?= $notification->id_notif ;?>"  title="Supprimer"  class="deletenotif" onclick="return false;">Effacer</a></span>

</div>

<?php

endforeach; ?>

</div>


            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>

          </div>

 <?php

        } ?>




 <?= $this->Html->script('indexnotification.js') ?>

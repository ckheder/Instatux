<!--

 * index.ctp
 *
 * Page d'accueil des notifications
 *
 */ -->

<!-- pas de notif -->

<?php

  if($notification->isEmpty())
{

  echo '<div class="alert alert-info nonotif">Vous n\'avez aucune notification.</div>';

}

?>
<!-- liste des notifications -->

<div id="list_notif">

<?php

      foreach ($notification as $notification):

        if($notification->statut == 0) // notification non lue
      {

        echo '<div class="notif_non_lu" data-idnotif="'.$notification->id_notif.'">';

      }

        else // notification lue
      {

        echo '<div class="notif_lu" data-idnotif="'.$notification->id_notif.'">';

      }

     ?>

     <span class="notif_link"> <!-- lien "marquer comme lue" / supprimer notif -->

        <!-- date notification -->
<?php

             if($notification->statut == 0) //si la notification est lue, suppression du lien de "marquer comme lue"
           {
       ?>
          <span id ="<?= $notification->id_notif ;?>">
           &nbsp;&nbsp;<a href="#" data-idnotif="<?= $notification->id_notif ;?>"  title="Marquer comme lue"  class="readnotif" onclick="return false;"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;</a>
     </span>
     
       <?php

           }

       ?>

          <a href="#" data-idnotif="<?= $notification->id_notif ;?>"  title="Supprimer"  class="deletenotif" onclick="return false;"><span class="glyphicon glyphicon-trash"></span></a>

     </span>

     <?php

     // troncage des notifications pour n'afficher qu'une partie du texte

     $notifications = $this->Text->truncate($notification->notification, 110,
 [
     'ellipsis' => '..."',
     'exact' => false,
     'html' => true
 ]
);

     // affichage notification

      echo $notifications;

      ?>

<br />

<!-- date notification -->

<span class="glyphicon glyphicon-time" style="margin-left:5px;"></span><?= str_replace('il y a','',$notification->created->timeAgoInWords([
'accuracy' => ['day' => 'day'],
'end' => '1 year'
]));
?>

</div>

<?php

        endforeach;

?>

</div>

<!-- lien pagination -->

          <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>

          </div>
<br >

 <?= $this->Html->script('indexnotification.js') ?>

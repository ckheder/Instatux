<?php


            if(isset($nb_notif))
            {
                echo '<div class="alert alert-info">
                                Aucune notification à afficher
                        </div>';
            }
            else
            {

?>

 <span class="link_comm_share">

  <?php

echo $this->Html->Link("Tout marquer comme lue", ['controller' => 'Notifications','action' => 'allNotiflue']);

echo $this->Html->Link("Paramètres", '/settings#setup_profil',['class' => 'pull-right']);

?>

</span>

<br />
<br />
<div id="list_tweet">
<?php



 foreach ($notification as $notification): 

if($notification->statut == 0) // notif non lu
{
    ?>
    <div class="notif_non_lu"> <!-- div non lu -->
<?= $this->element('menu_notif', [
    "notif_user" => $notification->user_name,
    "id_notif" => $notification->id_notif
]);

}
else // notif lue
{
    ?>
<div class="tweet">
<?= $this->element('menu_notif', [
    "notif_user" => $notification->user_name,
    "id_notif" => $notification->id_notif
]);
  
  }
?>
            <span class="date_notif">

            <?= $notification->created->i18nformat('dd MMMM YYYY'); ?>
                 
             </span>
       

            <?= $this->Text->autoParagraph($notification->notification); ?>

</div>
<?php endforeach; 
            echo '</div>';

?>


            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>





          </div>

 <?php         

        } ?>



           

            <script>

              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin des notifications"}));
  ias.extension(new IASPagingExtension());

</script>



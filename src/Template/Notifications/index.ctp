<?php
use Cake\Routing\Router;

            if(isset($nb_notif))
            {
                echo '<div class="alert alert-info">
                                Aucune notification à afficher
                        </div>';
            }
            else
            {

?>

<p id="etatnotif"></p>


 <div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Options
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><?= $this->Html->Link("Tout marquer comme lue",'#',array(
        'id' => 'allnotiflue','onclick' => 'return false' 
    ));?></li>
    <li><?= $this->Html->Link("Tout effacer",'#',array(
        'id' => 'alldeletenotif','onclick' => 'return false' 
    ));?> </li>
    <li><?=$this->Html->Link("Paramètres", '/settings#setup_profil'); ?> </li>
  </ul>
</div> 
<br />
<div id="list_tweet">
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

            <?= $notification->created->i18nformat('dd MMMM YYYY'); ?>

             <a href="#" data-idnotif="<?= $notification->id_notif ;?>"  title="Supprimer"  class="deletenotif" onclick="return false;"><span class="glyphicon glyphicon-remove red"></span></a> 

                             
             </span>
       

            <?= $this->Text->autoParagraph($notification->notification); ?>



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

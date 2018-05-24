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





 <span class="link_comm_share">

  <?php

echo $this->Html->Link("Tout marquer comme lue",'#',array(
        'id' => 'allnotiflue','onclick' => 'return false' 
    ));

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
    
    echo '<div class="notif_non_lu">';

 }

else // notif lue
{
  
echo '<div class="notif_lu">';

}
     ?>

            <span class="date_notif">

            <?= $notification->created->i18nformat('dd MMMM YYYY'); ?>
                 
             </span>
       

            <?= $this->Text->autoParagraph($notification->notification);

echo '</div>';


endforeach; ?>

</div>


            <div id="pagination">

            <?= $this->Paginator->next('Next page'); ?>

          </div>

 <?php         

        } ?>

 <?= $this->Html->script('indexnotification.js') ?>
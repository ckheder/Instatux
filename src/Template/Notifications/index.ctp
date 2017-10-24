<?php
use Cake\I18n\Time;
use Cake\Event\Event;

            if(isset($nb_notif))
            {
                echo '<div class="alert alert-info">
                                Aucune notification à afficher
                        </div>';
            }
            else
            {


 foreach ($notification as $notification): 

if($notification->statut == 0)
{
    ?>
    <div class="notif_non_lu">
<?php
}
else
{
    ?>
<div class="tweet">
                            <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php
                
            
                if($notification->user_name == $authName) // si c'est une notification me concernant
                {
                ?>
                <li>
                <?= $this->Html->link("Effacer cette notification", ['action' => 'delete',$notification->id_notif], ['title' =>'delete']); // je peut effacer mon post 
                ?>
            </li>

             <?php
                }
                ?>

  </ul>
</div>
<!-- fin bouton dropdown tweet -->
  <?php
  }
?>
            <span class="date_notif">

            <?= $notification->created->i18nformat('dd MMMM YYYY'); ?>
                 
             </span>
       

            <?= $this->Text->autoParagraph($notification->notification); ?>

</div>
<?php endforeach; 

$event = new Event('View.afterRender.indexnotif', $this, ['authname' => $authName]);
                $this->eventManager()->dispatch($event);
                
}
?>
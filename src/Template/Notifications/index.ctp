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
  <?php
  }

            $time = new Time($notification->created);
            $time->toUnixString();
            $date_notif = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
             <span class="date_tweet"><?= $date_notif ?></span>
             <?php
            $notification_user = preg_replace( "/#([^\s]+)/",$this->Html->link('#$1','/search-%23$1'), $notification->notification); ?>
             <?= $this->Text->autoParagraph($notification_user) ?>
              
             <?php if($notification->user_name == $authName)
                {
                ?>
                
                <?= $this->Html->link("Delete", ['action' => 'delete',$notification->id_notif], ['title' =>'delete', 'class' =>'deletetweet' ]);
                }
                ?>

</div>
<?php endforeach; 

$event = new Event('View.afterRender.indexnotif', $this, ['authname' => $authName]);
                $this->eventManager()->dispatch($event);
                
}
?>
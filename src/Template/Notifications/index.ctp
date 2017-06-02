<?php
use Cake\I18n\Time;
use Cake\Event\Event;
?>
<div class="col-sm-5">

<?php foreach ($notification as $notification): ?>
<?php
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
             <?= $this->Text->autoParagraph($notification->notification) ?>
              
             <?php if($notification->user_id == $authUser)
                {
                ?>
                
                <?= $this->Html->link("Delete", ['action' => 'delete',$notification->id_notif], ['title' =>'delete', 'class' =>'deletetweet' ]);
                }
                ?>

</div>
<?php endforeach; ?>
<?php
$event = new Event('View.afterRender.indexnotif', $this, ['authuser' => $authUser]);
                $this->eventManager()->dispatch($event);
                ?>
</div>


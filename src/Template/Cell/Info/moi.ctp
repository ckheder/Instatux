<?php
use Cake\I18n\Time;
?>

            <?php foreach ($users as $user): ?>
 <div class = "text-center">

                 <?= $this->Html->image(''.$user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle', 'width'=>128, 'max-width'=>'100%','height'=>'auto'));
                
                ?>
                <br />
                <br />
                <span class="username"><?= h($user->username) ?></span>
                                <?php if(!empty($user->description))
                {
                    ?>
                <br />
                <span class="description">
                <?php
               echo h($user->description);
            }
            ?>
            </span>
            <br />
            <br />
                </div>
  <ul class="item-user"> 
<?php
              if(!empty($user->lieu))
                {
                    ?>
                <li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;<?= h(ucfirst($user->lieu)) ?></li>

                <?php
            }

            $time = new Time($user->created);
            $time->toUnixString();
            $date_insc = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                <li><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Inscrit <?= h($date_insc) ?></li>
                            
            
            <?php endforeach; ?>
<?php
use Cake\I18n\Time;
?>


            <?php foreach ($users as $user): ?>
 <div class = "text-center">

                 <?= $this->Html->image(''.$user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle', 'width'=>128, 'max-width'=>'100%','height'=>'auto'));
                
                ?>
                </div>
               
                <br />
<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?= h($user->username) ?>
<br />
<br />
                <?php if(!empty($user->description))
                {
                    ?>
                <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;<?= h($user->description) ?>
                                <br />
                <br />
                <?php
            }

            $time = new Time($user->created);
            $time->toUnixString();
            $date_insc = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                <span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Inscrit <?= h($date_insc) ?>
<br />

            <?php endforeach; ?>

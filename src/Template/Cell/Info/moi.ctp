<?php
use Cake\I18n\Time;
?>

            <?php foreach ($users as $user): ?>
 <div class = "text-center">

    <span id="user_avatar">

                 <?= $this->Html->image(''.$user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-circle', 'width'=>128, 'max-width'=>'100%','height'=>'auto'));
                
                ?>
            </span>
                <br />
                <br />
                <span class="username"><?= h($user->username) ?></span>
                <br />
                <span class="alias">@ <?= h($user->username) ?></span>
                <br />
                 <span id ="user_description">
                                <?php if(!empty($user->description))
                {
                    ?>
                <br />
               
                
               <?= h($user->description);
               
            }
            ?>
</span>
            <br />
            <br />
                </div>
  <ul class="item-user">
    <span id ="user_lieu">
<?php
              if(!empty($user->lieu))
                {
                    ?>

                <li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;<?= h(ucfirst($user->lieu)) ?></li>

                <?php
            }
?>
</span>
<span id ="user_website">
<?php
                if(!empty($user->website))
                {
                    ?>
                <li><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;<?= $this->Html->link(''.$user->website.'',''.$user->website.'',
    ['target' => '_blank']); ?></li>
                <?php
            }
            ?>
        </span>
                <li><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Inscrit le <?= $user->created->i18nformat('dd MMMM YYYY'); ?></li>
                            
            
            <?php endforeach; ?>
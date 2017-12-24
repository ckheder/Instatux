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
                <br />
                <span class="alias">@ <?= h($user->username) ?></span>
                <br />
                                <?php if(!empty($user->description))
                {
                    ?>
                <br />

                <?php
               echo h($user->description);
            }
            ?>

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

                if(!empty($user->website))
                {
                    ?>
                <li><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;<?= $this->Html->link(''.$user->website.'',''.$user->website.'',
    ['target' => '_blank']); ?></li>
                <?php
            }
            ?>
                <li><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Inscrit <?= $user->created->i18nformat('dd MMMM YYYY'); ?></li>
                            
            
            <?php endforeach; ?>
<!--

 * display.ctp
 *
 * Informations utilisateurs
 *
 */

-->

<?php
    use Cake\I18n\Time;
?>

        <div class="text-center">
    <br />
<?php foreach ($users as $user): ?>

            <?=

            $this->Html->image('/img/avatar/'.$this->request->getParam('username').'.jpg', array('alt' => 'image utilisateur', 'class'=>'img-circle', 'width'=>128, 'max-width'=>'100%','height'=>'auto')); // avatar

            ?>
                <br />

                <br />

                    <span class="username"> <?= h($user->username) ?></span><!-- username -->

                <br />

                    <span class="alias">@ <?= h($user->username) ?></span> <!-- alias -->

                <br />

                    <?php if(!empty($user->description)) // si la description est renseigné
                {
                    ?>

                <br />

                    <?php
                        echo $user->description;
                }
                    ?>

            <br />

            <br />
            
        </div>

  <ul class="item-user"> <!-- lieu, website, date inscription et nombre de tweets -->

<?php

                if(!empty($user->lieu)) // si le lieu est renseigné
            {
                    ?>

                <li>
                    <span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;<?= h(ucfirst($user->lieu)) ?>
                </li>

                    <?php
            }

                if(!empty($user->website)) // si le site web est renseigné
            {
                    ?>
                <li>
                    <span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;<?= $this->Html->link(''.$user->website.'',''.$user->website.'',
                    ['target' => '_blank']); ?>
                </li>
                    <?php
            }

                    ?>

            <li> <!-- date inscription -->
                <span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Inscrit le <?= $user->created->i18nformat('dd MMMM YYYY'); ?>
            </li>

            <li>
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;<span id="nb_tweet_<?= h($user->username) ?>"><?= $nb_tweet ;?></span>&nbsp;Tweet(s)
            </li>

            <li>
                <span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;<span id="nb_media_<?= h($user->username) ?>"><?= $nb_media ;?></span>&nbsp;<a href="/instatux/<?= $this->request->getParam('username') ;?>/media">Photo(s)</a>
            </li>

<?php endforeach;


?>

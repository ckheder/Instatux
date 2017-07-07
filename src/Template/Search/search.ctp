<?php
use Cake\I18n\Time;
?>

 <h3>Résultat dans les membres pour "<?= h($search) ?>"</h3>

 <?php
            if($resultat_users === 0)
             
                
                
                 echo 'pas de résultat';
                 

                
            
            else
                         foreach ($resultat_users as $resultat_users): ?>
                         <div class="tweet">
                          <?= $this->Html->image(''.$resultat_users->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
<?= $this->Html->link(h($resultat_users->username),'/'.h($resultat_users->username).'') ?>
               <?= $this->Text->autoParagraph($resultat_users->description) ?>
              </div>
            <?php endforeach; ?>
<h3>Résultat dans les tweets pour "<?= h($search) ?>"</h3>

<?php
            if($resultat_tweet === 0)
             
                
                
                 echo 'pas de résultat';
                 

                
            
            else
                         foreach ($resultat_tweet as $resultat_tweet): ?>
            <div class="tweet">
                <?= $this->Html->image(''.$resultat_tweet->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
            	<?= $this->Html->link(h($resultat_tweet->user->username),'/'.h($resultat_tweet->user->username).'') ?>
                                      <?php
            $time = new Time($resultat_tweet->created);
            $time->toUnixString();
            $date_tweet = $time->timeAgoInWords([
    'accuracy' => ['month' => 'month'],
    'end' => '1 year'
]);
            ?>
                <span class="date_tweet">Posté <?= $date_tweet ?></span>
                <?= $this->Text->highlight($this->Text->autoParagraph(h($resultat_tweet->contenu_tweet)), $search , ['format'=>'<span class="surbrillance">\1</span>']) ?>
                </div>
            <?php endforeach; ?>

      
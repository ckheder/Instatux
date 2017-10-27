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
<?= $this->Html->link(h($resultat_users->username),'/'.h($resultat_users->username).'',['class' => 'link_username_tweet']) ;?>
<span class="alias_tweet">@<?=$resultat_users->username ?></span>
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
            	<?= $this->Html->link(h($resultat_tweet->user->username),'/'.h($resultat_tweet->user->username).'',['class' => 'link_username_tweet']) ; ?>

                <span class="alias_tweet">@<?=$resultat_tweet->user->username ?></span> - 

                <?= $resultat_tweet->created->i18nformat('dd MMMM YYYY'); 
                                     
            $resultat_tweet_contenu = str_replace('</p>', '', $resultat_tweet->contenu_tweet);
            ?>
                
                <?= $this->Text->highlight($this->Text->autoParagraph($resultat_tweet_contenu), $search , ['format'=>'<span class="surbrillance">\1</span>']) ?>
                 <span class="nb_comm_share"><?= $resultat_tweet->nb_commentaire ?> commentaire(s) - <?= $resultat_tweet->nb_partage ?> partage(s)
                 </span>
<br />
                </div>
            <?php endforeach; ?>

      
 <?php
        if(isset($nbabonnement_attente))
        {
         echo '<div class="alert alert-info">Aucune demande d\'abonnement en attente.</div>';
        }
        else
        {
           ?><div class="alert alert-warning" id="nbattente"><span class="glyphicon glyphicon-user"></span>&nbsp;<script> var nbattente = <?= $nb_attente ;?> 
           document.getElementById('nbattente').innerHTML = nbattente;
         </script> demande(s) en attente.</div>
           <?php
            // abonnement attente //
 foreach ($abonnement_attente as $abonnement_attente):?>
        <div class="tweet" data-username="<?= $abonnement_attente->Users['username'] ;?>">
                          <?= $this->Html->image(''.$abonnement_attente->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>'img-circle vcenter')) ?>
                         
<?= $this->Html->link(h($abonnement_attente->Users['username']),'/'.h($abonnement_attente->Users['username']).'');
               
 echo '<span class="link_abo pull-right">';
               echo '<a href="#" data-username="'.$abonnement_attente->Users['username'].'"  data-action="accept" id="accept" class="accept-link">Accepter</a> - <a href="#" data-username="'.$abonnement_attente->Users['username'].'"  data-action="refuse" id="refuse" class="refuse-link">Refuser</a>'; ?>
               </span>
              </div>
               <?php  endforeach;
        
        }
?>
<?= $this->Html->script('/js/settingsabo.js') ?>

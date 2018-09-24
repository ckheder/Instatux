 <div class="alert alert-success">
<strong>Info!</strong> Vous trouverez ici la liste de toutes les personnes qui veulent vous suivre mais aussi les personnes à qui vous avez envoyé une demande de suivi.
<br />
<br />
Vous pouvez accepter ou refuser les demandes d'abonnements depuis cette page.
    </div>      
                            <?= $this->Paginator->limitControl([10 => 10, 30 => 30]); ?>

                          <div class="pagination">
    <ul class="pagination">
            <?php
                echo $this->Paginator->prev(__('page précédente'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('page suivante'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>

           <?php
 // partie mes demandes reçues
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
               echo '<a href="#" data-username="'.$abonnement_attente->Users['username'].'"  data-action="accept" id="accept" class="btn btn-success accept-link">Accepter</a> - <a href="#" data-username="'.$abonnement_attente->Users['username'].'"  data-action="refuse" id="refuse" class="btn btn-danger refuse-link">Refuser</a>'; ?>
               </span>
              </div>
               <?php  endforeach; ?>
                          <div class="pagination pagination-large">
    <ul class="pagination">
            <?php
                echo $this->Paginator->prev(__('page précédente'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('page suivante'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
    <?php
        }


// fin partie mes demandes reçues

// partie mes demandes envoyés
         ?>



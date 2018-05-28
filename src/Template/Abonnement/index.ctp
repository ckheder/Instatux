<p id="etatnotif"></p>
<div id="tabs">
  <ul>
    <li><a href="#abonnement">Abonnements</a></li>
    <li><a href="#abonne">Abonnés</a></li>
    <?php
    if($this->request->getParam('username') == $authName)
    {
      ?>
    <li><a href="#demande">Demande d'abonnement</a></li>
    <?php
  }
  ?>
  </ul>

   <div id="abonnement"> <!-- personne que je suis -->
    <?php
        if(isset($nbabonnement_valide)) 
        {
            echo '<div class="alert alert-info">Aucun abonnement actif à afficher</div>';
        }
        else
        {
             echo '<div class="alert alert-info"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;'.$count_abonnement.' abonnement(s).</div>'; // nombre d'abonnés
        ?>
        <!-- abonnement validé -->
        
            <?php foreach ($abonnement_valide as $abonnement_valide): ?>
          <div class="liste_abo">
                
            <?= $this->Html->image(''.$abonnement_valide->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonnement_valide->Users['username']).'')) ?>

            <?= $this->Html->link(''.h($abonnement_valide->Users['username']).'','/'.h($abonnement_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>
           
 </div>
            <?php endforeach; ?>


<!-- fin abonnement validé -->
    <?php
    }
    ?>
   </div>
    <div id="abonne"> <!-- personne qui me suive -->
        <?php
        if(isset($nbabonne_valide)) 
        {
            echo '<div class="alert alert-info">Aucun abonné pour le moment.</div>';
        }
        else
        {
             echo '<div class="alert alert-info"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;'.$count_abonnes.' abonné(s).</div>'; // nombre d'abonnés
        ?>
        <!-- abonnement validé -->
        
            <?php foreach ($abonne_valide as $abonne_valide): ?>
          <div class="liste_abo">

            <?= $this->Html->image(''.$abonne_valide->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>' img-thumbnail vcenter', 'title' => ''.h($abonne_valide->Users['username']).'')) ?>
            
            <br />
            <?= $this->Html->link(''.h($abonne_valide->Users['username']).'','/'.h($abonne_valide->Users['username']).'',['class' => 'link_username_tweet','escape' => false]) ?>
           
 </div>
            <?php endforeach; ?>


<!-- fin abonnement validé -->
    <?php
    }
    ?>
    </div>
    <?php
        if($this->request->getParam('username') == $authName)
    {
      ?>
     <div id="demande"> <!-- demande d'abonnement -->
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

     </div>
     <?php
   }

   ?>


</div>
 <?= $this->Html->script('settingsabo.js') ?>
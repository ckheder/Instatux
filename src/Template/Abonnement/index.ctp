


        <?php

        use App\Model\Entity\User;

        if(isset($nbabonnement_attente))
        {
         echo '<div class="alert alert-info">Aucun demande d\'abonnement en attente.</div>';
        }
        else
        {
           echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-user"></span>&nbsp;'.$nb_attente.' demande(s) en attente.</div>';
            // abonnement attente //
 foreach ($abonnement_attente as $abonnement_attente):?>
        <div class="tweet">
                          <?= $this->Html->image(''.$abonnement_attente->Users['avatarprofil'].'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
                         
<?= $this->Html->link(h($abonnement_attente->Users['username']),'/'.h($abonnement_attente->Users['username']).'');
               
 echo '<span class="link_abo pull-right">';
               echo '<a href="/instatux/abonnement/accept/'.$abonnement_attente->Users['username'].'" class="accept-link">Accepter</a> - <a href="/instatux/abonnement/refuse/'.$abonnement_attente->Users['username'].'" class="refuse-link">Refuser</a>'; ?>
               </span>
              </div>
               <?php  endforeach;
        
        }
        // fin abonnement attente
        if(isset($nbabonnement_valide)) 
        {
            echo '<div class="alert alert-info">Aucun abonnement actif à afficher</div>';
        }
        else
        {
            echo '<div class="alert alert-success"><span class="glyphicon glyphicon-user"></span>&nbsp;'.$count_abonnes.' abonnement(s).</div>';
        ?>
        
        <!-- abonnement validé -->
        <ul class="liste_abo">
            <?php foreach ($abonnement_valide as $abonnement_valide): ?>
          <li>
            
                               <?= $this->Html->image(''.$abonnement_valide->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>' vcenter')) ?>
                <br />
            <?= $this->Html->link(h($abonnement_valide->user->username),'/'.h($abonnement_valide->user->username).'',['class' => 'link_username_tweet']) ?>
            <br />
            <span class="alias_abo">@<?=$abonnement_valide->user->username ?></span> 
                <br />
            <?= $this->cell('Abonnement::nbabonnes', ['id' => $abonnement_valide->user->username])  ?>
            <br />
                            <?php if($abonnement_valide->user_id == $authName)
                {
                ?>
                <?=  $this->Html->link(
                'se désabonner',
                array(
                
                'controller'=>'abonnement',
                'action'=>'delete',
                
                
                  $abonnement_valide->suivi
                


                ),
                ["class" => "btn btn-danger btn_abo"]
                );
                };
                ?>
           
 

 </li>
            <?php endforeach; ?>

</ul>
<!-- fin abonnement validé -->
    <?php
    }
    ?>



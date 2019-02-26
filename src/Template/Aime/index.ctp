 <?php

 if(isset($nolike))
 {
  echo '<div class="alert alert-warning text-center">
                                <strong>Personne n\'aime ce contenu pour le moment.</strong>
                        </div>';
 }
 else
 {
  ?>

  <div id="list_like">

      <?php foreach ($listlike as $listlike): ?>
       <div class="liste_like">
        <img src="/instatux/img/avatar/<?php echo $listlike->Users['username']; ?>.jpg" alt="image utilisateur" class="img-circle vcenter likepic"><a href="./<?php echo $listlike->Users['username']; ?>" title="Voir le profil de <?php echo $listlike->Users['username']; ?>"><?php echo $listlike->Users['username']; ?></a><span class="alias_tweet">@<?=$listlike->Users['username'] ?></span>
        <span class="btn_like">
        <?php

                       if(isset($authName) AND $listlike->Users['username'] != $authName) // si je suis connecté et si ce n'est pas moi, on vérifie si je suis déjà abooné ou non à cette personne
               {
                
                echo $this->cell('Abonnement::test_abo_like', ['authname' => $authName, 'suivi' =>$listlike->Users['username']]) ;  
               }
               ?>
             </span>
               <br />

   </div>
    <?php endforeach ;?>

                <div id="paginations">

            <?= $this->Paginator->next('Next page'); ?>

          </div>

</div>
<?= $this->Html->script('iaslike.js') ?>
<?php
}
?>
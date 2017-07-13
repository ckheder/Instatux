


        <?php

        if($nbabonnement == 0)
        {
         echo 'pas d\'abonnement';
        }
        else
        {
        ?>
        <ul class="liste_abo">
            <?php foreach ($abonnement as $abonnement): ?>
          <li>
            
                               <?= $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>' vcenter')) ?>
                <br />
            <?= $this->Html->link(h($abonnement->user->username),'/'.h($abonnement->user->username).'') ?>
                <br />
            <?= $this->cell('Abonnement::nbabonnes', ['id' => $abonnement->user->username])  ?>
            <br />
                            <?php if($abonnement->user_id == $authName)
                {
                ?>
                <?=  $this->Html->link(
                'se désabonner',
                array(
                
                'controller'=>'abonnement',
                'action'=>'delete',
                
                
                  $abonnement->suivi
                


                ),
                ["class" => "btn btn-danger btn_abo"]
                );
                };
                ?>
           
 

 </li>
            <?php endforeach; ?>

</ul>
    <?php
    }
    ?>



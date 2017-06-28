
<div class="col-sm-6">

        <?php

        if($nbabonnement == 0)
        {
         echo 'pas d\'abonnement';
        }
        else
        {
        ?>

            <?php foreach ($abonnement as $abonnement): ?>
            <div class="col-xs-3">
            <div class="text-center">
                               <?= $this->Html->image(''.$abonnement->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>'img-thumbail vcenter')) ?>
                <br />
            <?= $this->Html->link($abonnement->user->username,'/'.$abonnement->user->username.'') ?>
            <br />
             <?= $abonnement->user->description ?>
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
                
                
                  $abonnement->id
                


                ),
                ["class" => "btn btn-danger btn_abo"]
                );
                ?>
                <?php
                };
                ?>
           

        </div>  
 </div>
            <?php endforeach; ?>


    <?php
    }
    ?>
</div>


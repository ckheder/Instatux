


        <?php

        use App\Model\Entity\User;

        if(isset($nb_bloques))
        {
         echo '<div class="alert alert-info">Aucun utilisateur bloqué</div>';
        }

        else
        {
            
        echo '<ul class="liste_abo">';
    
       
            foreach ($listebloques as $listebloques): ?>
          
            
                <li>               <?= $this->Html->image(''.$listebloques->user->avatarprofil.'', array('alt' => 'image utilisateur', 'class'=>' img-thumbail vcenter')) ?>
                <br />
            <?= $this->Html->link(h($listebloques->user->username),'/'.h($listebloques->user->username).'',['class' => 'link_username_tweet']) ?>
            <br />
            <span class="alias_abo">@<?=$listebloques->user->username ?></span> 
                <br />
            
            

                <?=  $this->Html->link(
                'Débloquer',
                array(
                
                'controller'=>'blocage',
                'action'=>'delete',
                
                
                  $listebloques->user->username
                


                ),
                ["class" => "btn btn-danger btn_abo"]
                );
                
                ?>
                </li>
            <?php endforeach; ?>

</ul>
<!-- fin abonnement validé -->
    <?php
    }
    ?>

                                  <div class="dropdown">
  <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    ...
      </button>
  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
    <?php
                
            
                if($notif_user == $authName) // si c'est une notification me concernant
                {
                ?>
                <li>
                <?= $this->Html->link("Effacer cette notification", ['action' => 'delete',$id_notif], ['title' =>'delete']); // je peut effacer mon post 
                ?>
            </li>

                            <li>
                <?= $this->Html->link("Marquer comme lue", ['action' => 'singleNotifLue',$id_notif], ['title' =>'Marquer comme lue']); // je peut effacer mon post 
                ?>
            </li>

             <?php
                }
                ?>

  </ul>
</div>
<!-- fin bouton dropdown tweet -->

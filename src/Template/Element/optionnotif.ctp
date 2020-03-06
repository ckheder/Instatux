<!--

 * optionnotif.ctp
 *
 * Barre de gauche sur la page des notifications : options
 *
 */

-->

<span id="option_notif">
    <div class="text-center">
      <h4>
        <span class="glyphicon glyphicon-wrench"></span>&nbsp;Options
      </h4>
    </div>

<ul class="statut_notif">

    <li>

      <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;

      <?= $this->Html->Link("Tout marquer comme lue",'#',array(
                                                                  'id' => 'allnotiflue','onclick' => 'return false'
                                                                )
                            );?>
      
    </li>

    <li>
      <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;

      <?= $this->Html->Link("Tout effacer",'#',array(
                                                      'id' => 'alldeletenotif','onclick' => 'return false'
                                                    )
                            );?> 
    </li>

     <li>
      <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;

      <a href="/instatux/settings">Paramètres</a>
    </li>

  </ul>
</span>
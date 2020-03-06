<!--

 * conversation.ctp
 *
 * Affichage des informations sur la conversation : inviter,supprimer une conversation,bloquer un utilisateur
 *
 */

-->

<!-- boutons d'options -->
<div class ="option">
	<div class="text-center">
	<h3><span class="glyphicon glyphicon-cog"></span>&nbsp;Options</h3>
</div>
 <ul class="item-conv">

                  <!-- ajouter un nouvel utilisateur -->

              <li id="addconvuser">
                  <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
                    <a href=""  data-toggle="modal" data-target="#modaladdconv" data-backdrop="static" id="addconvuser" data-keyboard="false"  title="Inviter à rejoindre la conversation" onclick="return false;">Inviter à rejoindre la conversation</a>
              </li>

              <!--bloquer (conversation duo) -->

              <?php 
                    if($type_conv = 'duo')
                  {

                    ?>

              <li>
                  <span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;<a href="#" data-username="<?= $destinataire ;?>" data-action="add" title="Bloquer <?= $destinataire ;?>"  id="addblock" onclick="return false;">Bloquer</a>
              </li>

                    <?php

                  }

            ?>

                  <!-- supprimer la conversation -->

              <li>
                <span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;
                    <a href="#" data-idconv="<?= $this->request->getParam('id') ;?>"  title="Supprimer cette conversation"  id="deleteconv"  onclick="return false;">Supprimer cette conversation</a>
              </li>

                  <!-- signaler -->
                  
              <li>
                  <span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<a href="#">Signaler</a>
              </li>

                  <!-- lien vers messagerie -->

              <li>
                  <span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;<a href="/instatux/messagerie" title="nouveau message">Retour à la messagerie</a>
              </li>
                                    
  </ul>
</div>
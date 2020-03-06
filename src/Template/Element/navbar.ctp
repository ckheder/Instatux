<!--

 * navbar.ctp
 *
 * Barre de navigation online/offline
 *
 */

-->
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav">

        <!-- lien actualités, messagerie et notifications -->

        <li>
<?php 

            if (isset($authName)) // si je suis authentifié
          {
            ?>
                <a href="/instatux/accueuil"> <span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Actualités</a> <!--actu online -->
<?php
          }
            else
          {
            ?>
                <a href="/instatux/actualites" title="Actualités"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Accueil</a><!-- actu offline -->
<?php
          }
          ?>
        </li>
<?php 
            if (isset($authName)) // si je suis authentifié
          {
            ?>
        <li>
              <a href="/instatux/notifications" title="Notifications"><span class="glyphicon glyphicon-bell"></span>
              <span id="count_nb_notif"></span>&nbsp;Notifications
              </a>
        </li>

        <li>
              <a href="/instatux/messagerie" title="Messagerie"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messagerie
              </a>
        </li>
<?php

          }

      ?>
      </ul>

            <?php if (isset($authName)) // si je suis authentifié
          {
            ?>

      <ul class="nav navbar-nav navbar-right">

      <!-- moteur de recherche, lien vers mon profil et menu déroulant -> Paramètres, abonnements et déconnexion -->
        
        <li>

            <?= $this->Form->create('', array('class'=>'navbar-form ','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
    
          <div class="input-group">

            <?= $this->Form->input('search',['id'=>'search','type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required','class' =>'form-control']); ?>
  
           <div class="input-group-btn">

        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

          </div>

          </div>

<?= $this->Form->end(); ?>

</li>

<li>

  <!-- lien vers proflil -->

  <a href="/instatux/<?= $authName ;?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Moi</a>

</li>

<li>

  <!--bouton tweet -->

  <?= $this->Form->button('<span class="glyphicon glyphicon-pencil"></span>', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalTweet',
                  'data-backdrop'=>'static',
                  'data-keyboard'=> 'false',
                  'class' => 'btn btn-info navbar-btn',
                  'type' => 'button']);
                  ?> 
</li>

<!-- menu déroulant -->

  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/instatux/settings">Paramètres</a></li>
          <li><a href="/instatux/abonnement/<?= $authName ;?>">Abonnements</a></li>
          <li><a href="/instatux/logout">Déconnexion</a> </li>
        </ul> 
  </li>

</ul>

<?php
}
else // menu offline
{
  ?>
  
  <ul class="nav navbar-nav navbar-center">
        <li>

            <?= $this->Form->create('', array('class'=>'navbar-form','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>

          <div class="input-group">

            <?= $this->Form->input('search',['id'=>'search','type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required','class' =>'form-control']); ?>
  
    <div class="input-group-btn">

        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

    </div>

          </div>

<?= $this->Form->end(); ?>

        </li>

      </ul>

<!-- bouton de connexion -->

      <div class="nav navbar-nav navbar-right">
        <?= $this->Form->button('Connexion', 
                                            [ 'data-toggle' => 'modal',
                                              'data-target' => '#ModalConnexion',
                                              'class' => 'btn btn-primary navbar-btn btnlogin',
                                              'type' => 'button']);
        ?>&nbsp;&nbsp;
      
      </div>
<?php
}
?>
    </div>
  </div>
</nav>
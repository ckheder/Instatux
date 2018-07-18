 <nav class="navbar navbar-inverse navbar-fixed-top container">
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
        <li><a href="/instatux/accueuil"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Actualités</a></li>

             <li><a href="/instatux/notifications" title="Notifications"><span class="glyphicon glyphicon-bell"></span><span id="count_nb_notif"></span>&nbsp;Notifications</a></li>
     <li><a href="/instatux/messagerie" title="Messagerie"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messagerie</a></li>
        
          

      </ul>


    

      <ul class="nav navbar-nav navbar-right">
        

        <li><?= $this->Form->create('', array('class'=>'navbar-form ','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
    

   <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
       <?= $this->Form->input('search',['type' => 'text', 'label'=>'', 'placeholder' =>'Rechercher sur Instatux', 'required','class' =>'form-control']); ?>
  
       </div>
</form>
</li>
<li><a href="/instatux/<?= $authName ;?>"><?= $this->Html->image(''.$authAvatar.'', array('alt' => 'image utilisateur', 'class'=>'img-circle', 'width'=>'15','height'=>'15')); ?></a></li>
<li><?= $this->Form->button('<span class="glyphicon glyphicon-pencil"></span>', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalTweet',
                  'class' => 'btn btn-info navbar-btn',
                  'type' => 'button']);
                  ?>    </li>
 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">...</a>


        <ul class="dropdown-menu">
          <li><a href="/instatux/settings" title="Paramètres">Paramètres</a></li>
          <li><a href="/instatux/abonnement/<?= $authName ;?>">Mes abonnements</a></li>
          <li> <a href="/instatux/abonne/<?= $authName ;?>">Mes abonnés</a></li>
          <li><a href="/instatux/demande">Mes demandes</a></li>
          <li><a href="/instatux/logout">Déconnexion</a> </li>
        </ul>    
      
</li>

      </ul>
    </div>
  </div>
</nav>

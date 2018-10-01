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
        <li><a href="/instatux/accueuil"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Actualités</a></li>

             <li><a href="/instatux/notifications" title="Notifications"><span class="glyphicon glyphicon-bell"></span><span id="count_nb_notif"></span>&nbsp;Notifications</a></li>
     <li><a href="/instatux/messagerie" title="Messagerie"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messagerie</a></li>
        
          

      </ul>


    

      <ul class="nav navbar-nav navbar-right">
        

        <li><?= $this->Form->create('', array('class'=>'navbar-form ','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
    

   <div class="input-group">

       <?= $this->Form->input('search',['id'=>'search','type' => 'text', 'label'=>'', 'placeholder' =>'Rechercher sur Instatux', 'required','class' =>'form-control']); ?>
  
           <div class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
           </div>
</form>
</li>
<li><a href="/instatux/<?= $authName ;?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Moi</a></li>
<li><?= $this->Form->button('<span class="glyphicon glyphicon-pencil"></span>', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalTweet',
                  'class' => 'btn btn-info navbar-btn',
                  'type' => 'button']);
                  ?>    </li>
 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span></a>


        <ul class="dropdown-menu">
          <li><a href="/instatux/settings">Paramètres</a></li>
          <li><a href="/instatux/abonnement/<?= $authName ;?>">Abonnements</a></li>
          <li><a href="/instatux/logout">Déconnexion</a> </li>
        </ul>    
      
</li>

      </ul>
    </div>
  </div>
</nav>

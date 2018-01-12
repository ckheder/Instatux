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
      <ul class="nav navbar-nav navbar-left">
 <li>
  <a href="/instatux/actualites" title="Actualités"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Accueil</a></li>
</ul>
       <ul class="nav navbar-nav navbar-center">
        <li>
      <?= $this->Form->create('', array('class'=>'navbar-form','url'=>array('controller'=>'search', 'action'=>'redirectsearch')));?>
 

   <div class="input-group">
       <?= $this->Form->input('search',['type' => 'text', 'label'=>'', 'placeholder' =>'Recherche...', 'required','class' =>'form-control']); ?>
  
    <div class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
     </div>
</form>
</li>
</ul>
      <div class="nav navbar-nav navbar-right">
     <?= $this->Form->button('Connexion', 
                [ 'data-toggle' => 'modal',
                  'data-target' => '#ModalConnexion',
                  'class' => 'btn btn-primary navbar-btn',
                  'type' => 'button']);
                  ?>
      
 <?= $this->Html->link('Inscription', // lien pour supprimer l'abonnement


                '/',
                [
                'title' => 'Inscription',
                'class' => 'btn btn-info navbar-btn', 
                'role' => 'button',
                'escape' => false]);
                ?>&nbsp;&nbsp;
      </div>

    </div>
  </div>
</nav>

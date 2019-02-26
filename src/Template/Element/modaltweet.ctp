
<?php
echo $this->Modal->create(['id' => 'ModalTweet', 'close'=>false]) ;
                echo $this->Modal->header('Nouveau Tweet') ;
                echo $this->Form->create('Tweet', array('id' =>'form_tweet','class'=>'form-inline','url'=>array('controller'=>'Tweet', 'action'=>'add'),'type' => 'file'));
                ?>
    
<div id="instatuxeditor">

	<div class="text-center">
		<br />
    <a class="btn btn-default" role="button" id = "btnurl" title = "Ajouter un lien"><span class="glyphicon glyphicon-globe"></span>&nbsp; Ajouter un lien</a>
		<a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-default" role="button" title = "Ajouter un média externe" data-target="#modalmedia"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp; Ajouter un média externe</a>
</div>

                <textarea id="instatuxeditor_textarea" class ="emojis-plain_editor" rows="5" name="contenu_tweet" placeholder="Publier quelque chose..." maxlength="250"></textarea>
                <h5 class="pull-right" id="textCounter">250 Caractères restants.</h5>
                
                        <div class="form-group">
  <label for="selectpic">Selectionner une photo</label>
  <input type="file" accept="image/*" name="file" id="sendpic">
</div>
<br />
<div id="previewpic" contenteditable="true">
   </div> 
      <br />        
<div class="text-center">
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Publier</button>
    		<a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-default" role="button" title = "Ajouter un média externe" data-target="#HelpModal"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a>         
</div>
                <br />
            <p id="etatnotifmodal"></p>
                <?= $this->Form->end(); ?>

                       <div id="preview" contenteditable="true">
   </div> 
<?= $this->Modal->end() ;?>

                </div>
 
<!-- modal video -->           
<div id="modalmedia" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title w-100 text-center"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp; Partager un média</h4>
      </div>
      <div class="modal-body">
      	        		<p class="alert alert-info">  
       	Coller dans le champs ci-dessous le média à partager.<br />Pour plus de renseignements sur le manière dont son traités les médias, cliquez sur le bouton d'aide. 
       	 <br />	
    </p>
        <div class="input-group">

  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
  <input type="url" class="form-control" id="media" placeholder="URL du média">

</div>
<div class="text-center">
	  <br />
 <button type="button" id="btninsertmedia" class="btn btn-default">Insérer</button>

 
</div>
<p id="etatnotifmodalmedia"></p>
      </div>
    </div>

  </div>
</div>
<!-- fin modal video -->  

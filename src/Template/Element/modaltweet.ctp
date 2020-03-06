<!--

 * modaltweet.ctp
 *
 * Fenêtre modale de création d'un nouveau tweet
 *
 */

-->
    <?php
          echo $this->Modal->create(['id' => 'ModalTweet', 'close'=>false]) ; // création modale

          echo $this->Modal->header('Nouveau Tweet') ; // header titre

          // création formulaire

          echo $this->Form->create('Tweet', array('id' =>'form_tweet','class'=>'form-inline','url'=>array('controller'=>'Tweet', 'action'=>'add'),'type' => 'file'));
                
    ?>
    
    <!-- editeur de tweet -->

      <div id="instatuxeditor">

    <!-- textarea corps du tweet -->

        <textarea id="instatuxeditor_textarea" class ="emojis-plain_editor" rows="5" name="contenu_tweet" placeholder="Publier quelque chose..." maxlength="250"></textarea>

          <a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="media-button-tweet"  title = "Ajouter un média" data-target="#modalmedia"><span class="glyphicon glyphicon-facetime-video"></span></a>

    <!-- compteur de caractère restant -->

      <h5 class="pull-right" id="textCounter">250 Caractères restants.</h5>
       
<br />

<br />

<br />
<!-- preview d'une image uploadée -->
  

        <!-- boutons de publication et d'aide -->

      <div class="text-center">

        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Publier</button>

          <a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-default" role="button" title = "Ajouter un média externe" data-target="#HelpModal"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a>  

      </div>

<br />
            <p id="etatnotifmodal"></p> <!-- résultat de la publication : réussie ou non -->

            <?= $this->Form->end(); ?> <!-- fin du formulaire -->

<!-- preview de média -->

            <div id="previewmediatweet" contenteditable="true"></div> 
   
              <?= $this->Modal->end() ;?> <!-- fermeture modale -->

            </div> <!-- fin editeur -->
 
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

            Coller dans le champs ci-dessous l'URL du média à partager ou envoyer une image depuis votre ordinateur.

        </p>

          <label for="selectpic">URL d'un média</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
              <input type="url" class="form-control" id="media" placeholder="Entrez URL...">

            </div>

             <div class="form-group">

      <label for="selectpic" id="selectpic">Selectionner une photo</label>

      <input type="file" accept="image/*" name="file" id="sendpic">

      </div>

      <hr>

            <div class="text-center">

        <button type="button" id="btninsertmedia" class="btn btn-primary">Insérer</button>

        <a data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-default" role="button" title = "Ajouter un média externe" data-target="#HelpModal"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a>

      </div>

<p id="etatnotifmodalmedia"></p> <!-- notification de réussite ou échec d'envoi de média -->

      </div>
    </div>

  </div>
</div>
<!-- fin modal video -->  

/**
 * settingsabo.js
 *
 * Partager un tweet
 *
 */


  $(document).on('click','.addshare',function() {


      var id = $(this).data("idtweet"); // identifiant du tweet

      var auteurtweet = $(this).data("auteurtweet"); // auteur du tweet

              $.ajax({
                url: '/instatux/partage/add/'+ id +'/' + auteurtweet +'',
    success: function(data){

      if(data == 'shareok'){ // partage réussi

//notification

        $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Tweet partagé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

// suppression du lien de partage

        $( '.partage[data-idtweet="' + id + '"]' ).remove();
    }
            else if(data == 'deja'){ // déjà partagé

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Vous avez déjà partagé ce contenu.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    else if(data == 'inexistant'){ //tweet inexistant

//notification

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Ce tweet n\'existe pas.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
        else if(data == 'probleme'){ // problème requete

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de partager ce tweet.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
});

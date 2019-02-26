

  // partage de tweet

  $(document).on('click','.addshare',function() {


      var id = $(this).data("idtweet");
      var auteurtweet = $(this).data("auteurtweet");

              $.ajax({
                url: '/instatux/partage/add/'+ id +'/' + auteurtweet +'',
    success: function(data){

      if(data == 'shareok'){ // partage réussi

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Tweet partagé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         $( '.sharelink[data-idtweet="' + id + '"]' ).remove();// bouton signifiant l'envoi d'une demande
    }
            else if(data == 'deja'){ // problème requete

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Vous avez déjà partagé ce contenu.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    else if(data == 'inexistant'){ // problème requete

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

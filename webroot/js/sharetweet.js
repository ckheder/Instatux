  $(document).ready(function(){

  // nouvel abonnement ou demande

      $(".addshare").click(function() {

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
        else if(data == 'problème'){ // problème requete

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
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

    }); 
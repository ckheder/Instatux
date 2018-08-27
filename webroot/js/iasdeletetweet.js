
              var ias = jQuery.ias({
  container:  '#list_tweet',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des tweets"}));
  ias.extension(new IASPagingExtension());




  // nouvel abonnement ou demande

  $(document).on('click','.deletetweet',function() {


      var id = $(this).data("idtweet");
    

              $.ajax({
                url: '/instatux/post/delete/'+ id +'',
    success: function(data){

      if(data == 'tweetsupprime'){ // partage réussi

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Tweet supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         $( '.tweet[data-idtweet="' + id + '"]' ).remove();// bouton signifiant l'envoi d'une demande
    }
        else if(data == 'echectweetsupprime'){ // problème requete

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce tweet.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});



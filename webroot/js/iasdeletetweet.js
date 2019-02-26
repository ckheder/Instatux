 // mon nom de session
              var ias = jQuery.ias({
  container:  '#list_tweet_' + currentprofil + '',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des tweets"}));
  ias.extension(new IASPagingExtension());

  // nouvel abonnement ou demande

  $(document).on('click', '.deletetweet', function(event) {

    event.preventDefault();

    var id = $(this).data("idtweet");//id du tweet à effacer
    var nb_tweet = $("#nb_tweet").text();// nombre de tweet



              $.ajax({
                url: '/instatux/post/delete/'+ id +'',
    success: function(data){

      if(data == 'tweetsupprime'){ // partage réussi

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Tweet supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         $('.tweet[data-idtweet="'+id+'"]').remove();// on efface le tweet
         
         //decremente le compteur
         nb_tweet--;
        $("#nb_tweet").empty('').prepend(nb_tweet);
        //si decrementation à zero
        if(nb_tweet == 0)
        {
          $("#list_tweet").html('<div class="alert alert-info" id="notweet">Aucun tweet à afficher</div>');
                                             
        }
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



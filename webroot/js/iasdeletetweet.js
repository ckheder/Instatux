/**
 * iasdeletetweet.js
 *
 * Suppression d'un tweet et IAS des tweets
 *
 */

 // Infinite Ajax Scroll liste des tweets et des tweets avec médias

// current profil -> profil courant, servira en JS quand on postera un nouveau tweet à bien l'afficher sur mon profil et non sur un autre profil si je tweet en visitant un autre profil

// media -> je viens de la page Media


    var ias = jQuery.ias({
                                      container:  '#list_tweet_' + currentprofil + '',
                                      item:       '.tweet',
                                      pagination: '#pagination',
                                      next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());



// effacer un tweet

  $(document).on('click', '.deletetweet', function(event) {



    event.preventDefault();

      var id = $(this).data("idtweet");//id du tweet à effacer
      var nb_tweet = $('#nb_tweet_'+ currentprofil + '').text();// nombre de tweet

              $.ajax({
                url: '/instatux/post/delete/'+ id +'',
    success: function(data){

      data = JSON.parse(data);

      if(data.reponse == 'tweetsupprime'){ // suppression réussie

// notification de succès

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Tweet supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

// suppression du tweet de la div

      $('.tweet[data-idtweet="'+id+'"]').remove();

//decremente le compteur de tweet

      nb_tweet--;

// mise à jour nombre de tweets

      $('#nb_tweet_'+ currentprofil + '').empty('').prepend(nb_tweet);

//si decrementation à zero

        if(nb_tweet == 0)
        {

          $("#list_tweet").html('<div class="alert alert-info" id="notweet">Aucun tweet à afficher</div>');
        }

//decrementation nombre de media
if(data.media == 1)
{
  var nb_media = $('#nb_media_'+currentprofil+'').text();// nombre de tweet actuel

  nb_media--;

  $('#nb_media_'+currentprofil+'').empty('').prepend(nb_media); // mise à jour nombre de tweet

  $('#list_media').load('/instatux/'+currentprofil+'/media/listmedia'); // suppression du média associé au tweet qui vient d'etre supprimé dans la cell des médias
}
    }
        else if(data.reponse == 'echectweetsupprime'){ // problème requete

//notification d'échec de suppression

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

  var update = 0; // variable de test de mise à jour de comm, par défaut ce n'est pas une mise à jour

        // node js gestion des comms

      var socket = io.connect('http://localhost:8083'); //create connection

      var room = idtweet;

      socket.on('connect', function() {
   // Connected, let's sign-up for to receive messages for this room
   socket.emit('room', room);
});

   // emoji

    $('.emojis-plain').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');

// infinite ajax scroll pour la liste des commentaire

              var ias = jQuery.ias({
  container:  '#list_comm',
  item:       '.comm',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des commentaires"}));
  ias.extension(new IASPagingExtension());

// effacer un commentaire
 $(document).on('click','.deletecomm',function() {

      var idcomm = $(this).data("idcomm");
    

              $.ajax({
                url: '/instatux/commentaire/delete/'+ idcomm +'',
    success: function(data){



      if(data == 'suppcommok'){ // suppression réussi

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Commentaire supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

         $( '.comm[data-idcomm="' + idcomm + '"]' ).remove();// suppression du comm de la div

          socket.emit('del', {idcomm: idcomm,room: room}); // évènement serveur
    }
        else if(data == 'suppcommfail'){ 


     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

      // autoriser/desactiver comm

      $(document).on('click','.allowcomm',function() {

       idtweet = $(this).data("idtweet");
      var etat = $(this).data("etat");

              $.ajax({
                url: '/instatux/allowcomment/'+ etat +'/'+ idtweet +'',
    success: function(data){



      if(data == 'commdesac'){ // commentaire désactivé

  

     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Les commentaires sont désormais désactivés.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="0" data-idtweet = "' + idtweet +'"   title="Activer les commentaires"  class="allowcomm" onclick="return false;">Activer les commentaires</a>'  ; // mise à jour  : ajout du lien activé comm
    }
        else if(data == 'commac'){ // commentaire activé


     $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Commentaire activé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="1" data-idtweet = "' + idtweet +'"   title="Désactiver les commentaires"  class="allowcomm" onclick="return false;">Désactiver les commentaires</a>'  ; // mise à jour  : ajout du lien désactivé comm
    
}
    else if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }



  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});



      var idcom; // identifiant de commentaire pour modification future

         // mise à jour du commentaire

 $(document).on('click','.updatecomm',function() {

   idcom =  $(this).data("idcom"); // on récupère l'id du comm passé en data sur le lien
// conversion des smiley dans le commentaire à modifier
var res = $($(".contenucomm" + idcom + "")[0]).text();
$( $(".contenucomm" + idcom + "  img")).each(function(index, value) {
  res = res + $(this).attr('alt');
});


   $("#comm").val(res); // on met le comm converti dans l'input du formulaire

   $(" #comm ").focus(); // focus sur l'input

    $('html, body').animate({
        scrollTop: $(" #comm ").offset().top - 60 /* 80 is height of navbar + input label */
    }, 10);

update = 1;

 });

 // fin mise à jour commentaire


    $('#form_comm').submit(function(e){

      e.preventDefault();

      if(update == 0) // nouveau comm, pas de mise à jour
      {

                moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LL'); // mise en form

      
        $.ajax({
                type: 'POST',
                url: '/instatux/commentaire/add',
                dataType: 'json',
                data: $('#form_comm').serialize(),

    success: function(data)
    {

      if(data == 'problème'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de commenter.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    else
    {

        var avatar = '/instatux/img/' + data.avatar_session; // on crée un nouveau chemin

        var avatarcomm = avatar.replace("/post", "");

        socket.emit('comm', {comm: data.comm, avatar: avatarcomm, auteurcomm: data.nom_session, tweetid: data.tweet_id,room: room}); // Transmet l'évènement au serveur, variable venant du retour controller

                //affichage pour moi

        $('#list_comm').prepend('<div class="comm" data-idcomm="' + data.id + '"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-idcomm="' + data.id +'"  title="Effacer ce commentaire"  class="deletecomm" onclick="return false;">Effacer ce commentaire</a></li><li> <a href="#" title="Modifier ce commentaire" class="updatecomm" data-idcom="' + data.id +'"  onclick="return false;">Modifier</a></li></ul></div><img src="' + avatarcomm + '"alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.nom_session +'" class="link_username_tweet">' + data.nom_session + '</a><span class="alias_tweet">@' + data.nom_session +'</span> - <span class="date_message">' + date_msg + '</span><p></p><p class="contenucomm' + data.id +'">' + data.comm +'</p></div>');

        $('#comm').val('');// on vide l'input
      }
    },

    error: function(data)
    {
                    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de commenter.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );      
    }
                
         });


    

}
else if(update == 1)
{

          $.ajax({
                type: 'POST',
                url: '/instatux/commentaire/edit/'+ idcom + '',
                dataType: 'json',
                data: $('#form_comm').serialize(),

    success: function(data)
    {

          $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;' + data.reponse + '</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

 $('.contenucomm'+ data.idcomm+'').html('' + data.comm +''); // insertion du nouveau comm

 $('.updatecomm'+ data.idcomm+'').empty(); // on supprime la mention modifié si existante

 $('.updatecomm'+ data.idcomm+'').append(' - Modifié'); // mention modifié

 socket.emit('up', {comm: data.comm, idcomm: data.idcomm,room: room});

 $('#comm').val(''); // on vide le champ


    },
    error: function(data)
    {
                          $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de commenter.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

});


          update = 0;
}
});

               // retour du server, affichage pour les autres

// nouveau commentaire

               socket.on('commentaire', function(data) {

                 $('#list_comm').prepend('<div class="comm" data-idcomm="10"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-username="' + data.auteurcomm +'" data-action="add" title="Bloquer ' + data.auteurcomm +'"  id="addblock"  onclick="return false;">Bloquer cet utlisateur</a></li><li><a href="#">Signaler ce commentaire</a></li></ul></div><img src="' + data.avatar + '"alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.auteurcomm +'" class="link_username_tweet">' + data.auteurcomm + '</a><span class="alias_tweet">@' + data.auteurcomm +'</span> - <span class="date_message">' + data.date_comm + '</span><p></p><p>' + data.comm +'</p></div>');
           
            });    
// mise à jour commentaire

          socket.on('update', function(data) {

 $('.contenucomm'+ data.idcomm+'').html('' + data.comm +''); // insertion du nouveau comm

 $('.updatecomm'+ data.idcomm+'').empty(); // on supprime la mention modifié si existante

 $('.updatecomm'+ data.idcomm+'').append(' - Modifié'); // mention modifié
           
            });


// suppression commentaire

socket.on('delete', function(data) {

$( '.comm[data-idcomm="' + data.idcomm + '"]' ).remove();

 });

// fin retour du server, affichage pour les autres
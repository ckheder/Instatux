 var update = 0; // variable de test de mise à jour de comm, par défaut ce n'est pas une mise à jour

        // node js gestion des comms

        var authname = authname; // mon nom de session

     var socket = io.connect('http://localhost:8083'); //create connection

     var room = idtweet; // identifiant du tweet en cours qui servira de room

    socket.once('connect', function() {

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



              var ias = $('#viewtweet').ias({
  container:  '#list_comm',
  item:       '.comm',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin des commentaires"}));

$('#viewtweet').on('hidden.bs.modal', function () {

  $('#viewtweet .modal-body').empty();

  //$('#viewtweet .modal-body').html('');

$('#viewtweet').ias().destroy();
      
    socket.close();


  
});

// effacer un commentaire
 $(document).on('click','.deletecomm',function(e) {

  e.stopImmediatePropagation();

      var idcomm = $(this).data("idcomm"); // identifiant du comm
    

              $.ajax({
                url: '/instatux/commentaire/delete',
                 dataType: "text json",
                type: "POST",
                data: {idtweet: idtweet, idcomm: idcomm},
    success: function(data){



      if(data == 'suppcommok'){ // suppression réussi

  

     $('#notifmodalview').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Commentaire supprimé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );


          socket.emit('delete', {idcomm: idcomm,room: room,idtweet: idtweet}); // évènement serveur indiquant une suppression



    }
        else if(data == 'suppcommfail'){ 


     $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });

});

      // autoriser/desactiver comm

      $(document).on('click','.allowcomm',function(e) {

        e.stopImmediatePropagation();

       idtweet = $(this).data("idtweet"); // identifiant du tweet sur lequel agir
      var etat = $(this).data("etat"); // etat  : activation/désactivation

              $.ajax({
                url: '/instatux/allowcomment/'+ etat +'/'+ idtweet +'',
    success: function(data){

      if(data == 'commdesac')// commentaire désactivé

      { 

     $('#notifmodalview').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Les commentaires sont désormais désactivés.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // mise à jour des liens d'action sur le tweet, uniquement pour le propriétaire du tweet

        document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="0" data-idtweet = "' + idtweet +'"   title="Activer les commentaires"  class="allowcomm" onclick="return false;">Activer les commentaires</a>'  ; // mise à jour  : ajout du lien activé comm

        socket.emit('commdesac', {room: room}); // Transmet l'évènement au serveur : désactivation des commentaires

    }
        else if(data == 'commac'){ // commentaire activé


     $('#notifmodalview').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Commentaire activé.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        // mise à jour des liens d'action sur le tweet, uniquement pour le propriétaire du tweet

         document.getElementById('actioncomment').innerHTML = '<a href="#" data-etat="1" data-idtweet = "' + idtweet +'"   title="Désactiver les commentaires"  class="allowcomm" onclick="return false;">Désactiver les commentaires</a>'  ; // mise à jour  : ajout du lien désactivé comm

        socket.emit('commac', {room: room}); // Transmet l'évènement au serveur : Activation des commentaires

}
    else if(data == 'problème'){

     $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Problème lors du traitement de votre demande.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

  },
    error: function(data)
    {
            $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer ce commentaire.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
});

      var idcom; // identifiant de commentaire pour modification future

         // mise à jour du commentaire

 $(document).on('click','.updatecomm',function(e) {

  e.stopImmediatePropagation();

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

update = 1; // on signal une mise à jour du commentaire

 });

 // fin mise à jour commentaire

    $('#form_comm').submit(function(e){

      e.preventDefault();

      if(update == 0) // nouveau comm, pas de mise à jour
      {

                moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LLL'); // mise en form

      
        $.ajax({
                type: 'POST',
                url: '/instatux/commentaire/add',
                dataType: 'json',
                data: $('#form_comm').serialize(),

    success: function(data)
    {

            if(data == 'commdesac'){ // les commentaires sont désactivés

     $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Les commentaires sont désactivés pour cette publication.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
      else if(data == 'probleme'){

     $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de commenter.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
    else
    {

        // évènement serveur de création d'un nouveau commentaires

        socket.emit('comm', {comm: data.comm, auteurcomm: data.nom_session, tweetid: data.tweet_id,room: room, auteurtweet: data.auttweet, idcomm: data.id});

        // affichage spécifique pour l'auteur du comm

                   var nb_comm = $('.viewnbcomm_' + data.tweet_id +'').text();// nombre de commentaire
        nb_comm++;
           
$('.viewnbcomm_' + data.tweet_id +'').empty('').prepend(nb_comm); // mise à jour du nombre de commentaire dans la modal

$('.profilnbcomm_' + data.tweet_id +'').empty('').prepend(nb_comm); // mise à jour du nombre de commentaire sur le profil

        $('#list_comm').prepend('<div class="comm" data-idcomm="' + data.id + '"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-idcomm="' + data.id +'"  title="Effacer ce commentaire"  class="deletecomm" onclick="return false;">Effacer ce commentaire</a></li><li> <a href="#" title="Modifier ce commentaire" class="updatecomm" data-idcom="' + data.id +'"  onclick="return false;">Modifier</a></li></ul></div><img src="/instatux/img/avatar/' + data.nom_session + '.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.nom_session +'" class="link_username_tweet">' + data.nom_session + '</a><span class="alias_tweet">@' + data.nom_session +'</span> - <span class="date_message">' + date_msg + '<span class="updatecomm' + data.id +'"></span></span><p></p><p class="contenucomm' + data.id +'">' + data.comm +'</p></div>');

        $('#comm').val('');// on vide l'input


      }
    },

    error: function()
    {
                    $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;erreur ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );      
    }
                
         });
}
else if(update == 1) // mise à jour de comm
{

          $.ajax({
                type: 'POST',
                url: '/instatux/commentaire/edit/'+ idcom + '',
                dataType: 'json',
                data: $('#form_comm').serialize(),

    success: function(data)
    {

          $('#notifmodalview').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;' + data.reponse + '</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

 socket.emit('up', {comm: data.comm, idcomm: data.idcomm,room: room}); // émission d'un évènement annonçant une mise à jour de commentaire

 $('#comm').val(''); // on vide le champ


    },
    error: function(data)
    {
                          $('#notifmodalview').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de commenter.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

});
          update = 0;
}
});

// retour du server

// nouveau commentaire

               socket.on('commentaire', function(data) {


                   var nb_comm = $('.viewnbcomm_' + data.tweetid +'').text();// nombre de commentaire
        nb_comm++;
           
$('.viewnbcomm_' + data.tweetid +'').empty('').prepend(nb_comm); // mise à jour du nombre de commentaire


if(data.auteurtweet == authname) // le propriétaire du tweet reçoit les droits de gérer le comm posté
{
  $('#list_comm').prepend('<div class="comm" data-idcomm="' + data.idcomm +'"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-idcomm="' + data.idcomm +'"  title="Effacer ce commentaire"  class="deletecomm" onclick="return false;">Effacer ce commentaire</a></li><li><a href="#" data-username="' + data.auteurcomm +'" data-action="add" title="Bloquer ' + data.auteurcomm +'"  id="addblock"  onclick="return false;">Bloquer cet utlisateur</a></li><li><a href="#">Signaler ce commentaire</a></li></ul></div><img src="/instatux/img/avatar/' + data.auteurcomm + '.jpg"alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.auteurcomm +'" class="link_username_tweet">' + data.auteurcomm + '</a><span class="alias_tweet">@' + data.auteurcomm +'</span> - <span class="date_message">' + data.date_comm + '<span class="updatecomm' + data.idcomm +'"></span></span><p></p><p class="contenucomm'+ data.idcomm+'">' + data.comm +'</p></div>');
}
else // les autres connectés à la page
{

$('#list_comm').prepend('<div class="comm" data-idcomm="' + data.idcomm +'"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-username="' + data.auteurcomm +'" data-action="add" title="Bloquer ' + data.auteurcomm +'"  id="addblock"  onclick="return false;">Bloquer cet utlisateur</a></li><li><a href="#">Signaler ce commentaire</a></li></ul></div><img src="/instatux/img/avatar/' + data.auteurcomm + '.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.auteurcomm +'" class="link_username_tweet">' + data.auteurcomm + '</a><span class="alias_tweet">@' + data.auteurcomm +'</span> - <span class="date_message">' + data.date_comm + '<span class="updatecomm' + data.idcomm +'"></span></span><p></p><p class="contenucomm'+ data.idcomm+'">' + data.comm +'</p></div>');
  }         
            });    
// mise à jour commentaire

          socket.on('update', function(data) {

 $('.contenucomm'+ data.idcomm +'').html('' + data.comm +''); // insertion du nouveau comm

 $('.updatecomm'+ data.idcomm +'').empty(); // on supprime la mention modifié si existante

 $('.updatecomm'+ data.idcomm +'').prepend(' - Modifié'); // mention modifié
           
            });


// suppression commentaire

socket.on('delete', function(data) {

           var nb_comm = $('.viewnbcomm_' + data.idtweet).text();// nombre de commentaire

        nb_comm--;
           
$('.viewnbcomm_' + data.idtweet).empty('').prepend(nb_comm); // mise à jour du nombre de commentaire

$('.comm[data-idcomm="' + data.idcomm + '"]').remove(); // suppression du comm

$('.profilnbcomm_' + data.idtweet +'').empty('').prepend(nb_comm); // mise à jour du nombre de commentaire sur le profil

 });

//comm desactivé , affichage pour tous

socket.on('commdesac', function() {

document.getElementById('comm').disabled = true;

document.getElementById('allowcomment').innerHTML = '<div class="alert alert-danger">Les commentaires sont désactivés pour cette publication.</div>'  ; // mise à jour  : ajout du lien activé comm

 });
//fin comm desactivé , affichage pour tous

//comm activé , affichage pour tous
socket.on('commac', function() {
       
    //activation de l'input
document.getElementById('comm').disabled = false;

$("#allowcomment").empty();

 });
//comm activé , affichage pour tous
// fin retour du server


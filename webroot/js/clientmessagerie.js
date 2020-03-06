/**
 * clientmessagerie.js
 *
 * Gestion des actions en rapport avec les messages couplés avec Node JS
 *

 */

//emoji

    $('.emojis-plain').emojiarea({wysiwyg: false});

    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});

    var $wysiwyg_value = $('#emojis-wysiwyg-value');

    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');

// Infinite Ajax Scroll

    var ias = jQuery.ias({
                            container:  '#list_conv',
                            item:       '.messagemoi',
                            pagination: '#pagination',
                            next:       '.next'
                          });

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());

//recherche pour ajouter quelqu'un

        $(function() 
      {

    $( "#adduser" ).autocomplete({

                                    minLength: 1,

                                    source:'/instatux/search/searchusers',

response: function(event, ui) {
  
                                if (!ui.content.length) {

                                                          var noResult = { value:"",label:"Aucun résultats" };
                   
                                                          ui.content.push(noResult); 
                  
                                                        }
                              },

      })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {

            if(item.value == '')
          {

            return $ ( "<li>&nbsp;Aucune suggestion trouvée</li>" ).appendTo( ul );

          }
            else
          {

            return $( "<li><div class=\"test\"><img src='/instatux/img/avatar/"+item.value+".jpg'>&nbsp;"+item.value+"<span class=\"alias_tweet_search\">@"+item.value+"</span></div></li>" ).appendTo( ul );

          }
      };

});

  //connexion serveur

  var socket = io.connect('http://localhost:8082'); //create connection

  socket.emit('connexion', {authname,room}); // on transmet mon username et la room

 //affichage du message d'un nouvel arrivant

                socket.on('join', function (data)
              {

                $('#list_conv').prepend('<div class="messageinfo"><img src="img/avatar/' + data.authname + '.jpg" alt="image utilisateur" class="img-thumbail right"/><a href="/instatux/' + data.authname + '" class="link_username_tweet">' + data.authname + '</a> à rejoint la conversation.</div>');
              }

                );

  //affichage d'un message indiquant qu'un utilisateur est parti

                socket.on('leave', function (data)
              {

                $('#list_conv').prepend('<div class="messageinfo"><img src="img/avatar/' + data.authname + '.jpg" alt="image utilisateur" class="img-thumbail right"/><a href="/instatux/' + data.authname + '" class="link_username_tweet">' + data.authname + '</a> à quitté la conversation.</div>');
              }

                  );            

  //évènement de l'utilisateur en train de taper uniquement en duo

                if(typeconv === 'duo')
              {

  // détecte si mon destinataire est en train de taper

                  $('#message').keypress(function () 
                {

                  socket.emit('start-typing', {room: room, authname: authname});

                });

  //detecte quand mon destinataire à fini de taper

                $('#message').keyup(function () 
              {

                setTimeout(function () {

                                          socket.emit('stop-typing', {room: room, authname: authname});

                                        }, 3500);

              });

    socket.on('update-typing', function (data) {

                    if(data.etattype === 1) // utilisateur en train d'ecrire
                  {

                    $('#etattype').empty();

                    $('#etattype').prepend('<span class="glyphicon glyphicon-pencil blue" style="vertical-align:center"></span>&nbsp;' + data.authname + ' est en train d\'écrire...</span>');
                  }
                    else
                  {
                    $('#etattype').empty();
                  }
});

}

// retour du server, affichage message pour mon destinataire

      socket.on('messagerepondu', function(data) 

    {

      $('#list_conv').prepend('<div class="messagemoi"><img src="img/avatar/' + data.authname + '.jpg" alt="image utilisateur" class="img-thumbail right"/><a href="/instatux/' + data.authname + '" class="link_username_tweet">' + data.authname + '</a><span class="datemessage">' + data.date + '</span>' + data.message +'</div>');

    })

// envoi du message en appuyant sur "Entrée"

$("#message").keypress(function(e) {

  if (e.which == 13) {

                        $('#form_message').submit();
                    }
});



//envoi message

    $('#form_message').submit(function(e){

      e.preventDefault();

      $.ajax({
                type: 'POST',
                contentType: false,
                url: '/instatux/message/add',
                dataType: 'json',
                data: new FormData(this),
                processData: false,

    success: function(data){

        if(data == 'blocage') // je suis bloqué par mon destinataire
      {

//affichage d'une notification

            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Cet utilisateur vous à bloqué, vous ne pouvez lui pas lui envoyer de message.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }
        else if(data == 'probleme')
      {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible d\'envoyer votre message.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }
        else
      {
        socket.emit('message', {message: data.message,room: room, authname: authname}); // Transmet le message aux autres

        // on vide les champs

        $('#message').val('');

        $('#previewmediamess').empty('');

        $('.temppic').remove();
      }
    },
    error: function()
    {

    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible d\'envoyer votre message ajax.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
    });

//envoi et retour d'une invitation à rejoindre une conversation

 $('#adduserconv').submit(function(e){

      e.preventDefault();

      $.ajax({
                type: 'POST',
                contentType: false,
                url: '/instatux/conversation/adduser',
                dataType: 'json',
                data: new FormData(this),
                processData: false,

    success: function(data){

//on vide les champs

        $('#adduser').val('');

        $('#modaladdconv').modal('hide');

        if(data == 'dejain') // cette personne fais déjà partie de la conversation
      {

          //affichage d'une notification

            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Cet utilisateur est déjà dans la conversation.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }

        else if(data == 'invitok') // envoi d'invitation réussie
      {

        document.getElementById("typeconve").setAttribute("value", "multiple"); // la conversation devient multiple
            
            $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok-sign green" style="vertical-align:center"></span>&nbsp;Invitation envoyée.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }
        else if(data == 'probleme')
      {
            
            $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok-sign green" style="vertical-align:center"></span>&nbsp;Impossible d\'inviter cette personne.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
      }

    },
    error: function()
    {

      $('#adduser').val('');
      
      $('#modaladdconv').modal('hide');

    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Un problème technique est survenu, veuillez réessayer.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
    });



 
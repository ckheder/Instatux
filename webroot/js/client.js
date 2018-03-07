var socket = io.connect('http://localhost:8082'); //create connection

 socket.emit('connexion', {authname, destinataire});

// Quand on reçoit un message, on l'insère dans la page

            $('#form_message').submit(function () {

                var message = $('#message').val();

                var avatar = $('#avatar').val(); // champs caché contenant l'avatar

                socket.emit('message', {message: message, avatar: avatar}); // Transmet le message aux autres
                 
            });
            // etat connexion destinataire

                 socket.on('destinataireco', function(data) {

                  if(data.destinataireco === 1)
                  {

                    $('#etatco').empty();

                 $('#etatco').prepend('<p class="text-success"><span class="glyphicon glyphicon-user green" style="vertical-align:center"></span>&nbsp;' + destinataire + ' est connecté(e).</span></p>');
               }
               else
               {
                $('#etatco').empty();

                  $('#etatco').prepend('<p class="text-danger"><span class="glyphicon glyphicon-user red" style="vertical-align:center"></span>&nbsp;' + destinataire + ' est déconnecté(e).</span></p>');
                
                }

              });

            // detetction saisie

            $('#message').keypress(function () {

    socket.emit('start-typing');

});

$('#message').keyup(function () {

  setTimeout(function () {

      socket.emit('stop-typing');
}, 3500);

  });

socket.on('update-typing', function (data) {


                  if(data.etattype === 1) // utilisateur en train d'ecrire
                  {

  $('#etattype').empty();

                  $('#etattype').prepend('<span class="glyphicon glyphicon-pencil blue" style="vertical-align:center"></span>&nbsp;' + destinataire + ' est en train d\'écrire...</span>');
}
               else
               {
                $('#etattype').empty();
                
                }
});

  

             // retour du server
               socket.on('messagerepondu', function(data) {

                 $('#list_conv').prepend('<div class="messagemoi other"><img src="' + data.avatar + '"alt="image utilisateur" class="img-thumbail right"/><p>' + data.message +'</p><span class="date_message">' + data.date + '</span></div>');

            })


    $('.emojis-plain').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');

var socket = io.connect('http://localhost:8082'); //create connection

 socket.emit('connexion', {authname, destinataire,room});

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

    socket.emit('start-typing', {room: room});

});

$('#message').keyup(function () {

  setTimeout(function () {

      socket.emit('stop-typing', {room: room});
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

  

             // retour du server, message pour mon destinataire
               socket.on('messagerepondu', function(data) {

                 $('#list_conv').prepend('<div class="messagemoi other"><img src="' + data.avatar + '"alt="image utilisateur" class="img-thumbail right"/><p>' + data.message +'</p><span class="date_message">' + data.date + '</span></div>');

            })

$("#message").keypress(function(e) {
if (e.which == 13) {

  $('#form_message').submit();
  }
});

    $('#form_message').submit(function(e){

      e.preventDefault();
      
          moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LLL'); // mise en forme
        $.ajax({
                type: 'POST',
                url: '/instatux/message/add',
                dataType: 'json',
                data: $('#form_message').serialize(),
    success: function(data){

                $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;&nbsp;Message envoyé</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

        socket.emit('message', {message: data.message, avatar: data.avatar_session,room: room}); // Transmet le message aux autres
    
     $('#list_conv').prepend('<div class="messagemoi"><img src="img/' + data.avatar_session + '"alt="image utilisateur" class="img-thumbail"/><p>' + data.message +'</p><span class="date_message">' + date_msg + '</span></div>');

$('#message').val('');

    },
    error: function(data)
    {
                                 $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible d\'envoyer votre message.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
    });
  

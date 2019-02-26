    $('.emojis-plain').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');

                  var ias = jQuery.ias({
  container:  '#list_conv',
  item:       '.messagemoi',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin de la conversation"}));
  ias.extension(new IASPagingExtension());

  //delete conversation
$(document).on('click','#deleteconv',function() {

      var idconv = $(this).data("idconv"); // personne à bloquer/débloquer

              $.ajax({
                url: '/instatux/conversation/delete/'+ idconv +'',
    success: function(data){



      if(data == 'suppconvok'){ // blocage réussi

        var url = 'http://localhost/instatux/messagerie';
    
        window.location.href = url;

         
    }

        else if(data == 'suppconvfail'){

     $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
        
  },
    error: function(data)
    {
            $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible de supprimer cette conversation.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
   })
   });
   // fin bloquer

 
  //connexion serveur

var socket = io.connect('http://localhost:8082'); //create connection

 socket.emit('connexion', {authname, destinataire,room});

            // etat connexion destinataire

                 socket.on('destinataireco', function(data) {

                  if(data.destinataireco === 1)
                  {

                    $('#etatco').empty();

                 $('#etatco').prepend('<span class="green">connecté(e).</span>');
               }
               else
               {
                $('#etatco').empty();

                  $('#etatco').append('<span class="red">déconnecté(e).</span>');
                
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

                 $('#list_conv').prepend('<div class="messagemoi other"><img src="img/avatar/' + destinataire + '.jpg" alt="image utilisateur" class="img-thumbail right"/>' + data.message +'<span class="datemessage">' + data.date + '</span></div>');

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

      if(data == 'blocage')
      {
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
        socket.emit('message', {message: data.message,room: room}); // Transmet le message aux autres
      
    
     $('#list_conv').prepend('<div class="messagemoi"><img src="img/avatar/' + authname + '.jpg" alt="image utilisateur" class="img-thumbail"/>' + data.message +'<span class="datemessage">' + date_msg + '</span></div>');

$('#message').val('');
}
    },
    error: function()
    {

    $('#etatnotif').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Impossible d\'envoyer votre message.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
    }
                
         });
    });
  

var socket = io.connect('http://localhost:8083'); //create connection

// Quand on reçoit un message, on l'insère dans la page

            $('#form_comm').submit(function () {

                var comm = $('#comm').val();

                var avatar = $('#avatar').val(); // champs caché contenant l'avatar

                var auteurcomm = $('#auteurcomm').val(); // champs caché contenant l'avatar

                socket.emit('comm', {comm: comm, avatar: avatar, auteurcomm: auteurcomm}); // Transmet le message aux autres
                 
            });


  

             // retour du server
               socket.on('commentaire', function(data) {

                 $('#list_comm').prepend('<div class="comm"><img src="' + data.avatar + '"alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.auteurcomm +'" class="link_username_tweet">' + data.auteurcomm + '</a><span class="alias_tweet">@' + data.auteurcomm +'</span> - <span class="date_message">' + data.date_comm + '</span><p></p><p>' + data.comm +'</p></div>');

            })

    $(document).ready(function() {

            $("#comm").keypress(function(e) {
        if (e.which == 13) {

    $('#form_comm').submit(function(e){

      e.preventDefault();
      
          moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LL'); // mise en forme
        $.ajax({
                type: 'POST',
                url: '/instatux/commentaire/add',
                dataType: 'json',
                data: $('#form_comm').serialize(),
    success: function(data){

          var avatar = '/instatux/img/' + data.avatar_session;

    var avatarcom = avatar.replace("/post", "");
    
     $('#list_comm').prepend('<div class="comm"><img src="' + avatarcom + '"alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/' + data.nom_session +'" class="link_username_tweet">' + data.nom_session + '</a><span class="alias_tweet">@' + data.nom_session +'</span> - <span class="date_message">' + date_msg + '</span><p></p><p>' + data.comm +'</p></div>');

$('#comm').val('');


    },
    error: function(data)
    {
        alert('fail');       
    }
                
         });

    });
    }
   });
    });




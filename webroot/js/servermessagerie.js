var  server = require('http').createServer(server),

    io = require('socket.io').listen(server),

    fs = require('fs');

    moment = require('moment'); // librairie js pour la manipulation de date

    moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LLL'); // mise en forme

var users = [];// tableau contenant les users connecté

var destinataireco;

var etattype;


  

// connexion / déconnexion
io.sockets.on('connection', function (socket) {

    socket.on('connexion', function(data) {

      socket.join(data.room);

        var destinataire = data.destinataire;

       // ajout du nouveau connecté

       users.push(data.authname);

       // test si l'autre est connecté


        var destinataireIndex = users.indexOf(data.destinataire);

      if (destinataireIndex == -1) 
      {
         destinataireco = 0; //destinataire deconnecté
      }
      else
      {
         destinataireco = 1; //destinataire connecté
    
      }
      
        io.sockets.in(data.room).emit('destinataireco', {destinataireco: destinataireco}); // renvoi aux autres et à moi
    
       // déconnexion

        socket.on('disconnect', function(){ 

          var userIndex = users.indexOf(data.authname);

      if (userIndex !== -1) //  -1 => pas de résultat 
      {
        users.splice(userIndex, 1); // je me supprime de la liste des connectés
        destinataireco = 0; //destinataire deconnecté
             io.sockets.in(data.room).emit('destinataireco', {destinataireco: destinataireco}); 
      }

       

  })

    });

// reception evenement ecriture en cours

  socket.on('start-typing', function (data) {

    etattype = 1; // en train d'ecrire

    socket.broadcast.in(data.room).emit('update-typing', {etattype: etattype});
  });

    socket.on('stop-typing', function (data) {

         etattype = 0; // en train d'ecrire

    socket.broadcast.in(data.room).emit('update-typing', {etattype: etattype});
  });


// renvoi du message

  socket.on('message', function (data) {

    var avatar = '/instatux/img/' + data.avatar;

        socket.broadcast.in(data.room).emit('messagerepondu', {message: data.message, avatar: avatar,date: date_msg}); // renvoi aux autres et pas à moi
    }); 


});

server.listen(8082);


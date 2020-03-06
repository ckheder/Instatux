/**
 * servermessagerie.js
 *
 * Configuration du serveur Node JS  pour la messagerie
 *
 */

// création serveur

    var  server = require('http').createServer(server),

    io = require('socket.io').listen(server),

    fs = require('fs');

// configuration Moment.JS pour la manipulation de date

    moment = require('moment');

    moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_msg = date_format.format('LLL'); // mise en forme

var etattype;

var authname;

// connexion / déconnexion

io.on('connection', function (socket) {

    socket.on('connexion', function(data) {

         socket.join(data.room);

  //affichage d'un message à l'arrivée d'un nouveau

  socket.broadcast.in(data.room).emit('join', {authname: data.authname});

// déconnexion

           socket.on('disconnect', function(){ 

          socket.broadcast.in(data.room).emit('leave', {authname: data.authname});

  });

 });

// reception evenement ecriture en cours

  socket.on('start-typing', function (data) {

    etattype = 1; // en train d'ecrire

    socket.broadcast.in(data.room).emit('update-typing', {etattype: etattype, authname: data.authname});


  });

    socket.on('stop-typing', function (data) {

         etattype = 0; // plus en train d'écrire

    socket.broadcast.in(data.room).emit('update-typing', {etattype: etattype, authname: data.authname});
  });


// renvoi du message

  socket.on('message', function (data) {

        io.sockets.in(data.room).emit('messagerepondu', {message: data.message, date: date_msg, authname: data.authname}); // renvoi aux autres et pas à moi
    }); 
   });
server.listen(8082);


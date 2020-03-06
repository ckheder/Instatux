
/**
 * servercommentaire.js
 *
 * Configuration du serveur Node JS  de gestion des commentaires
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
    
    var date_comm = date_format.format('LL'); // mise en forme


// connexion / déconnexion

io.on('connection', function (socket) {

    //console.log('user connected');

    socket.on('room', function(room) {

        socket.join(room);
});

// renvoi du commentaire à la room

  socket.on('comm', function (data) {

        socket.broadcast.in(data.room).emit('commentaire', {idcomm: data.idcomm, auteurcomm: data.auteurcomm, comm: data.comm, date_comm: date_comm, tweetid: data.tweetid, auteurtweet: data.auteurtweet});

    }); 

// renvoi aux autres et pas à moi d'une modification de commentaire

  socket.on('up', function (data) {

        io.to(data.room).emit('update', {comm: data.comm, idcomm: data.idcomm});

    });

//renvoi suppression aux autres

    socket.on('delete', function (data) {

        io.to(data.room).emit('delete', {idcomm: data.idcomm, idtweet: data.idtweet});

    }); 

// renvoi désactivation des commentaires aux autres

    socket.on('commdesac', function (data) {

        io.to(data.room).emit('commdesac');

        console.log('desactivation');

    }); 

// renvoi activation commentaire aux autres

    socket.on('commac', function (data) {

        io.to(data.room).emit('commac');

    }); 

// déconnexion

    socket.on('disconnect', function(){

        socket.removeAllListeners();

        socket.disconnect(true);
     
    //console.log('user disconnected', socket.id);
  });

});

server.listen(8083);



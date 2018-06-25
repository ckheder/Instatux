var  server = require('http').createServer(server),

    io = require('socket.io').listen(server),

    fs = require('fs');

    moment = require('moment'); // librairie js pour la manipulation de date

    moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_comm = date_format.format('LL'); // mise en forme

var users = [];// tableau contenant les users connecté
  

// connexion / déconnexion
io.sockets.on('connection', function (socket) {

    socket.on('room', function(room) {
        socket.join(room);
});

// renvoi du commentaire

  socket.on('comm', function (data) {


        socket.broadcast.in(data.room).emit('commentaire', {auteurcomm: data.auteurcomm, comm: data.comm, avatar: data.avatar, date_comm: date_comm, tweetid: data.tweetid});

    }); 

  socket.on('up', function (data) {

        socket.broadcast.in(data.room).emit('update', {comm: data.comm, idcomm: data.idcomm}); // renvoi aux autres et pas à moi d'une modification de commentaire

    }); 

    socket.on('del', function (data) {

        socket.broadcast.in(data.room).emit('delete', {idcomm: data.idcomm}); // renvoi aux autres et pas à moi d'une suppression de commentaire

    }); 



});

server.listen(8083);



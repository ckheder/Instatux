var  server = require('http').createServer(server),

    io = require('socket.io').listen(server),

    fs = require('fs');

    moment = require('moment'); // librairie js pour la manipulation de date

    moment.locale('fr'); // date en français

    var date_format = moment(); // date actuelle
    
var date_comm = date_format.format('LL'); // mise en forme
  

// connexion / déconnexion
io.sockets.on('connection', function (socket) {

// renvoi du commentaire

  socket.on('comm', function (data) {

    var avatar = '/instatux/img/' + data.avatar;

    var avatarcomm = avatar.replace("/post", "");

        socket.broadcast.emit('commentaire', {auteurcomm: data.auteurcomm, comm: data.comm, avatar: avatarcomm, date_comm: date_comm}); // renvoi aux autres et pas à moi
    }); 


});

server.listen(8083);



/**
 * iastweetoffline.js
 *
 * Infinite Ajax Scroll view tweets sur la page d'accueil des personnes non connectées et vidage de la modal à la fermeture
 *
 */

              var ias = $('#viewtweet').ias({
  												container:  '#list_comm',
  												item:       '.comm',
  												pagination: '#pagination',
  												next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());

    $('#viewtweet').on('hidden.bs.modal', function () {

  $('#viewtweet .modal-body').empty();

    $('#viewtweet').ias().destroy();
      
  socket.close();

});

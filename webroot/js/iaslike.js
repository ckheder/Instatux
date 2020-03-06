/**
 * deleteconv.js
 *
 * Infinite Ajax Scroll nombre de like sur viewtweet
 *
 */

              var ias = $('#viewlike').ias({
                                            container:  '#list_like',
                                            item:       '.liste_like',
                                            pagination: '#paginations',
                                            next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());

// A la fermeture de la modal like, on vide son contenu et détruit la session IAS

  $('#viewlike').on('hidden.bs.modal', function () {

      $('#viewlike .modal-body').empty();

      $('#viewlike').ias().destroy();
 
});
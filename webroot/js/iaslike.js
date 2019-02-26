// ias nombre de like sur viewtweet

              var ias = $('#viewlike').ias({
  container:  '#list_like',
  item:       '.liste_like',
  pagination: '#paginations',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin de liste"}));
  ias.extension(new IASPagingExtension());

  $('#viewlike').on('hidden.bs.modal', function () {

  $('#viewlike .modal-body').empty();

$('#viewlike').ias().destroy();
      
 
});
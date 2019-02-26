
              var ias = jQuery.ias({
  container:  '#list_actu_online',
  item:       '.tweet',
  pagination: '#pagination',
  next:       '.next'
});


  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 2}));
  ias.extension(new IASNoneLeftExtension({text: "Fin de l'actualité"}));
  ias.extension(new IASPagingExtension());
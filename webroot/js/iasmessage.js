
              var ias = jQuery.ias({
  container:  '#list_conv',
  item:       '.messagemoi',
  pagination: '#pagination',
  next:       '.next'
});
  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASNoneLeftExtension({text: "Fin de la conversation"}));
  ias.extension(new IASPagingExtension());

/**
 * onlinenews.js
 *
 * Infinite Ajax Scroll des tweets sur la page d'actualités online
 *
 */
              var ias = jQuery.ias({
  										container:  '#list_actu_online',
  										item:       '.tweet',
  										pagination: '#pagination',
  										next:       '.next'
});

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());
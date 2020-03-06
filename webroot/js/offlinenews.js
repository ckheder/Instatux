/**
 * offlinenews.js
 *
 * Infinite Ajax Scroll des tweets sur la page d'actualités offline
 *
 */

                     var ias = jQuery.ias({
  											container:  '#list_actu_offline',
  											item:       '.tweet',
  											pagination: '#pagination',
  											next:       '.next'
});

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASPagingExtension());







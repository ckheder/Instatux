
/**
 * screen.js
 *
 * Mise en place de la colonne des suggestion au dessus des tweets lors d'un redimensionnement
 *
 */

 $(document).ready(function(){

  	$(window).resize(function(){

      // dans le cas d'une résolution supérieure à 320 et inférieure à 767

      if($(this).width()>320 && $(this).width()<767)
    {
      // on change la position de la div suggestion

          $('#suggestion').insertAfter('#myTab'); // accueil

          $('#suggestion').insertAfter('#list_media'); // profil
		}


   // dans le cas d'une résolution supérieure à 767 et inférieure à 991 , on change la position des div de droite vers la gauche

      if($(this).width()>767 && $(this).width()<991)
    {

        $('#suggestion').insertAfter('#myTab'); // accueil

        $('#suggestion').insertAfter('#list_media'); // profil

        $('#statut_notif').insertAfter('#option_notif'); // notification

    }

        }
    )
})

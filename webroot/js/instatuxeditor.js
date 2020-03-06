/**
 * instatuxeditor.js
 *
 * Création d'un tweet
 *
 */

// empecher le decalage du body a la fermeture des modals

$(document).ready(function () {
    $('#modalmedia').on('show.bs.modal', function () {

      $("#sendpic").val('');
        $('#ModalTweet').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

    $('#modalmedia').on('hidden.bs.modal', function () {
        $('#ModalTweet').css('z-index', 1041); //bring back the first modal overlay to it's normal state when 2nd modal closed
        $('body').addClass('modal-open'); // add `modal-open` class back to body when 2nd modal close so first modal will be scrollable
    });

                        $('#HelpModal').on('show.bs.modal', function () {
        $('#modalmedia').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

                $('#HelpModal').on('hidden.bs.modal', function () {
        $('#modalmedia').css('z-index', 1041); //this will push the first modal overlay behind second modal overlay
        $('body').addClass('modal-open');
    });
});

//limite textarea à 250 caractères

$('#instatuxeditor_textarea').on("input", function(){

    var maxlength = $(this).attr("maxlength"); // 250 caractères
    var currentLength = $(this).val().length;

      if( currentLength >= maxlength )
    {
        $('#textCounter').text("Maximum de caractères atteints.");
    }
      else
    {
        $('#textCounter').text(maxlength - currentLength + " caractère(s) restant(s)");
    }
});

// fin limite textarea

//emoji

    $('.emojis-plain_editor').emojiarea({wysiwyg: false});

    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});

    var $wysiwyg_value = $('#emojis-wysiwyg-value');

    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });

    $wysiwyg.trigger('change');

//fin emoji

//insérer "{Url}Collez ici le lien{/Url}" à l'endroit ou se trouve le curseur de la souris au click sur "#btnurl"

$('#btnurl').on('click', function(e)
{
 e.preventDefault();
    _insertAtCaret($('#instatuxeditor_textarea'), '{Url}Collez ici le lien{/Url} ');
});

function _insertAtCaret(element, text) {
    var caretPos = element[0].selectionStart,
        currentValue = element.val();

    element.val(currentValue.substring(0, caretPos) + text + currentValue.substring(caretPos));
}


var preview;
var editor; // contenu actuel de l'editor
var area;

// vidéo Youtube,Vimeo,Dailymotion,Twitch
$('#btninsertmedia').on('click', function()
{

  // insertion d'un média externe

var urlmedia = $('#media').val();

var idvideo; // pour youtube,vimeo,dailymotion


    if($('#ModalTweet').hasClass('in'))
  {
      preview = 'previewmediatweet';
      editor, area = 'instatuxeditor_textarea';
  }
    else
  {
      preview = 'previewmediamess';
      editor,area = 'message';
  }

// test du champ vide
if (urlmedia.length > 0) {

// pattern de recherche

  // youtube
  var pattern_youtube = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
  //dailymotion
  var pattern_dailymotion = /^(?:(?:https?):)?(?:\/\/)?(?:www\.)?(?:(?:dailymotion\.com(?:\/embed)?\/video)|dai\.ly)\/([a-zA-Z0-9]+)(?:_[\w_-]+)?$/;
  // twitch clip
  var pattern_twitch_clip = /http(s)?:\/\/(clips\.)?twitch.tv\/((\w|-){11})(?:\S+)/;
  //twitch video
  var pattern_twitch_video = /http(s)?:\/\/(www\.)?twitch.tv\/videos\/((\w|-){8})(?:\S+)/;
  //instagram image
  var pattern_instagram = /http(s)?:\/\/(www\.)?instagram.com\/p\/((\w|-){11})(?:\S+)/;
  //image externe
  var pattern_ext_image = /([-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?(?:jpg|jpeg|gif|png))/gi;
  

// fin pattern de recherche

  if (pattern_youtube.test(urlmedia)) { // vidéo youtube

    idvideo = YouTubeGetID(urlmedia); // récupération de l'id de la vidéo

    editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

    // ajout de la vidéo

    $('#' + area + '').val(editor + '[videoYoutube]'+idvideo+'[/videoYoutube] ');

    //preview

    $('#' + preview + '').html('<iframe src="//www.youtube.com/embed/'+idvideo+'"  width="100%" height="360" frameborder="0"></iframe>');

    }
        else if(pattern_dailymotion.test(urlmedia)) // video dailymotion
    {

        idvideo = DailymotionGetID(urlmedia); // récupération de l'id de la vidéo

        editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

        // ajout de la vidéo

        $('#' + area + '').val(editor + '[videoDailymotion]'+idvideo+'[/videoDailymotion] ');

        //preview

        $('#' + preview + '').html('<iframe frameborder="0" width="100%" height="360" src="//www.dailymotion.com/embed/video/'+idvideo+'" allowfullscreen></iframe>');



    }
            else if(pattern_twitch_clip.test(urlmedia))// clip twitch
    {

         var idClip = TwitchGetID(urlmedia); // récupération de l'id de la vidéo

        editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

        // ajout de la vidéo

        $('#' + area + '').val(editor + '[clipTwitch]'+idClip+'[/clipTwitch] ');

        //preview

        $('#' + preview + '').html('<iframe src="https://clips.twitch.tv/embed?autoplay=false&clip='+idClip+'&tt_content=embed&tt_medium=clips_embed" width="100%" height="360" frameborder="0" scrolling="no" allowfullscreen="true"></iframe>');


    }
                else if(pattern_twitch_video.test(urlmedia)) // video twitch
    {

       var idVideo = TwitchGetIdVideo(urlmedia); // récupération de l'id de la vidéo

        editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

        // ajout de la vidéo

        $('#' + area + '').val(editor + '[VideoTwitch]'+idVideo+'[/videoTwitch] ');

        //preview

        $('#' + preview + '').html('<iframe src="https://player.twitch.tv/?autoplay=false&video=v'+idVideo+'" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="100%"></iframe>');



    }
                    else if(pattern_instagram.test(urlmedia)) // photo instagram
    {

        var idpic = InstagramGetId(urlmedia); // id de la photo

        editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

        // ajout de la photo

        $('#' + area + '').val(editor + '[InstagramPost]'+idpic+'[/InstagramPost] ');

        //preview

        $('#' + preview + '').html('<iframe src="https://www.instagram.com/p/'+idpic+'/embed/captioned/" width="100%" height="780" frameborder="0" scrolling="no" allowtransparency="true"></iframe>');


    }
      else if (pattern_ext_image.test(urlmedia)) { // lien vers une image externe

        editor = remove_existig_media($('#' +area+'').val()); // suppression d'un éventuel média existant

        // ajout de la photo

        $('#' + area + '').val(editor + '[imageUrl]'+urlmedia+'[/imageUrl] ');

        //preview

        $('#' + preview + '').html('<a href="'+ urlmedia +'" ><img src="'+ urlmedia +'" width="100%" /></a>');

    }

    else
    {

//notification d'URL invalide

       $('#etatnotifmodalmedia').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;l\'URL entrée n\'est pas valide.</span></p>');
        setTimeout(function() {
      $('.notif').fadeOut("slow");
        }, 2000 );

    }
            //on remet le focus après pour continuer à écrire

    $('#' +area+'').focus();

    // affichage preview

    $('#' + preview + '').css("display","block");

    // on vde le champ

    $('#media').val('');

    //fermeture de la modal "ajout de média"

    $('#modalmedia').modal('hide');

}
     });

// extraction id video youtube
function YouTubeGetID(url){
  var ID = '';
  url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
  if(url[2] !== undefined) {
    ID = url[2].split(/[^0-9a-z_\-]/i);
    ID = ID[0];
  }
  else {
    ID = url;
  }
    return ID;
}
// fin extractio id youtube

//test regex dailymotion

function DailymotionGetID(url) {
  var p = /^(?:(?:https?):)?(?:\/\/)?(?:www\.)?(?:(?:dailymotion\.com(?:\/embed)?\/video)|dai\.ly)\/([a-zA-Z0-9]+)(?:_[\w_-]+)?$/;
  return (url.match(p)) ? RegExp.$1 : false;
}

// fin test regex dailymotion
//regex twitch clip

function TwitchGetID(url) {

return url.split('/')[3];
}

//fin regex twitch clip

//regex twitch video
function TwitchGetIdVideo(url) {

return url.split('/')[4];
}
//fin regex twitch video

//regx instagram
function InstagramGetId(url)
{
  return /p\/(.*?)\/$/.exec(url)[1];
}
//fin regex instagram

// fin media externe

//traitement photo

// test du select

$(document).on('change', '#sendpic', function () {

      if($('#ModalTweet').hasClass('in'))
  {
      preview = 'previewmediatweet';
      editor, area = 'instatuxeditor_textarea';

  }
    else
  {
      preview = 'previewmediamess';
      editor,area = 'message';
  }

     var imgPath = $(this)[0].value;

     var filename = $(this).val().split('\\').pop();

     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

     if (extn == "jpg" || extn == "jpeg" || extn == "png") { // fichier jpg/jpeg

         // si vieux navigateur

             var reader = new FileReader();

             reader.onload = function(e)
             {
                var img = $('<img>').attr({'src':e.target.result, 'width':"100%"});

                //preview image

                //if($('#ModalTweet').hasClass('in'))
                 //{

                $('#' + preview + '').html(img);

                //affichage preview

                $('#' + preview + '').css("display","block");
              //}
              //else
            //  {
               // $('#previewpic').html(img);

                //affichage preview

                //$('#previewpic').css("display","block");
              //}
             }
             reader.readAsDataURL(this.files[0]);

                 

                 // ajout du champ input au formulaire d'envoi de tweet ou de messagerie

                    if($('#ModalTweet').hasClass('in'))
                 {

                  // récupération du contenu actuel du textarea tweet

                 //var editor = $('#instatuxeditor_textarea').val();

                  //$("#form_tweet").append($("#sendpic").hide());

                    $("#sendpic").clone().appendTo($("#form_tweet")).addClass('temppic').hide();

                  }
                    else
                  {

                    $("#sendpic").clone().appendTo($("#form_message")).addClass('temppic').hide();

                  }

                editor = remove_existig_media($('#' +area+'').val());

                 //affichage image

                $('#' + area + '').val(editor + '[image]'+filename+'[/image] ');

                 //on remet le focus après pour continuer à écrire

                $('#' + area + '').focus();

                //recréation de l'input d'envoi de photo

                //$('#selectpic').after('<div class="form-group"><input type="file" accept="image/*" name="file" id="sendpic"></div>');      

                //fermeture de la modal media

                $('#modalmedia').modal('hide');
         }
             else
    {

//notification de photo invalide

           $('#etatnotifmodal').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Image invalide.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#sendpic').val("");
    }

    return false;

  });
// fin test du select

//fin traitement photo

//preview media

  $('#' + preview + '').change(function()
    {
      $(this).html($(this).val());
    });

// fin preview

//vérifier si il y'a déjà un media

function remove_existig_media(editor)
{
  return editor.replace(/\[.*\]/g,'');
}


// fin vérifier si il y'a déjà un media

//compter le nombre de média

      function countWords (sText) {

  for (var rWord = /\[(.*?)\].*?\[\/\1\]/g, nCount = 0; rWord.test(sText); nCount++);

  return nCount;

}
//fin compter le nombre de média

// envoi tweet

    $('#form_tweet').submit(function(e){

      e.preventDefault();

          if(countWords($('#instatuxeditor_textarea').val()) > 1) // si il y'a plus d'un média on n'envoi pas
        {
           $('#etatnotifmodal').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Un tweet ne peut contenir qu\'un seul média à la fois.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );

       return false;
        }

      $.ajax({
                type: 'POST',
                contentType: false,
                url: '/instatux/post/add',
                dataType: 'json',
                data: new FormData(this),
                processData: false,
    success: function(data){


  if(data == "probleme") // problème de publication
{
    $('#etatnotifmodal').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de publier ce tweet.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
}
  else // tout est bon, on crée un nouveau tweet
{



// notification de réussite

$('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Tweet ajouté.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 1000 );



//incrementation du nombre de tweet

  var nb_tweet = $('#nb_tweet_'+data.user_id+'').text();// nombre de tweet actuel

  nb_tweet++;

  $('#nb_tweet_'+data.user_id+'').empty('').prepend(nb_tweet); // mise à jour nombre de tweet

//fin incrementation nombre de tweet

// incrémentation du nombre de média si il y'en as

  if(data.new_media == 1)
{
  var nb_media = $('#nb_media_'+data.user_id+'').text();// nombre de tweet actuel

  nb_media++;

  $('#nb_media_'+data.user_id+'').empty('').prepend(nb_media); // mise à jour nombre de tweet

  $('#list_media').load('/instatux/'+data.user_id+'/media/listmedia'); // Ajout du média associé au tweet qui vient d'etre posté dans la cell des médias
}

// fin icrémentation du nombre  de medias

// on vide l'editeur

$('#instatuxeditor_textarea').val('');

// on vide les preview

$('#previewmediatweet, #media').empty();

//$('#media').val('');

$('.temppic').remove();


//compteur reinitialisé

$('#textCounter').text("250 caractère(s) restant(s)");

//ajout du tweet à la liste

$('#list_tweet_'+data.user_id+'').prepend('<div class="tweet" data-idtweet="' + data.id_tweet + '"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-idtweet="' + data.id_tweet +'"  title="Effacer ce tweet"  class="deletetweet" onclick="return false;">Effacer ce tweet</a></li></ul></div><img src="/instatux/img/avatar/' + data.user_id + '.jpg"alt="image utilisateur" class="img-circle vcenter"/><a href="/instatux/' + data.user_id +'" class="link_username_tweet">' + data.user_id + '</a><span class="alias_tweet">@' + data.user_id +'</span> - A l\'instant<p>' + data.contenu_tweet +'</p><span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-'+ data.id +'">0</span></span><span class="nb_comm_share">0 commentaire(s) - 0 partage(s)</span><br /><br /><span class="link_comm_share"><span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> <a href="#" data-value="'+data.id+'" class="link_like" onclick="return false;">J&#039;aime</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-comment" style="vertical-align:center"></span>&nbsp;<a href="/instatux/post/'+data.id_tweet+'" data-toggle="modal" data-target="#viewtweet" data-remote="false">Commenter</a></span></div>');

// si aucun tweet, on efface la div "#notweet"

    if ($('#notweet').length > 0)
  {
    $('#notweet').remove();
  }
//fermeture de l'editor

$('#ModalTweet').modal('hide');
}

// fin création de tweet
    },
    error: function(data)
    {

      $('#etatnotifmodal').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-remove red" style="vertical-align:center"></span>&nbsp;Impossible de publier ce tweet.</span></p>');
      setTimeout(function() {
      $('.notif').fadeOut("slow");
        }, 2000 );
    }

         });
    });

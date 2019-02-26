// empecher le decalage du body a la fermeture des modals
$(document).ready(function () {
    $('#modalmedia').on('show.bs.modal', function () {
        $('#ModalTweet').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

    $('#modalmedia').on('hidden.bs.modal', function () {
        $('#ModalTweet').css('z-index', 1041); //bring back the first modal overlay to it's normal state when 2nd modal closed
        $('body').addClass('modal-open'); // add `modal-open` class back to body when 2nd modal close so first modal will be scrollable
    });

        $('#modalpic').on('show.bs.modal', function () {
        $('#ModalTweet').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

                $('#modalpic').on('hidden.bs.modal', function () {
        $('#ModalTweet').css('z-index', 1041); //this will push the first modal overlay behind second modal overlay
        $('body').addClass('modal-open');
    });
                        $('#HelpModal').on('show.bs.modal', function () {
        $('#modalmedia').css('z-index', 1039); //this will push the first modal overlay behind second modal overlay
    });

                $('#HelpModal').on('hidden.bs.modal', function () {
        $('#modalmedia').css('z-index', 1041); //this will push the first modal overlay behind second modal overlay
        $('body').addClass('modal-open');
    });
});
//limite textarea
$('#instatuxeditor_textarea').on("input", function(){
    var maxlength = $(this).attr("maxlength");
    var currentLength = $(this).val().length;

    if( currentLength >= maxlength ){
        //console.log("You have reached the maximum number of characters.");
        $('#textCounter').text("Maximum de caractères atteints.");
    }else{
        //console.log(maxlength - currentLength + " chars left");
        $('#textCounter').text(maxlength - currentLength + " caractère(s) restant(s)");
    }
});

// fin limite textarea
//smiley
      $('.emojis-plain_editor').emojiarea({wysiwyg: false});

    
    var $wysiwyg = $('.emojis-wysiwyg').emojiarea({wysiwyg: false});
    var $wysiwyg_value = $('#emojis-wysiwyg-value');
    
    $wysiwyg.on('change', function() {
      $wysiwyg_value.text($(this).val());
    });
    $wysiwyg.trigger('change');
    //fin smiley

//insérer lien
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


// insertion d'un média externe
// vidéo Youtube,Vimeo,Dailymotion,Twitch
$('#btninsertmedia').on('click', function()
{

var urlmedia = $('#media').val();

var idvideo; // pour youtube,vimeo,dailymotion

// test du champ vide
if (urlmedia.length > 0) {

	// patern de recherche
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
  //URL
  var pattern_url = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\w]*))?)/;

	if (pattern_youtube.test(urlmedia)) { // vidéo youtube

		idvideo = YouTubeGetID(urlmedia);

		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[videoYoutube]'+idvideo+'[/videoYoutube] '); // ajout de la vidéo
        $('#preview').html('<iframe src="//www.youtube.com/embed/'+idvideo+'"  width="100%" height="360" frameborder="0"></iframe>');
        $('#instatuxeditor_textarea').focus();
        $('#preview').css("display","block");
      	$('#modalmedia').modal('hide');
    }
        else if(pattern_dailymotion.test(urlmedia)) // video dailymotion
    {
    			idvideo = DailymotionGetID(urlmedia);

		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[videoDailymotion]'+idvideo+'[/videoDailymotion] '); 
        $('#preview').html('<iframe frameborder="0" width="100%" height="360" src="//www.dailymotion.com/embed/video/'+idvideo+'" allowfullscreen></iframe>');
        $('#instatuxeditor_textarea').focus();
        $('#preview').css("display","block");
        $('#modalmedia').modal('hide');
    }
            else if(pattern_twitch_clip.test(urlmedia))// clip twitch
    {	
    	var idClip = TwitchGetID(urlmedia);
		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[clipTwitch]'+idClip+'[/clipTwitch] '); 
        $('#preview').html('<iframe src="https://clips.twitch.tv/embed?autoplay=false&clip='+idClip+'&tt_content=embed&tt_medium=clips_embed" width="100%" height="360" frameborder="0" scrolling="no" allowfullscreen="true"></iframe>');
        $('#instatuxeditor_textarea').focus();
        $('#preview').css("display","block");
        $('#modalmedia').modal('hide');

    }
                else if(pattern_twitch_video.test(urlmedia)) // video twitch
    {	
    	var idVideo = TwitchGetIdVideo(urlmedia);
		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[VideoTwitch]'+idVideo+'[/videoTwitch] '); 
        $('#preview').html('<iframe src="https://player.twitch.tv/?autoplay=false&video=v'+idVideo+'" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="100%"></iframe>');
        $('#instatuxeditor_textarea').focus();
        $('#preview').css("display","block");
        $('#modalmedia').modal('hide');

    }
                    else if(pattern_instagram.test(urlmedia)) // photo instagram
    {	
      var idpic = InstagramGetId(urlmedia);
		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[InstagramPost]'+idpic+'[/InstagramPost] '); 
        $('#preview').html('<iframe src="https://www.instagram.com/p/'+idpic+'/embed/captioned/" width="100%" height="780" frameborder="0" scrolling="no" allowtransparency="true"></iframe>');
        $('#instatuxeditor_textarea').focus();
        $('#preview').css("display","block");
        $('#modalmedia').modal('hide');

    }
    	else if (pattern_ext_image.test(urlmedia)) { // lien vers une image externe

		var editor = $('#instatuxeditor_textarea').val();
		editor = remove_existig_media(editor);
		$('#instatuxeditor_textarea').val(editor + '[imageUrl]'+urlmedia+'[/imageUrl] '); 
        $('#preview').html('<a href="'+ urlmedia +'" ><img src="'+ urlmedia +'" width="100%" /></a>');
        $('#preview').css("display","block");
        $('#modalmedia').modal('hide');
        $('#instatuxeditor_textarea').focus();
    }
          else if (pattern_url.test(urlmedia)) { // test d'une url vers un lien

    var editor = $('#instatuxeditor_textarea').val();
    $('#instatuxeditor_textarea').val(editor + ''+urlmedia+' '); 
    $('#instatuxeditor_textarea').focus();
        $('#modalmedia').modal('hide');
    }
    else
    {
    	     $('#etatnotifmodalmedia').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;l\'URL entrée n\'est pas valide.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        
    }

}
	   }); 

// extract id video youtube
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
// fin extract id youtube
//test regex vimeo
function VimeoGetID(url) {
  var p = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/?(.+)/g;
  return (url.match(p)) ? RegExp.$1 : false;
}
// fin test regex vimeo
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
//regex twitch clip
function TwitchGetIdVideo(url) {

return url.split('/')[4];
}
//fin regex twitch clip
//regx instagram
function InstagramGetId(url)
{
  return /p\/(.*?)\/$/.exec(url)[1];
}
//fin regex instagram
// fin media externe
//traitement photo

// test du select
$("#sendpic").on('change', function () {
	

     var imgPath = $(this)[0].value;
     var filename = $(this).val().split('\\').pop();
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

     if (extn == "jpg" || extn == "jpeg" || extn == "png") { // fichier jpg/jpeg

         // si vieux navigateur

             var reader = new FileReader();
             reader.onload = function(e)
             {
            var img = $('<img>').attr({'src':e.target.result, 'width':"100%"});
            $('#preview').html(img);
            $('#preview').css("display","block");
             }
             reader.readAsDataURL(this.files[0]);

             		 // récupération du conten u actuel du textarea
             		 var editor = $('#instatuxeditor_textarea').val();
             		 editor = remove_existig_media(editor);
					$('#instatuxeditor_textarea').val(editor + '[image]'+filename+'[/image] ');
          $('#instatuxeditor_textarea').focus();
$('#modalpic').modal('hide');
         }
             else
    {
    	     $('#etatnotifmodal').fadeIn().html('<p class="notif bg-danger"><span class="glyphicon glyphicon-warning-sign red" style="vertical-align:center"></span>&nbsp;Image invalide.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 2000 );
        $('#sendpic').val("");
    }

	});
// fin test du select
//fin traitement photo
//preview media
	$("#preview").change(function() 
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
$('#ModalTweet').modal('hide');
 $('#etatnotif').fadeIn().html('<p class="notif bg-success"><span class="glyphicon glyphicon-ok green" style="vertical-align:center"></span>&nbsp;Tweet ajouté.</span></p>');
        setTimeout(function() {
          $('.notif').fadeOut("slow");
        }, 1000 );
        //incremnte nombre de tweet
        var nb_tweet = $('#nb_tweet_'+data.auth_name+'').text();// nombre de tweet
        nb_tweet++;
        $('#nb_tweet_'+data.auth_name+'').empty('').prepend(nb_tweet);
        //fin incrementte nombre de tweet
$('#instatuxeditor_textarea').val(''); // on vide l'editeur
// on vide les preview
$('#preview').empty(''); 
$('#previewpic').empty('');
$('#media').val('');
$('#sendpic').val('');
$('#textCounter').text("250 caractère(s) restant(s)");//compteur reinitialisé
$('#list_tweet_'+data.auth_name+'').prepend('<div class="tweet" data-idtweet="' + data.id_tweet + '"><div class="dropdown"><button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">    ...</button><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"><li><a href="#" data-idtweet="' + data.id_tweet +'"  title="Effacer ce tweet"  class="deletetweet" onclick="return false;">Effacer ce tweet</a></li></ul></div><img src="/instatux/img/avatar/' + data.auth_name + '.jpg"alt="image utilisateur" class="img-circle vcenter"/><a href="/instatux/' + data.auth_name +'" class="link_username_tweet">' + data.auth_name + '</a><span class="alias_tweet">@' + data.auth_name +'</span> - A l\'instant<p>' + data.contenu_tweet +'</p><span class="nb_like"><span class="glyphicon glyphicon-heart" style="vertical-align:center"></span> <span id="compteur_like-'+ data.id +'">0</span></span><span class="nb_comm_share">0 commentaire(s) - 0 partage(s)</span><br /><br /><span class="link_comm_share"><span class="glyphicon glyphicon-thumbs-up" style="vertical-align:center"></span> <a href="#" data-value="'+data.id+'" class="link_like" onclick="return false;">J&#039;aime</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-comment" style="vertical-align:center"></span>&nbsp;<a href="/instatux/post/'+data.id_tweet+'" data-toggle="modal" data-target="#viewtweet" data-remote="false">Commenter</a></span></div>');
if ($('#notweet').length > 0) {
  $('#notweet').remove();
  }
  }


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


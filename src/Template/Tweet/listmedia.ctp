<!--

 * listmedia.ctp
 *
 * Affichage des 8 derniers médias uploadés sur un profil
 *
 */ -->
 
<div class="list_media" id="list_media">

      <?php foreach ($list_media as $list_media): ?>

        <a href="" data-idtweet="<?= $list_media->tweet_media; ?>" data-toggle="modal" data-target="#viewtweet" data-remote="false"><img src="/instatux/img/media/<?= $list_media->user_id; ?>/<?= $list_media->nom_media; ?>" class="thumbmedia" alt="image introuvable"></a>

    <?php endforeach ;?>

</div>


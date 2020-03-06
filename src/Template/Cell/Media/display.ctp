<!--

 * display.ctp
 *
 * Affichage des 8 derniers médias d'un utilisateur (image par ulpoad)
 *
 */

-->
<div class="list_media" id="list_media">

      <?php foreach ($list_media as $list_media): ?>

        <a href="" data-idtweet="<?php echo $list_media->tweet_media; ?>" data-toggle="modal" data-target="#viewtweet" data-remote="false"><img src="/instatux/img/media/<?php echo $list_media->user_id; ?>/<?php echo $list_media->nom_media; ?>" class="thumbmedia" alt="image introuvable"></a>

    <?php endforeach ;?>

</div>

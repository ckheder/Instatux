<div class="list_media">

      <?php foreach ($list_media as $list_media): ?>
      
        <a href="./post/<?php echo $list_media->tweet_media; ?>"><img src="http://localhost/instatux/img/media/<?php echo $list_media->user_id; ?>/<?php echo $list_media->nom_media; ?>" class="thumbmedia" alt="image introuvable"></a>

    <?php endforeach ;?>

</div>
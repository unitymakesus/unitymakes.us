<?php

$clients = new WP_Query([
  'post_type' => 'client',
  'posts_per_page' => -1,
  'orderby' => 'menu-order',
  'order' => 'ASC'
]);

if ($clients->have_posts()) :
?>
  <div class="valign-wrapper flex-center flex-wrap">
    <?php while ($clients->have_posts()) : $clients->the_post();
      $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
      ?>
      <span class="vertical-padding-1 horizontal-padding-1 ">
        <img class="valign"
             alt="<?php the_title(); ?>"
             src="<?php echo $img[0]; ?>"
             width="<?php echo $img[1]/2; ?>"
             height="<?php echo $img[2]/2; ?>" />
      </span>
    <?php endwhile; ?>
  </div>
<?php
endif; wp_reset_postdata();
?>

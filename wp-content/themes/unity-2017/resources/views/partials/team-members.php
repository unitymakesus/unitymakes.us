<?php

$team_query = new WP_User_Query([
  'number' => -1,
  'orderby' => 'meta_value_num',
  'meta_key' => 'display_order'
]);

$team = $team_query->get_results();

if (!empty($team)) : foreach ($team as $member) :
  ?>
  <div class="row person parallax-container" itemscope itemprop="author" itemtype="http://schema.org/Person">
    <div class="col m4 l3">
      <div class="parallax-faster left-align">
        <div class="person-card">
          <h4 itemprop="name"><?php echo $member->display_name; ?></h4>
          <p class="h6" itemprop="jobTitle"><?php echo get_user_meta($member->ID, 'title', true); ?></p>
        </div>
        <?php
          if (function_exists ( 'mt_profile_img' ) ) {
            mt_profile_img($member->ID, [
              'size' => 'medium',
              'attr' => [
                'alt' => 'Photograph of ' . $member->display_name,
                'class' => 'z-depth-1',
                'itemprop' => 'image'
              ],
              'echo' => true
            ]);
          }
        ?>
      </div>
    </div>
    <div class="col m8 l9 background-white z-depth-3">
      <?php echo apply_filters('the_content', get_user_meta($member->ID, 'description', true)); ?>
    </div>
  </div>
  <?php
endforeach; endif;
?>

<div class="person col s12 m6" itemscope itemprop="author" itemtype="http://schema.org/Person">
  <div class="z-depth-2 background-white">
    <div class="background-yellow center-align">
      <div class="img-wrapper">
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
      <h4 itemprop="name"><?php echo $member->display_name; ?></h4>
      <p class="h6 uppercase" itemprop="jobTitle"><?php echo get_user_meta($member->ID, 'title', true); ?></p>
      <p class="no-margin">
        <a itemprop="email" href="mailto:<?php echo eae_encode_str($member->user_email); ?>" target="_blank" rel="noopener">
          <?php echo eae_encode_str($member->user_email); ?>
        </a>
      </p>
    </div>
    <div class="bio">
      <?php echo apply_filters('the_content', get_user_meta($member->ID, 'description', true)); ?>
    </div>
  </div>
</div>

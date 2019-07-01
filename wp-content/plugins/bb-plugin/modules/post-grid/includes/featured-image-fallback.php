<div class="fl-post-<?php echo $layout; ?>-image">
	<?php do_action( 'fl_builder_post_' . $layout . '_before_image', $settings, $this ); ?>

	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php
			echo wp_get_attachment_image( $settings->image_fallback, $settings->image_size );
		?>
	</a>

	<?php do_action( 'fl_builder_post_' . $layout . '_after_image', $settings, $this ); ?>

</div>

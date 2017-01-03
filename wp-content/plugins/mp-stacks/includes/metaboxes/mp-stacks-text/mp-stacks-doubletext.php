<?php
/**
 * Function which creates new Meta Box
 *
 */
function mp_stacks_doubletext_create_meta_box(){	
	/**
	 * Array which stores all info about the new metabox
	 *
	 */
	$mp_stacks_text_add_meta_box = array(
		'metabox_id' => 'mp_stacks_text_metabox', 
		'metabox_title' => __( '"Text" Content-Type', 'mp_stacks'), 
		'metabox_posttype' => 'mp_brick', 
		'metabox_context' => 'advanced', 
		'metabox_priority' => 'low' ,
		'metabox_content_via_ajax' => true,
	);
	
	/**
	 * Array which stores all info about the options within the metabox
	 *
	 */
	$mp_stacks_text_items_array = array(
		array(
			'field_id'	 => 'brick_text_media_type_description',
			'field_title' => __( 'Description:', 'mp_stacks'),
			'field_description' => '<br />The "Text" Media-Type has repeatable Text-Pairs which sit on top of each other.',
			'field_type' => 'basictext',
			'field_value' => '',
		),
		array(
			'field_id'	 => 'brick_text_pair_title',
			'field_title' => __( '2 Text Areas', 'mp_stacks'),
			'field_description' => __( 'Two text areas.', 'mp_stacks' ),
			'field_type' => 'repeatertitle',
			'field_value' => '',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_1_color',
			'field_title' => __( 'Text Color 1', 'mp_stacks'),
			'field_description' => '<br />Select the color of text area 1.',
			'field_type' => 'colorpicker',
			'field_value' => '',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_1_font_size',
			'field_title' => __( 'Text Size 1', 'mp_stacks'),
			'field_description' => '<br />Enter the size (in pixels).',
			'field_type' => 'number',
			'field_value' => '35',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_1_line_height',
			'field_title' => __( 'Line-Height 1', 'mp_stacks'),
			'field_description' => '<br />Enter the line-height in pixels.',
			'field_type' => 'number',
			'field_value' => '',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_1_paragraph_margin_bottom',
			'field_title' => __( 'Paragraph Spacing 1', 'mp_stacks'),
			'field_description' => '<br />Enter the number of pixels separating each paragraph. Default: 15px',
			'field_type' => 'number',
			'field_value' => '15',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_text_line_1',
			'field_title' => __( 'Text Area 1', 'mp_stacks'),
			'field_description' => 'Enter the text to display on text area 1',
			'field_type' => 'wp_editor',
			'field_value' => '',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_2_color',
			'field_title' => __( 'Text Color 2', 'mp_stacks'),
			'field_description' => '<br />Select the color of text area 2',
			'field_type' => 'colorpicker',
			'field_value' => '',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_2_font_size',
			'field_title' => __( 'Text Size 2', 'mp_stacks'),
			'field_description' => '<br />Enter the size (in pixels).',
			'field_type' => 'number',
			'field_value' => '20',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_2_line_height',
			'field_title' => __( 'Line-Height 2', 'mp_stacks'),
			'field_description' => '<br />Enter the line-height in pixels.',
			'field_type' => 'number',
			'field_value' => '',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_line_2_paragraph_margin_bottom',
			'field_title' => __( 'Paragraph Spacing 2', 'mp_stacks'),
			'field_description' => '<br />Enter the number of pixels separating each paragraph. Default: 15px',
			'field_type' => 'number',
			'field_value' => '15',
			'field_container_class' => 'mp_brick_text_option',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_text_line_2',
			'field_title' => __( 'Text Area 2', 'mp_stacks'),
			'field_description' => 'Enter the text to display on text area 2',
			'field_type' => 'wp_editor',
			'field_value' => '',
			'field_repeater' => 'mp_stacks_text_content_type_repeater'
		),
		array(
			'field_id'	 => 'brick_content_type_help',
			'field_title' => 'Content Types',
			'field_description' => NULL,
			'field_type' => 'help',
			'field_value' => '',
			'field_select_values' => array(
				array( 
					'type' => 'oembed',
					'link' => 'https://mintplugins.com/embed/?post_id=3872',
					'link_text' => __( '"Text" Content-Type Tutorial', 'mp_stacks'),
					'target' => NULL
				),
			)
		),
	);
	
	
	/**
	 * Custom filter to allow for add-on plugins to hook in their own data for add_meta_box array
	 */
	$mp_stacks_text_add_meta_box = has_filter('mp_stacks_text_meta_box_array') ? apply_filters( 'mp_stacks_text_meta_box_array', $mp_stacks_text_add_meta_box) : $mp_stacks_text_add_meta_box;
	
	/**
	 * Custom filter to allow for add on plugins to hook in their own extra fields 
	 */
	$mp_stacks_text_items_array = has_filter('mp_stacks_text_items_array') ? apply_filters( 'mp_stacks_text_items_array', $mp_stacks_text_items_array) : $mp_stacks_text_items_array;
	
	
	/**
	 * Create Metabox class
	 */
	global $mp_stacks_text_meta_box;
	$mp_stacks_text_meta_box = new MP_CORE_Metabox($mp_stacks_text_add_meta_box, $mp_stacks_text_items_array);
}
add_action('mp_brick_ajax_metabox', 'mp_stacks_doubletext_create_meta_box');
add_action('wp_ajax_mp_stacks_text_metabox_content', 'mp_stacks_doubletext_create_meta_box');
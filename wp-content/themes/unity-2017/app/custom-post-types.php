<?php

namespace App;

/**
 * This file adds custom post types to the theme.
 */

add_action( 'init', function() {
	register_post_type( 'client',
		array('labels' => array(
				'name' => 'Clients',
				'singular_name' => 'Client',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Client',
				'edit' => 'Edit',
				'edit_item' => 'Edit Client',
				'new_item' => 'New Client',
				'view_item' => 'View Client',
				'search_items' => 'Search Clients',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
			), /* end of arrays */
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'menu_position' => 38,
			'menu_icon' => 'dashicons-groups',
			'capability_type' => 'page',
			'hierarchical' => false,
			'supports' => array( 'title', 'thumbnail'),
			'has_archive' => false,
			'rewrite' => false,
			'query_var' => true
		)
	);
});

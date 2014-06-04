<?php

/* Custom post to display partners */

function partner_theme_custom_posts()
{
	$labels = array(
		'name' => _x('Partners', 'partners', 'rtPanel') ,
		'singular_name' => _x('Partner', 'partner', 'rtPanel') ,
		'add_new' => _x('Add Partner', 'partner', 'rtPanel') ,
		'add_new_item' => __('Add New Partner', 'rtPanel') ,
		'edit_item' => __('Edit Partner', 'rtPanel') ,
		'new_item' => __('New Partner', 'rtPanel') ,
		'view_item' => __('View Partner', 'rtPanel') ,
		'search_items' => __('Search Partner', 'rtPanel') ,
		'not_found' => __('No Partner found', 'rtPanel') ,
		'not_found_in_trash' => __('No Partner found in Trash', 'rtPanel') ,
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'menu_position' => null,
		'menu_icon' => 'dashicons-groups',
		'rewrite' => array(
			'slug' => 'partner',
			'with_front' => ''
		) ,
		'supports' => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'comments'
		)
	);
	register_post_type('partner', $args);
}

add_filter('init', 'partner_theme_custom_posts');
?>
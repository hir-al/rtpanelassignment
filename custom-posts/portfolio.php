<?php

function portfolio_theme_custom_posts()
{
	$labels = array(
		'name' => _x('Portfolios', 'Portfolios', 'rtPanel') ,
		'singular_name' => _x('Portfolio', 'portfolio', 'rtPanel') ,
		'add_new' => _x('Add Portfolio', 'portfolio', 'rtPanel') ,
		'add_new_item' => __('Add New Portfolio', 'rtPanel') ,
		'edit_item' => __('Edit Portfolio', 'rtPanel') ,
		'new_item' => __('New Portfolio', 'rtPanel') ,
		'view_item' => __('View Portfolio', 'rtPanel') ,
		'search_items' => __('Search Portfolio', 'rtPanel') ,
		'not_found' => __('No Portfolio found', 'rtPanel') ,
		'not_found_in_trash' => __('No Portfolio found in Trash', 'rtPanel') ,
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
		'menu_icon' => 'dashicons-portfolio',
		'rewrite' => array(
			'slug' => 'portfolio',
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
	register_post_type('portfolio', $args);
}

add_filter('init', 'portfolio_theme_custom_posts');
?>
<?php 
function partner_theme_custom_posts(){
	$labels = array(
	  'name' => _x('Partners', 'partners','templatemela'),
	  'singular_name' => _x('Partner', 'partner','templatemela'),
	  'add_new' => _x('Add Partner', 'partner','templatemela'),
	  'add_new_item' => __('Add New Partner','templatemela'),
	  'edit_item' => __('Edit Partner','templatemela'),
	  'new_item' => __('New Partner','templatemela'),
	  'view_item' => __('View Partner','templatemela'),
	  'search_items' => __('Search Partner','templatemela'),
	  'not_found' =>  __('No Partner found','templatemela'),
	  'not_found_in_trash' => __('No Partner found in Trash','templatemela'), 
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
	  'rewrite' => array('slug'=>'partner','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('partner',$args);	
}
add_filter('init', 'partner_theme_custom_posts' );
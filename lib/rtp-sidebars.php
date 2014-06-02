<?php
/**
 * rtPanel sidebars
 *
 * @package rtPanel
 *
 * @since rtPanel 2.0
 */

function rtp_widgets_init() {

    global $rtp_general;
    $rtp_footer_widget_grid_class = apply_filters( 'rtp_set_footer_widget_grid_class', 'large-4 columns' );

    // Sidebar Widget
    register_sidebar( array(
        'name' => __( 'Sidebar Widgets', 'rtPanel' ),
        'id' => 'sidebar-widgets',
        'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );
	
	// Header Google Search Widget
	register_sidebar( array(
		'name' => __( 'Header Google Search Widget', 'rtPanel' ),
		'id' => "header-search-widget",
		'before_widget' => '<div id="%1$s" class="widget header-search-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	
    // BuddyPress Sidebar
    if ( class_exists( 'BuddyPress') && isset( $rtp_general['buddypress_sidebar'] ) && ($rtp_general['buddypress_sidebar'] === "buddypress-sidebar") ) {
         register_sidebar( array(
            'name' => __( 'BuddyPress Sidebar Widgets', 'rtPanel' ),
            'id' => "buddypress-sidebar-widgets",
            'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ) );
    }

    // bbPress Sidebar
    if ( class_exists( 'bbPress') && isset( $rtp_general['bbpress_sidebar'] ) && ($rtp_general['bbpress_sidebar'] === "bbpress-sidebar") ) {
         register_sidebar( array(
            'name' => __( 'bbPress Sidebar Widgets', 'rtPanel' ),
            'id' => "bbpress-sidebar-widgets",
            'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ) );
    }

    // Footer Widget
    if ( isset( $rtp_general['footer_sidebar'] ) && $rtp_general['footer_sidebar'] ) {
         register_sidebar( array(
            'name' => __( 'Footer Widgets', 'rtPanel' ),
            'id' => "footer-widgets",
            'before_widget' => '<div id="%1$s" class="widget footerbar-widget '. $rtp_footer_widget_grid_class .' %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ) );
    }
	
	// First Footer Widget
	if ( isset( $rtp_general['first_footer_sidebar'] ) && $rtp_general['first_footer_sidebar'] ) {
		register_sidebar( array(
			'name' => __( 'First Footer Widgets', 'rtPanel' ),
			'id' => "first-footer-widgets",
			'before_widget' => '<div id="%1$s" class="widget footerbar-widget '. $rtp_footer_widget_grid_class .' %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
	
	// Second Footer Widget
	if ( isset( $rtp_general['second_footer_sidebar'] ) && $rtp_general['second_footer_sidebar'] ) {
		register_sidebar( array(
			'name' => __( 'Second Footer Widgets', 'rtPanel' ),
			'id' => "second-footer-widgets",
			'before_widget' => '<div id="%1$s" class="widget footerbar-widget '. $rtp_footer_widget_grid_class .' %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
	
	// Third Footer Widget	
	if ( isset( $rtp_general['third_footer_sidebar'] ) && $rtp_general['third_footer_sidebar'] ) {
		register_sidebar( array(
			'name' => __( 'Third Footer Widgets', 'rtPanel' ),
			'id' => "third-footer-widgets",
			'before_widget' => '<div id="%1$s" class="widget footerbar-widget '. $rtp_footer_widget_grid_class .' %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'rtp_widgets_init' );

/* Includes Custom Posts located in 'widgets' folder */
<?php
/**
 * rtPanel shortcodes
 *
 * @package rtPanel
 *
 * @since rtPanel 2.0
 */
 
/**
 * shortcode to display title
 */

function rtp_shortcode_title( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'size'	=> ''
    ), $atts));
	
	$output = '';
	$output .= '<h3 class="title '.$size.'">' .do_shortcode($content). '</h3>';

    return $output;
}
add_shortcode('rt-title', 'rtp_shortcode_title');

/**
 * shortcode to display divider
 */

function rtp_shortcode_divider( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'type'	=> 'thin'
    ), $atts));
	
	$output = '';
	$output .= '<div class="divider '.$type.'"></div>';

    return $output;
}
add_shortcode('rt-divider', 'rtp_shortcode_divider');

/**
 * shortcode to make container one half
 */

function rtp_shortcode_one_half( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'width'	=> '100%'
    ), $atts));
	
	$output = '';
	$output .= '<div class="one_half">';
	$output .= '<div class="one_half_inner style="width:'.$width.';">' .do_shortcode($content). '</div>';
	$output .= '</div>';

    return $output;
}
add_shortcode('rt-one-half', 'rtp_shortcode_one_half');

/**
 * shortcode to display link container
 */

function rtp_shortcode_links( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));
	
	$output = '';
	$output .= '<ul class="links-list">' .do_shortcode($content). '</ul>';

    return $output;
}
add_shortcode('rt-links', 'rtp_shortcode_links');

/**
 * shortcode to display link
 */

function rtp_shortcode_link( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'url'	=> '#',
	'title' => 'Title'
    ), $atts));
	
	$output = '';
	$output .= '<li><a href="'.$url.'" target="_Blank">'.$title.'</a></li>';

    return $output;
}
add_shortcode('rt-link', 'rtp_shortcode_link');

/**
 * shortcode to display portfolio
 */
 
function rtp_shortcode_portfolio( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'posts_per_page' => '8',
	'items_per_row' => '4',
    ), $atts));
	
	$output = '';
	wp_reset_query(); wp_reset_postdata();
	$args = array(
      'post_type' => 'portfolio',
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page
    );

    $the_query = null;
    $the_query = new WP_Query($args);
    if( $the_query->have_posts() ) { 
	$output .= '<section class="rtp-portfolio-container">';
	$i = 1;
		while ($the_query->have_posts()) : $the_query->the_post();
			if($i % $items_per_row == 1)
				$class = " first";
			elseif($i % $items_per_row == 0)
				$class = " last";
			else
				$class = "";
			$output .= '<article class="post henry single-portfolio'.$class.'">';			
				//get thumbnail
				$thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-home-thumb');
				$output .= '<div class="portfolio-image">';
					if($thumbail) {
						$output .= '<a href="'.$thumbail[0].'" title="'.get_the_title().'"><img src="'.$thumbail[0].'" alt="'.get_the_title().'" /></a>';
					} 
				$output .= '</div>';		
				$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$output .= '</article>';
			$i++;
		endwhile;
	$output .= '</section>';
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';	
		$output .= '</div>';
	}
	wp_reset_query(); wp_reset_postdata();
    return $output;
}
add_shortcode('rt-portfolio', 'rtp_shortcode_portfolio');

/**
 * shortcode to display latest news
 */
 
function rtp_shortcode_news( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'posts_per_page' => '6',
	'category' => '',
	'link_text' => 'More News',
	'link_url' => ''
    ), $atts));
	$output = '';
	$args = array(
			'category_name' => 'news',
			'post__in' => get_option( 'sticky_posts' ),
			'showposts' => '1',
			'order' => 'rand'
		);

	$the_query = new WP_Query( $args );
	if( $the_query->have_posts() ) { 
		while ($the_query -> have_posts()) : $the_query -> the_post();
			$thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-home-thumb');
			$output .= '<div class="sticky-post">';
			$output .= '<div class="sticky-image">';
				if($thumbail) {
					$output .= '<a href="'.$thumbail[0].'" title="'.get_the_title().'"><img src="'.$thumbail[0].'" alt="'.get_the_title().'" /></a>';
				} 
			$output .= '</div>';
			$output .= '<div class="sticky-title"><a title="'.get_the_title().'" href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a>';
			$output .= '<div class="sticky-date">'.get_the_date().'</div></div>';
			$output .= '</div>';        
		endwhile;	
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';	
		$output .= '</div>';
	}
	
	//wp_reset_query(); wp_reset_postdata();
	
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$temp = $wp_query;
    $wp_query = null;
	$args = array (
		'category_name' => 'news',
		'posts_per_page' => $posts_per_page,
		'order' => 'DESC',
		'post__not_in' => get_option("sticky_posts"),
		'paged' => $paged
    );	
    $wp_query = new WP_Query($args);
	
    if( $wp_query->have_posts() ) { 
	
	$output .= '<section class="rtp-news-container">';
	$output .= '<ul class="news links">';
		$i = 1;
		while ($wp_query->have_posts()) : $wp_query->the_post();		
			$output .= '<li class="single-news list">';
				$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$output .= '</li>';
			$i++;
		endwhile;
	$output .'</ul>';
	wp_reset_query(); wp_reset_postdata();
	$output .= '<div class="news-pagination">';
	$output .= '<span class="nav-previous">' . get_previous_posts_link('&laquo; Previous') . '</span>';
	$output .= '<span class="nav-next">' . get_next_posts_link('Next &raquo;') . '</span>';
	$output .= '</div>';
	$output .= '<div class="read-more">';	
	$output .= '<a href="'.$link_url.'">'.$link_text.'</a>';
	$output .= '</div>';
	$output .= '</section>';
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';	
		$output .= '</div>';
	}	
    return $output;
}
add_shortcode('rt-news', 'rtp_shortcode_news');

/**
 * shortcode to display partner slider
 */
 
function rtp_shortcode_partners( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'posts_per_page' => '10',
	'items_per_row' => '5',
    ), $atts));
	
	$output = '';
	wp_reset_query(); wp_reset_postdata();
	$args = array(
      'post_type' => 'partner',
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page
    );

    $the_query = null;
    $the_query = new WP_Query($args);
    if( $the_query->have_posts() ) { 
	$output .= '<section class="rtp-partners-container container">';
		$output .= '<div id="'.$items_per_row.'_rtp_carousel" class="carousel">';
			while ($the_query->have_posts()) : $the_query->the_post();
				//get thumbnail
				$thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-home-thumb');
				$output .= '<div class="partners-image item">';
					if($thumbail) {
						$output .= '<a href="'.$thumbail[0].'" title="'.get_the_title().'"><img src="'.$thumbail[0].'" alt="'.get_the_title().'"/></a>';
					} 
				$output .= '</div>';
			endwhile;
		$output .= '</div>';
	$output .= '</section>';
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';			
		$output .= '</div>';
	}
	
	wp_reset_query(); wp_reset_postdata();
    return $output;
}
add_shortcode('rt-partners', 'rtp_shortcode_partners');

/**
 * shortcode to display youtube links
 */

function rtp_shortcode_youtube_links( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'items_per_row' => '5'
    ), $atts));
	global $rtp_general;
	$youtube_links = explode(",", $rtp_general[ 'youtube_links' ]);
	$output = '';
	$output .= '<section class="rtp-youtube-links-container container">';
		$output .= '<div id="'.$items_per_row.'_rtp_carousel" class="carousel">';
		foreach($youtube_links as $key) {
			//get thumbnail
			parse_str( parse_url( $key, PHP_URL_QUERY ), $link_vars );
			$video_id = $link_vars['v'];
			$src = "http://img.youtube.com/vi/".$video_id."/0.jpg";		
			$output .= '<div class="youtube-link item">';
				$output .= '<a href="http://www.youtube.com/embed/'.$video_id.'" rel="youtube-links" class="thickbox">';
				$output .= '<img width="170" height="110" src="'.$src.'" alt=""/>';
				$output .= '<div class="hover-links"><div class="hover-youtube-icon-div"></div></div>';
				$output .= '<div class="other-box">';
				$output .= '<div class="links"><div class="youtube-icon-div"></div></div>';
				$output .= '</div>';
				$output .= '</a>';
			$output .= '</div>';	
		}
		$output .= '</div>';
	$output .= '</section>';
	return $output;
}
add_shortcode('rt-youtube-links', 'rtp_shortcode_youtube_links'); 

/**
 * shortcode to display youtube links
 */

function rtp_shortcode_container( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'width' => '100%',
	'align' => 'left'
    ), $atts));
	$output .= '';
	$output .= '<div class="rtp-container '.$align.'" style="width:'.$width.'">';
	$output .= '<div class="rtp-container-inner">' .do_shortcode($content). '</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode('rt-container', 'rtp_shortcode_container'); 

/**
 * shortcode to display page content
 */

function rtp_shortcode_page_content( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'items_per_row' => '5'
    ), $atts));
	global $rtp_general;
	wp_reset_query(); wp_reset_postdata();
	$output = '';
	
	if(isset($rtp_general[ 'page_content' ]) && !empty($rtp_general[ 'page_content' ])):
	$page_id = $rtp_general[ 'page_content' ];
	$page = get_post($page_id);
	$content = strip_tags($page->post_content);
	if (strlen($content) > 435)
    $content = substr($content, 0, 435);
	$output .= '<section class="rtp-page-content-container container">';	
	$output .= '<div class="page-content-container">';
	if (!empty($page->post_title))
		$output .= '<h3 class="page-title">'.$page->post_title.'</h3>';
	if (!empty($content)):
		$output .= '<div class="page-content">';
		if (has_post_thumbnail($page_id)){
		$thumbail = wp_get_attachment_url( get_post_thumbnail_id($page_id, 'thumbnail_size') );
		$output .= '<div class="image"><img src="'.$thumbail.'" alt=""/></div>';
		} 
		$output .= '<span class="content-text">'.$content.'</span></div>';
		if (strlen($content) >= 435){
		$output .= '<div class="page-link"><a href="'.get_page_link( $page->ID ).'">'._x( 'Read More... ', 'rtPanel' ).'</a></div>';
		}
	endif;
	$output .= '</div>';
	$output .= '</section>';	
	wp_reset_query(); wp_reset_postdata();	
	else:
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';			
		$output .= '</div>';
	endif;	
	return $output;
}
add_shortcode('rt-page-content', 'rtp_shortcode_page_content'); 

/**
 * shortcode to banner slider
 */
 
function rtp_shortcode_banner_slider( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));
	
	$output = '';
	$items_per_row = "1";
	global $rtp_general;
	if(sizeof($rtp_general[slider_images]) > 1):
	$output .= '<section class="rtp-slider-container container">';
		$output .= '<div class="slider-carousel">';
		 foreach($rtp_general[slider_images] as $key=>$value ) {
			
				$output .= '<div class="slider-image item">';
					$output .= '<a href="'.$value.'" title="'._x( 'Slider Image', 'rtPanel' ).'"><img src="'.$value.'" alt=""/></a>';
				$output .= '</div>';	
		 }
		$output .= '</div>';
	$output .= '</section>';
	else:
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p>'. _x( 'Apologies, but no results were found. ', 'rtPanel' ).'</p>';				
		$output .= '</div>';
	endif;
    return $output;
}
add_shortcode('rt-banner-slider', 'rtp_shortcode_banner_slider');
?>
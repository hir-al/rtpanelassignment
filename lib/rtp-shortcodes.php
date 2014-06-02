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
add_shortcode('title', 'rtp_shortcode_title');

/**
 * shortcode to display portfolio
 */
 
function rtp_shortcode_portfolio( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'posts_per_page' => '8',
	'items_per_row' => '4',
    ), $atts));
	
	$output = '';
	wp_reset_query();
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
	$output .'</section>';
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p> Apologies, but no results were found. </p>';
		$output .= '</div>';
	}
	wp_reset_query();
    return $output;
}
add_shortcode('portfolio', 'rtp_shortcode_portfolio');

/**
 * shortcode to display latest news
 */
 
function rtp_shortcode_news( $atts, $content = null ) {
    extract(shortcode_atts(array(
	'posts_per_page' => '-1',
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
			$output .= '<p> Apologies, but no Sticky posts were found. </p>';
		$output .= '</div>';
	}
	
	wp_reset_query();
	$args = array (
		'category_name' => 'news',
		'posts_per_page' => $posts_per_page,
		'order' => 'DESC',
		'post__not_in' => get_option("sticky_posts"),
    );

    $the_query = null;
    $the_query = new WP_Query($args);
    if( $the_query->have_posts() ) { 
	$output .= '<div class="rtp-news-container">';
	$output .= '<ul class="news">';
		$i = 1;
		while ($the_query->have_posts()) : $the_query->the_post();		
			$output .= '<li class="single-news list">';
				$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$output .= '</li>';
			$i++;
		endwhile;
	$output .'</ul>';
	$output .= '<div class="read-more">';	
	$output .= '<a href="'.$link_url.'">'.$link_text.'</a>';
	$output .'</div>';
	$output .'</div>';
	
	
	} else { 
		$output .= '<div class="post-content rtp-not-found">';
			$output .= '<p> Apologies, but no results were found. </p>';
		$output .= '</div>';
	}
	wp_reset_query();
    return $output;
}
add_shortcode('news', 'rtp_shortcode_news');
?>
<?php  
// Reference:  http://codex.wordpress.org/Widgets_API

class FooterLinksWidget extends WP_Widget
{
    function FooterLinksWidget(){
		$widget_settings = array('description' => 'List of Links Widget', 'classname' => 'widgets-links');
		parent::WP_Widget(false,$name='RTP - List Of Links Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$link1 = empty($instance['link1']) ? '' : $instance['link1'];
		$link2 = empty($instance['link2']) ? '' : $instance['link2'];
		$link3 = empty($instance['link3']) ? '' : $instance['link3'];
		$link4 = empty($instance['link4']) ? '' : $instance['link4'];
		$link5 = empty($instance['link5']) ? '' : $instance['link5'];
		$linkURL1 = empty($instance['linkURL1']) ? '' : $instance['linkURL1'];
		$linkURL2 = empty($instance['linkURL2']) ? '' : $instance['linkURL2'];
		$linkURL3 = empty($instance['linkURL3']) ? '' : $instance['linkURL3'];
		$linkURL4 = empty($instance['linkURL4']) ? '' : $instance['linkURL4'];
		$linkURL5 = empty($instance['linkURL5']) ? '' : $instance['linkURL5'];
		echo $before_widget; 
		if($title){
		echo $before_title;			
			echo $title;
		echo $after_title;
		} ?> 
		<ul class="links">
			<?php if($link1) : ?>
			<li><a href="<?php if($linkURL1 == ""): echo home_url( '/' ); else:?><?php echo $linkURL1; endif;?>" target="_blank">
				<?php echo $link1;  ?></a></li>
			<?php endif; ?>	
			<?php if($link2) : ?>
			<li><a href="<?php if($linkURL2 == ""): echo home_url( '/' ); else:?><?php echo $linkURL2; endif;?>" target="_blank">
				<?php echo $link2;  ?></a></li>
			<?php endif; ?>	
			<?php if($link3) : ?>
			<li><a href="<?php if($linkURL3 == ""): echo home_url( '/' ); else:?><?php echo $linkURL3; endif;?>" target="_blank">
				<?php echo $link3;  ?></a></li>
			<?php endif; ?>	
			<?php if($link4) : ?>
			<li><a href="<?php if($linkURL4 == ""): echo home_url( '/' ); else:?><?php echo $linkURL4; endif;?>" target="_blank">
				<?php echo $link4;  ?></a></li>
			<?php endif; ?>
			<?php if($link5) : ?>
			<li><a href="<?php if($linkURL5 == ""): echo home_url( '/' ); else:?><?php echo $linkURL5; endif;?>" target="_blank">
				<?php echo $link5;  ?></a></li>
			<?php endif; ?>						
		</ul>
		<?php
		echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link1'] =($new_instance['link1']);
		$instance['link2'] =($new_instance['link2']);
		$instance['link3'] =($new_instance['link3']);
		$instance['link4'] =($new_instance['link4']);
		$instance['link5'] =($new_instance['link5']);
		
		$instance['linkURL1'] = strip_tags($new_instance['linkURL1']);
		$instance['linkURL2'] = strip_tags($new_instance['linkURL2']);
		$instance['linkURL3'] = strip_tags($new_instance['linkURL3']);
		$instance['linkURL4'] = strip_tags($new_instance['linkURL4']);
		$instance['linkURL5'] = strip_tags($new_instance['linkURL5']);
		
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, 
		array('title'=>'Your Title',
		'link1'=>'Your link',
		'link2'=>'Your link',
		'link3'=>'Your link',
		'link4'=>'Your link',
		'link5'=>'Your link',
		'linkURL1'=>'#',
		'linkURL2'=>'#',
		'linkURL3'=>'#',
		'linkURL4'=>'#',
		'linkURL5'=>'#') );			
		$title = esc_attr($instance['title']);		
		$link1 = esc_attr($instance['link1']);	
		$link2 = esc_attr($instance['link2']);
		$link3 = esc_attr($instance['link3']);
		$link4 = esc_attr($instance['link4']);
		$link5 = esc_attr($instance['link5']);
		
		$linkURL1 = esc_attr($instance['linkURL1']);
		$linkURL2 = esc_attr($instance['linkURL2']);
		$linkURL3 = esc_attr($instance['linkURL3']);
		$linkURL4 = esc_attr($instance['linkURL4']);
		$linkURL5 = esc_attr($instance['linkURL5']);		
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>">Title:</label><input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>		
		<p><label for="<?php echo $this->get_field_id('link1');?>">Link1:</label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('link1');?>" name="<?php echo $this->get_field_name('link1');?>" ><?php echo $link1;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL1');?>">Link URL1:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL1');?>" name="<?php echo $this->get_field_name('linkURL1');?>" type="text" value="<?php echo $linkURL1;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<p><label for="<?php echo $this->get_field_id('link2');?>">Link2:</label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('link2');?>" name="<?php echo $this->get_field_name('link2');?>" ><?php echo $link2;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL2');?>">Link URL2:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL2');?>" name="<?php echo $this->get_field_name('linkURL2');?>" type="text" value="<?php echo $linkURL2;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<p><label for="<?php echo $this->get_field_id('link3');?>">Link3:</label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('link3');?>" name="<?php echo $this->get_field_name('link3');?>" ><?php echo $link3;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL3');?>">Link URL3:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL3');?>" name="<?php echo $this->get_field_name('linkURL3');?>" type="text" value="<?php echo $linkURL3;?>" />
		<label>(e.g. http://www.Google.com/...)</label><br />
		<p><label for="<?php echo $this->get_field_id('link4');?>">Link4:</label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('link4');?>" name="<?php echo $this->get_field_name('link4');?>" ><?php echo $link4;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL4');?>">Link URL4:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL4');?>" name="<?php echo $this->get_field_name('linkURL4');?>" type="text" value="<?php echo $linkURL4;?>" />
		<label>(e.g. http://www.Google.com/...)</label>	
		
		<p><label for="<?php echo $this->get_field_id('link5');?>">Link5:</label><textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('link5');?>" name="<?php echo $this->get_field_name('link5');?>" ><?php echo $link5;?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('linkURL5');?>">Link URL5:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkURL5');?>" name="<?php echo $this->get_field_name('linkURL5');?>" type="text" value="<?php echo $linkURL5;?>" />
		<label>(e.g. http://www.Google.com/...)</label>			
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("FooterLinksWidget");'));
?>
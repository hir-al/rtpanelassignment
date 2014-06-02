<?php // Reference:  http://codex.wordpress.org/Widgets_API
class DisplayImageWidget extends WP_Widget
{
    function DisplayImageWidget(){
		$widget_settings = array('description' => 'Display Image Widget', 'classname' => 'widgets-image');
		parent::WP_Widget(false,$name='RTP - Image Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$is_template_path = isset($instance['is_template_path']) ? $instance['is_template_path'] : false;
		$window_target = isset($instance['window_target']) ? $instance['window_target'] : false;
		$imageSrc = empty($instance['imageSrc']) ? '' : $instance['imageSrc'];
		$imageAlt = empty($instance['imageAlt']) ? '' : $instance['imageAlt'];
		$linkURL = empty($instance['linkURL']) ? '' : $instance['linkURL'];
		$imageAlt = empty($imageAlt) ? $title : $imageAlt;
		$imageTitle = empty($imageTitle) ? $title : $imageTitle;	
		
		if($is_template_path == 1): $imageSrc = get_template_directory_uri() . '/images/' . $imageSrc; endif; 
		echo $before_widget; 
		if($title){
		echo $before_title;			
			echo $title;
		echo $after_title;
		} ?>
		<a href="<?php if (!empty($linkURL)) echo $linkURL; else echo "#";?>" title="<?php if (!empty($imageTitle)) echo $imageTitle; else echo '';?>" target="_blank">		
			<img src="<?php echo $imageSrc; ?>" alt="<?php if (!empty($imageAlt)) echo $imageAlt; else echo '';?>" title="<?php if (!empty($imageTitle)) echo $imageTitle; else echo '';?>" />
		</a>
		<?php echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['is_template_path'] = false;
		if (isset($new_instance['is_template_path'])) $instance['is_template_path'] = true;
		$instance['imageSrc'] = strip_tags($new_instance['imageSrc']);
		$instance['imageAlt'] = strip_tags($new_instance['imageAlt']);
		$instance['imageTitle'] = strip_tags($new_instance['imageTitle']);
		$instance['linkURL'] = strip_tags($new_instance['linkURL']);
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'is_template_path' => true, 'imageAlt'=>'rtPanel',  'imageSrc'=>'footer-logo.jpg', 'linkURL'=>'#',  'imageTitle'=>'rtPanel logo') );
		$title = esc_attr($instance['title']);
		$imageSrc = esc_attr($instance['imageSrc']);
		$imageAlt = esc_attr($instance['imageAlt']);
		$imageTitle = esc_attr($instance['imageTitle']);
		$linkURL = esc_attr($instance['linkURL']);

		?>
		<p><label for="<?php echo $this->get_field_id('title');?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('imageTitle');?>">Image Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('imageTitle');?>" name="<?php echo $this->get_field_name('imageTitle');?>" type="text" value="<?php echo $imageTitle;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('imageAlt');?>">Image Alt:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('imageAlt');?>" name="<?php echo $this->get_field_name('imageAlt');?>" type="text" value="<?php echo $imageAlt;?>" /></p>
		<p><label for="<?php echo $this->get_field_id('imageSrc');?>">Image URL:<br /></label>
		<input class="widefat" id="<?php echo $this->get_field_id('imageSrc');?>" name="<?php echo $this->get_field_name('imageSrc');?>" type="text" value="<?php echo $imageSrc;?>" />
		<br /><input class="checkbox" type="checkbox" <?php checked($instance['is_template_path'], true) ?> id="<?php echo $this->get_field_id('is_template_path'); ?>" name="<?php echo $this->get_field_name('is_template_path'); ?>" /><label for="<?php echo $this->get_field_id('is_template_path'); ?>">Use Template Path for Image</label></p>
		<p><label for="<?php echo $this->get_field_id('linkURL');?>">Link URL:<br /></label>
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DisplayImageWidget");'));
?>
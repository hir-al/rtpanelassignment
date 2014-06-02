<?php  // Reference:  http://codex.wordpress.org/Widgets_API
class WordpressPagesWidget extends WP_Widget
{
    function WordpressPagesWidget(){
		$widget_settings = array('description' => 'Display Pages List Widget', 'classname' => 'widgets-pages');
		parent::WP_Widget(false,$name='RTP - List of Pages Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);	
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);		
		$pages = empty($instance['pages']) ? '' : $instance['pages']; 
		echo $before_widget; 
		if($title){
		echo $before_title;			
			echo $title;
		echo $after_title;
		} ?>
		<div class="pages-list">
			<ul class="pages links">
				<?php wp_list_pages( 'include='.$pages ); ?>
			</ul>
		</div>		
		<?php echo $after_widget;					
	}
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] =($new_instance['title']);		
		$instance['pages'] =($new_instance['pages']);	
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'pages'=>'') );
		$title = esc_attr($instance['title']);					
		$pages = esc_attr($instance['pages']);	
		?>
<p>
	<label for="<?php echo $this->get_field_id('title');?>">Title:</label>
	<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" /></p>
<p>
	<label for="<?php echo $this->get_field_id('pages');?>">Page IDs:</label>
	<textarea cols="18" rows="3" class="widefat" id="<?php echo $this->get_field_id('pages');?>" name="<?php echo $this->get_field_name('pages');?>" ><?php echo $pages;?></textarea>
</p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("WordpressPagesWidget");'));
?>
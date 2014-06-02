<?php  
// Reference:  http://codex.wordpress.org/Widgets_API
class FacebookLikesWidget extends WP_Widget
{
    function FacebookLikesWidget(){
		$widget_settings = array('description' => 'Facebook Likes Widget', 'classname' => 'widgets-facebook-likes');
		parent::WP_Widget(false,$name='RTP - Facebook Likes Widget',$widget_settings);
    }
    function widget($args, $instance){
		extract($args);		
		$title = empty($instance['title']) ? '' : $instance['title']; 
		$application_id = empty($instance['application_id']) ? '' : $instance['application_id']; 
		echo $before_widget;
		if($title){
		echo $before_title;			
			echo $title;
		echo $after_title;
		} ?> 
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?php echo $application_id; ?>&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
		<?php echo $after_widget;					
	}
	
    function update($new_instance, $old_instance){
		$instance = $old_instance;		
		$instance['title'] =($new_instance['title']);
		$instance['application_id'] =($new_instance['application_id']);	
		return $instance;
	}

    function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'Follow us on facebook', 'application_id'=>'544929572223180') );	
		$title = esc_attr($instance['title']);
		$application_id = esc_attr($instance['application_id']);
		?>
<p>
  <label for="<?php echo $this->get_field_id('title');?>">Title:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('application_id');?>">Application Id:</label>
  <input class="widefat" id="<?php echo $this->get_field_id('application_id');?>" name="<?php echo $this->get_field_name('application_id');?>" type="text" value="<?php echo $application_id;?>" />
</p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("FacebookLikesWidget");'));
?>

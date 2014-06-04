<?php

// Reference:  http://codex.wordpress.org/Widgets_API

// widget to display latest tweets

class LatestTweetsWidget extends WP_Widget
{
	function LatestTweetsWidget()
	{
		$widget_settings = array(
			'description' => 'Display Latest Tweets Widget',
			'classname' => 'widgets-latest-tweets'
		);
		parent::WP_Widget(false, $name = 'RTP - Latest Tweets Widget', $widget_settings);
	}

	function widget($args, $instance)
	{
		extract($args);
		$title = empty($instance['title']) ? '' : $instance['title'];
		$screen_name = empty($instance['screen_name']) ? '' : $instance['screen_name'];
		$number_of_tweets = empty($instance['number_of_tweets']) ? '' : $instance['number_of_tweets'];
		echo $before_widget;
		require_once (get_template_directory() . '/twitteroauth/twitteroauth.php');
		$consumerkey = "t1WccMjKpg2nsinREnekM53Ri";
		$consumersecret = "0Dts1MTo3SLyHoVM5j3rHcAQcKntkjJCryOv0tH0qfq0pnDBJS";
		$accesstoken = "2194628618-hRgx5IG4ZeVW8axJJYD729443aGxDsY886FzI86";
		$accesstokensecret = "gjLPA87Kq94xmn0ES86a62ZPruSw5XL2OYZId4ooHaD8M";
		$twitterconn = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		$latesttweets = $twitterconn->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $screen_name . "&count=" . $number_of_tweets);
		$output = '';
		$output.= '<section class="rtp-tweets-container">';
		if ($title) $output.= '<h3 class="title">' . $title . '</h3>';
		if (count($latesttweets) > 0) {
			$output.= '<div class="rtp-tweets">';
			$output.= '<ul>';
			foreach($latesttweets as $tweet) {
				$output.= '<li class="single-tweet">' . $tweet->text . '</li>';
			}
			$output.= '</ul>';
			$output.= '</div>';
		}
		else {
			$output.= '<div class="post-content rtp-not-found">';
			$output.= '<p>' . _x('Apologies, but no tweets were found. ', 'rtPanel') . '</p>';
			$output.= '</div>';
		}
		$output.= '</section>';
		echo $output;
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = ($new_instance['title']);
		$instance['screen_name'] = ($new_instance['screen_name']);
		$instance['number_of_tweets'] = ($new_instance['number_of_tweets']);
		return $instance;
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, array(
			'title' => 'Latest Tweets',
			'screen_name' => 'heer716',
			'number_of_tweets' => '5'
		));
		$title = esc_attr($instance['title']);
		$screen_name = esc_attr($instance['screen_name']);
		$number_of_tweets = esc_attr($instance['number_of_tweets']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
  <input class="widefat" id="<?php
		echo $this->get_field_id('title'); ?>" name="<?php
		echo $this->get_field_name('title'); ?>" type="text" value="<?php
		echo $title; ?>" />
</p>
<p>
  <label for="<?php	echo $this->get_field_id('screen_name'); ?>">Username:</label>
  <input class="widefat" id="<?php
		echo $this->get_field_id('screen_name'); ?>" name="<?php
		echo $this->get_field_name('screen_name'); ?>" type="text" value="<?php
		echo $screen_name; ?>" />
</p>
<p>
  <label for="<?php	echo $this->get_field_id('number_of_tweets'); ?>">Display number of Tweets:</label>
  <input class="widefat" id="<?php
		echo $this->get_field_id('number_of_tweets'); ?>" name="<?php
		echo $this->get_field_name('number_of_tweets'); ?>" type="text" value="<?php
		echo $number_of_tweets; ?>" />
</p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("LatestTweetsWidget");'));
?>

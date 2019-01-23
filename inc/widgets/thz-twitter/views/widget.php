<?php
/**
 * @package      Thz Framework
 * @author       Themezly
 * @websites     http://www.themezly.com | http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access
}
/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

$atts	= array(
	'transient' => $transient,
	'apikeys' => $instance['apikeys'],
	'consumer_key' => $instance['consumer_key'],
	'consumer_secret' => $instance['consumer_secret'],
	'access_token' => $instance['access_token'],
	'access_token_secret' => $instance['access_token_secret'],
	'twitter_id' => $instance['twitter_id'],
	'count' => $instance['count'],

);
echo $before_widget;
echo $title;

$tweets = thz_twitter_feed($atts);
?>
<?php if($tweets && is_array($tweets)) : ?>
<div class="thz-tweets-holder" id="thz_tweets_<?php echo esc_attr($widget_id); ?>">
    <ul class="thz-tweets">
        <?php foreach($tweets as $tweet): 
		
		
			$tweet_link = 'http://twitter.com/'.esc_attr($tweet->user->screen_name).'/statuses/'.esc_attr($tweet->id_str);
			$tweet_text = $tweet_limit > 0 ? substr($tweet->text,0,$tweet_limit)."..." : $tweet->text;
			$tweet_title = $tweet_link ? '<a href="'.esc_url($tweet_link).'" target="_blank">'.esc_attr($tweet_text).'</a>' : esc_attr($tweet_text) ;
		?>
        <li>
        	<div class="thz-tweet-container">
                <div class="thz-tweet-title">
                    <?php echo $tweet_title; ?>
                </div>
                <span class="thz-tweet-data">
                    <a href="<?php echo esc_url($tweet_link); ?>" target="_blank">
                        <?php echo thz_twitter_ago( $tweet->created_at ); ?>
                    </a>
                </span>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php else: ?>
<?php esc_html_e('No response from Twitter','creatus'); ?>
<?php endif; ?>
<?php echo $after_widget; ?>
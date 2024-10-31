<?
/*
Plugin Name: Plogger Badge Widget
Description: Display your Plogger photos in your widget sidebar. Based on Flickr Badge Widget by Ben Coleman; uses LastRSS library.
Author: Joshua Mostafa
Version: 0.1
Author URI: http://joshua.almirun.com/
*/
function widget_ploggerbadge_init()
{
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') ) return;

	// main widget function
	function widget_ploggerbadge($args) {
		extract($args);
			
		$options = get_option('widget_ploggerbadge');
		$title = $options['title'];
		$count = $options['count'];
		$feed = $options['feed'];
		if(!$title) $title = "Plogger Photos";
		
		// Get the contents of the RSS feed
		include_once('lastRSS.php');
		$rss = new lastRSS();
		
		$cache_dir = './wp-content/plugins/plogger-badge-widget/cache';
		$cache_time = 3600;	// one hour
		
		if (file_exists($cache_dir) && is_dir($cache_dir) && is_writable($cache_dir)) {
			$rss->cache_dir = $cache_dir;
			$rss->cache_time = $cache_time;
		}
		
		$photo_data = $rss->get($feed);
		
		echo $before_widget . $before_title . $title . $after_title;
		?>
		<div class="ploggerbadge" align="<?=$align?>">
		<!-- Start of plogger Badge -->
		<style type="text/css">
		#plogger_badge_source_txt {padding:0; font: 11px Arial, Helvetica, Sans serif; color:#FFFFFF;}
		#plogger_badge_icon {display:block !important; margin:0 !important; border: 1px solid rgb(0, 0, 0) !important;}
		#plogger_icon_td {padding:0 5px 0 0 !important;}
		.plogger_badge_image {text-align:center !important;}
		.plogger_badge_image img {border: 1px solid black !important;}
		#plogger_www {display:block; padding:0 10px 0 10px !important; font: 11px Arial, Helvetica, Sans serif !important; color:#3993ff !important;}
		#plogger_badge_uber_wrapper a:hover,
		#plogger_badge_uber_wrapper a:link,
		#plogger_badge_uber_wrapper a:active,
		#plogger_badge_uber_wrapper a:visited {text-decoration:none !important; background:inherit !important;color:#FFFFFF;}
		#plogger_badge_wrapper {}
		#plogger_badge_source {padding:0 !important; font: 11px Arial, Helvetica, Sans serif !important; color:#FFFFFF !important;}
		</style>
		<table id="plogger_badge_uber_wrapper" cellpadding="0" cellspacing="5" border="0"><tr><?php
		
		if ($photo_data) {
			$i = 0;
			foreach($photo_data['items'] as $item) {
				?><td align="center" valign="center" style="padding:0" class="plogger_badge_image" id="plogger_badge_image<?php echo $i; ?>"><a
					href="<?php echo $item['link']; ?>"><img src="<?php echo $item['guid']; ?>" alt="Plogger photo"
					title="<?php echo $item['title']; ?>"></a></td><?php
        		$i++;
        		
        		if ($i >= $count) {
        			break;
        		}
        	} 
		}
		else {
			?><td>[:: plogger badge error ::]</td><?php
		}
		
		?>
		
		
		</tr></table>
		</div>
		<!-- End of plogger Badge -->
		<?
		echo $after_widget;
	}
	
	// control panel
	function widget_ploggerbadge_control() {
		$options = $newoptions = get_option('widget_ploggerbadge');
		if ( $_POST["ploggerbadge-submit"] ) {
			$newoptions['title'] = trim(strip_tags(stripslashes($_POST["ploggerbadge-title"])));
			$newoptions['feed'] = trim(strip_tags(stripslashes($_POST["ploggerbadge-feed"])));
			$newoptions['count'] = trim(strip_tags(stripslashes($_POST["ploggerbadge-count"])));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('widget_ploggerbadge', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$count = htmlspecialchars($options['count'], ENT_QUOTES);
		$feed = htmlspecialchars($options['feed'], ENT_QUOTES);
		
		if (empty($count)) $count = '3';
		
		?>
		<table>
		<tr><td><strong>Widget Title:</strong></td>
		<td><input id="ploggerbadge-title" name="ploggerbadge-title" type="text" size="30" value="<?php echo $title; ?>" /></td>
		<td style="font-size:0.75em">Optional</td>
		</tr>
		<tr><td><strong>Feed URL:</strong></td>
		<td><input id="ploggerbadge-feed" name="ploggerbadge-feed" type="text" size="30" value="<?php echo $feed; ?>" /></td>
		<td style="font-size:0.75em">URL for the Plogger RSS feed</td>
		</tr>
		<tr><td><strong>Photo Count:</strong></td>
		<td><input id="ploggerbadge-count" name="ploggerbadge-count" type="text" size="10" value="<?php echo $count; ?>" /></td>
		<td style="font-size:0.75em">Number of photos to show</td>
		</tr>
		</table>
		<input type="hidden" id="ploggerbadge-submit" name="ploggerbadge-submit" value="1" /></div>
		<?
	}
	
	register_sidebar_widget('Plogger Badge', 'widget_ploggerbadge');
	register_widget_control('Plogger Badge', 'widget_ploggerbadge_control', 600, 330);
}

// Tell Dynamic Sidebar about our new widget and its control
add_action('plugins_loaded', 'widget_ploggerbadge_init');

?>
<?php 
/**
 * Plugin Name: JDM WP Missing Functions
 * Plugin URI: https://github.com/jdmdigital/jdm-wp-missing-functions/
 * Description: Handy-Dandy PHP functions that should've been included in wordPress, but weren't.  This plugin fixes that.
 * Version: 0.8
 * Author: JDM Digital
 * Author URI: http://jdmdigital.co
 * License: GPLv2 or later
 * GitHub Plugin URI: https://github.com/jdmdigital/jdm-wp-missing-functions/
 * GitHub Branch: master
 */

// Remove all those stupid query strings from enqued resources
function jdm_remove_script_version( $src ){ 
	return remove_query_arg( 'ver', $src ); 
} 
add_filter( 'script_loader_src', 'jdm_remove_script_version', 15, 1 ); 
add_filter( 'style_loader_src', 'jdm_remove_script_version', 15, 1 );


// one of those missing wordpress functions
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

// Return the Shorter Title for SERPs
if(!function_exists('the_shorter_title')) {
	function the_shorter_title() {
		$thetitle = get_the_title();
		$getlength = strlen($thetitle);
		$thelength = 37;
		$title = substr($thetitle, 0, $thelength);
		if ($getlength > $thelength) $title .= "...";
		return $title;
	}
}

if (!function_exists('get_mainsite_url')) {
	/* get_mainsite_url() - v1.1 by JDM Digital
	 returns the URL of the "main", parent, theme for browser caching in multisite enviroments.  Use mainsite_url() to echo.
	 Accepts 1 string parameter. 
	 Options: 
	 	get_mainsite_url('url') - Default - the URL to the main, root SITE WITHOUT the trailing slash.
	 	get_mainsite_url('theme') - the URL to the main theme root directory WITHOUT the trailing slash.
	 	get_mainsite_url('themeimg') - the URL to the main theme /img/ directory WITHOUT the trailing slash.
	 	get_mainsite_url('themejs') - the URL to the main theme /js/ directory WITHOUT the trailing slash.
	 	get_mainsite_url('themecss') - the URL to the main theme /css/ directory WITHOUT the trailing slash.
	*/
	function get_mainsite_url($param = 'url'){
		$template = get_template();
		if($param == 'theme') {
			return network_site_url().'wp-content/themes/'.$template;
		} elseif ($param == 'themeimg') {
			return network_site_url().'wp-content/themes/'.$template.'/img';
		} elseif ($param == 'themejs') {
			return network_site_url().'wp-content/themes/'.$template.'/js';
		} elseif ($param == 'themecss') {
			return network_site_url().'wp-content/themes/'.$template.'/css';
		} else {
			return network_site_url();
		}
	}
} // END if

if (!function_exists('mainsite_url')) {
	if (function_exists('get_mainsite_url')) {
		function mainsite_url($param = 'url'){
			echo get_mainsite_url($param);
		}
	}
}

// Search Suggestions Fix - http://www.relevanssi.com/knowledge-base/did-you-mean-suggestions/
if (function_exists('relevanssi_didyoumean')) {
	function fix_suggest_query($query) {
    	$query = $query . " HAVING c > 1";
    	return $query;
	}
	add_filter('relevanssi_get_words_query', 'fix_suggest_query');
}

// Echos the current page's URL
function thisURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	echo $pageURL;
}

// Makes auto-embedded videos more responsive
function jdm_responsive_embed( $html ) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'jdm_responsive_embed', 10, 3 );

// Echo Parallax Image
if(!function_exists('the_parallax') ) {
	function the_parallax(){
		$id = get_the_id();
		if ( has_post_thumbnail($id) ) { 
			// Has one. Echo the img src.
			$imgsrc =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), full);
			echo $imgsrc[0]; 
		} else {
			// Echo default image
			if(is_page()) {
				echo  get_stylesheet_directory_uri()."/img/default-page.jpg";
			} elseif(is_single()) {
			} elseif (is_category()) {
				echo  get_stylesheet_directory_uri()."/img/default-category.jpg";
			} else {
				echo  get_stylesheet_directory_uri()."/img/default.jpg";
			}
		}
	}// END Function
}

// Echo Featured Image
if(!function_exists('the_featured_image') ) {
	function the_featured_image(){
		$id = get_the_id();
		if ( has_post_thumbnail($id) ) { 
			// Has one. Echo the img src.
			$imgsrc =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), full);
			return $imgsrc[0]; 
		} else {
			// Guess at a good one.
			if(is_post_type('find_your_nearest')) {
				return  get_stylesheet_directory_uri()."/img/location-header-default.jpg"; 
			} else {
				// Echo default image 
				return  get_stylesheet_directory_uri()."/img/wca-resident-1.jpg"; 
			}
		}
	}// END Function
}

if(!function_exists('add_image_class') ) {
	// Add Image Class(es) - EX: .img-rounded or .img-circle
	function add_image_class($class){
		$class .= ' img-responsive';
		return $class;
	}
	add_filter('get_image_tag_class','add_image_class');
}

// add feed links to header
if (function_exists('automatic_feed_links')) {
	automatic_feed_links();
} else {
	return;
}

// is_child() is a {missing} wordpress function which returns bool
if(!function_exists('is_child')) {
	function is_child() {
		global $page, $post;
		
		if ( is_page($post->ID) && $post->post_parent > 0 ) { 
			return true;
		} else {
			return false;
		}
	}
}

// Pass this function the post type and it returns true or false if that's the kind of type being displayed
if(!function_exists('is_post_type')) {
	function is_post_type($type){
    	global $wp_query;
    	if($type == get_post_type($wp_query->post->ID)) return true;
    	return false;
	}
}

if(!function_exists('get_the_content_by_id')) {
	function get_the_content_by_id($id){
		if(isset($id)) {
			$content_post = get_post($id);
			$content = $content_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			return $content;
		}
	} // end function
}// end if function_exists


?>

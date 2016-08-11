<?php 
/*
Plugin Name: Fern Say Hello
Description: a super simple plugin for learning
Author: Ferran Nicolls
License: GPLv3
Version: 0.1
 */

/**
 * HTML output of the bar
 */
function fern_ab_html(){ 
	$values = get_option( 'fern_bar' );
	?>
	<!-- announcement bar by fernious -->
	<div id="fern-bar" style="background-color:<?php echo $values['bgcolor'] ?>;">
		<p><?php echo $values['bartext'] ?></p>
		<a href="<?php echo $values['bartext'] ?>"><?php echo $values['urltext'] ?></a>
	</div>
	<!-- end of announcement bar by fernious -->
<?php
}
add_action( 'wp_footer', 'fern_ab_html' );

/**
 * attach a stylesheet & js
 */
function fern_ab_style(){
	//get the url of stylesheet
	$url = plugins_url( 'fern-ab-style.css', __FILE__ );
	
	//tell WP about it and put it on the page
	wp_enqueue_style( 'fern-ab-style', $url );

	//attach jQuery
	wp_enqueue_script( 'jquery' );
	//attach custom js
	$js = plugins_url( 'fern-ab.js', __FILE__ );
	wp_enqueue_script( 'fern-ab-script', $js, array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'fern_ab_style' );

/**
 * BONUS options API
 * store the bar's settings in the db and
 * make an admin panel page to control them
 */
function fern_ab_admin_page(){
	// $page_title, $menu_title, $capability, $menu_slug, $function
	add_options_page( 'Fern Announcement Bar Options', 'Fern Say Hello', 'manage_options', 'fern-announcement-bar', 'fern_ab_admin_content' );
}
add_action( 'admin_menu', 'fern_ab_admin_page' );
//callback function for the content of the admin page
function fern_ab_admin_content(){
	include( plugin_dir_path(__FILE__) ) . 'admin-form.php';
}

//"whitelist" the group of settings so WP will allow them in db
function fern_ab_setting(){
	register_setting( 'fern_ab_group', 'fern_bar', 'fern_ab_cleaner' );
}
add_action( 'admin_init', 'fern_ab_setting' );

//callback function
function fern_ab_cleaner( $dirty ){
	//todo: clean everything
	$clean['bartext'] = wp_kses( $dirty['bartext'] );
	$clean['url'] = wp_kses( $dirty['url'] );
	$clean['urltext'] = wp_kses( $dirty['urltext'] );
	return $clean;
}







//no close php
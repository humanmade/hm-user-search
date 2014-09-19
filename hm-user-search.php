<?php
/*
Plugin Name: Hm-user-search
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: hm-user-search
Domain Path: /languages
*/

require_once plugin_dir_path( __FILE__ ) . 'classes/class-hm-user-search.php';

add_action( 'admin_init', function() {

	global $pagenow;

	if ( $pagenow && ( 'users.php' === $pagenow ) ) {
		$hm_init_user_search = HM_User_Search::get_instance();
	}

} );

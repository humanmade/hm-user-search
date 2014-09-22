<?php
/*
Plugin Name: Human Made Limited
Version: 0.1-alpha
Description: Search users by first and last name
Author: Human Made Limited
Author URI: https://hmn.md
Plugin URI: https://hmn.md
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

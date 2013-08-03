<?php
/*
Plugin Name: Quick WP Login to View
Plugin URI: http://dustyf.com
Description: 
Author: Dustin Filippini
Version: 0.1
Author URI: http://dustyf.com/
*/

/*******
 * Hide Admin Bar from roles who can't edit posts
 *******/
add_action('set_current_user', 'hide_client_login_admin_bar');
function hide_client_login_admin_bar() {
  if (!current_user_can('edit_posts')) {
    show_admin_bar(false);
  }
}

/*******
 * Don't allow our user role to wp-admin
 *******/
add_action('admin_init', 'no_client_login_dashboard');
function no_client_login_dashboard() {
  if (current_user_can('client-login') && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
  wp_redirect(site_url()); exit;
  }
}

register_activation_hook( __FILE__, 'add_client_login_role' ); 
function add_client_login_role() { 
	$client_login = add_role( 
		'client-login', 
		'Client Login', 
		array( 
			'read' => true,  
			'client-access' 
		));  
	
	$role = get_role( 'administrator' ); 
	$role->add_cap( 'client-access' );  
}

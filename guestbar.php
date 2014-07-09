<?php
/*
Plugin Name: WP Guest Bar
Description: Adds a BuddyPress-like guest bar to your WordPress site!
Version: 1.1
Author: Marco Milesi
Author Email: milesimarco@outlook.com
License:
Copyright 2013 Marco Milesi (milesimarco@outlook.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// functions and options will be added in the future
function wpgb_login_adminbar( $wp_admin_bar) {
	if ( !is_user_logged_in() ) {
		$wp_admin_bar->add_menu( array( 'title' => __( 'Log In' ), 'href' => wp_login_url() ) );
		$wp_admin_bar->add_menu( array( 'title' => __( 'Register' ), 'href' => wp_registration_url() ) );
	}
}
add_action( 'admin_bar_menu', 'wpgb_login_adminbar' );
add_filter( 'show_admin_bar', '__return_true' , 1000 );

add_action( 'admin_bar_menu', 'wpgb_remove_wp_logo', 999 );

function wpgb_remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}
?>
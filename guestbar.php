<?php
/*
Plugin Name: WP Guest Bar
Plugin URI:   https://wordpress.org/plugins/wp-guest-bar
Description: Adds a BuddyPress guest bar (login+register) to your WordPress site and show a message!
Version: 1.2
Author: Marco Milesi
Author URI:   https://wordpress.org/plugins/wp-guest-bar
Contributors: Milmor
*/

// functions and options will be added in the future
function wpgb_login_adminbar( $wp_admin_bar) {
	if ( !is_user_logged_in() ) {
        $options = get_option('wpgov_wpgb');
		$wp_admin_bar->add_menu( array( 'title' => __( 'Log In' ), 'href' => wp_login_url() ) );
		$wp_admin_bar->add_menu( array( 'title' => __( 'Register' ), 'href' => wp_registration_url() ) );
        $wp_admin_bar->add_menu( array( 'title' => $options['message'] ) );
	}
}
add_action( 'admin_bar_menu', 'wpgb_login_adminbar' );
add_filter( 'show_admin_bar', '__return_true' , 1000 );

add_action( 'admin_bar_menu', 'wpgb_remove_wp_logo', 999 );

function wpgb_remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

function wpgb_options() {
    register_setting( 'wpgov_wpgb_options', 'wpgov_wpgb' );
}
add_action( 'admin_init', 'wpgb_options');

add_action('admin_menu', 'show_wpgb_options');
function show_wpgb_options() {
	add_options_page('WP Guest Bar', 'WP Guest Bar', 'manage_options', 'wpgov_wpgb', 'wpgov_wpgb_options');
}

function wpgov_wpgb_options() {
    ?>
<div class="wrap">
    <h2>WP Guest Bar<br><small>Please remind that the bar will be shown for non-logged users only.</small></h2>
    <form method="post" action="options.php">
			<?php 
    settings_fields('wpgov_wpgb_options');
    $options = get_option('wpgov_wpgb');
            ?>
			<table class="form-table">
                <tr valign="top"><th scope="row"><label for="networkshareurl">Top Bar Message</label></th>
                    <td><input id="networkshareurl" type="text" name="wpgov_wpgb[message]" value='<?php echo $options['message']; ?>' size="80"/><br><small>You can use html. Example:<code>&lt;span style="background-color:red;color:white;padding: 5px;border-radius: 5px;"&gt;Hi User :)&lt;/span&gt;</code></small></td>
				</tr>
                
			</table>
        <p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
        
</div>
    <?php
}
?>
<?php
/**
 * Xpent functions for login and registration
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */

/**
 * this function is used to revert to shop page if a logged-in user tries to open the login or register page
 *
 * @author Saswati
 */
function xpent_add_login_check()
{
    if ( is_user_logged_in() && ( is_page( 429 ) || is_page( 438 ) ) ) {
        wp_redirect( site_url().'/shop/' );
        
    }
}

/**
 * this function is used to revert to custom login page
 *
 * @author Saswati
 */
function xpent_redirect_custom_login() {
	wp_redirect( site_url().'/user-login/' );
	
}

/**
 * this function is used to revert to custom login page if inbuild login page is called
 *
 * @author Saswati
 */
function xpent_wpadmin_redirect_custom_login() {

	global $pagenow;
	if( $pagenow == 'wp-login.php' && $_GET['action'] != 'logout' ) {
		wp_redirect( home_url().'/user-login/' );
		
	}
	
}

/**
 * this function is used to hide the wp nev menu if the loggedin user is not administrator
 *
 * @author Saswati
 */
function xpent_remove_admin_bar() {
	if ( is_user_logged_in() && !current_user_can('administrator') && !is_admin()) {
	  show_admin_bar( false );
	}
}

/**
 * this function is used to customize the nav bar based on user logged status
 *
 * @author Saswati
 */
function xpent_wp_nav_menu_args( $args = '' ) {
 
	if( is_user_logged_in() ) { 
	    $args['menu'] = 'logged-in';
	} else { 
	    $args['menu'] = 'logged-out';
	} 
    return $args;
}
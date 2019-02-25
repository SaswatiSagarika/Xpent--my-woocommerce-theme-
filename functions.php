<?php
/**
 * Xpent functions hooks and filters
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_PATH', get_template_directory() );


/* Include function Files*/
include( THEME_PATH.'/inc/theme-file.php' );
include( THEME_PATH.'/inc/theme-setup.php' );
include( THEME_PATH.'/inc/xpent-wc.php' );
include( THEME_PATH.'/inc/auth-setup.php' );
include( THEME_PATH.'/inc/ajax-setup.php' );

/* Add Action Hooks */
//add js and css files
add_action( 'wp_enqueue_scripts','xpent_include_jquery' );
add_action( 'wp_enqueue_scripts','xpent_scripts' );
add_action( 'after_setup_theme', 'xpent_theme_setup' );
add_action( 'widgets_init', 'xpent_widgets_init' );

// //create and post metabox
add_action( 'save_post', 'xpent_zip_meta_saver' );
add_action( 'add_meta_boxes', 'xpent_create_meta_box_add' );
add_action( 'manage_product_posts_custom_column', 'xpent_zip_column', 10, 2 );

// //add woocommerce functions
add_action( 'woocommerce_before_main_content', 'xpent_wc_output_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'xpent_wc_output_content_wrapper_end', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'xpent_wc_loop_product_title', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'xpent_wc_loop_product_thumbnail', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'xpent_wc_loop_rating_loop_price', 10 );
add_action( 'woocommerce_before_shop_loop', 'xpent_wc_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'xpent_wc_pagination', 10 );
add_action( 'woocommerce_before_single_product_summary', 'xpent_wc_show_product_images', 20 );
add_action( 'woocommerce_after_single_product_summary', 'xpent_wc_show_reviews', 15 );
add_action( 'woocommerce_after_single_product_summary', 'xpent_wc_output_product_data_tabs', 10 );


//actions for auth-setup
add_action( 'wp-logout', 'xpent_redirect_custom_login' );
add_action( 'init', 'xpent_wpadmin_redirect_custom_login' );
add_action( 'wp', 'xpent_add_login_check' );


//actions for ajax-setup
add_action( 'wp_enqueue_scripts', 'xpent_register_scripts', 1 );
add_action( 'wp_enqueue_scripts', 'xpent_enqueue_scripts' );
add_action( 'wp_ajax_review', 'xpent_ajax_review' );

// /* Remove Hooks */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

/* Add Filter Hooks */
add_filter( 'manage_product_posts_columns' , 'xpent_add_zip_column' );
add_filter( 'woocommerce_show_page_title', 'xpent_wc_show_page_title' );  
add_filter( 'woocommerce_product_tabs', 'xpent_wc_remove_reviews_tab', 98 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'xpent_wc_custom_cart_button_text', 10  );
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'wp_nav_menu_args', 'xpent_wp_nav_menu_args' );
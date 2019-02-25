<?php
/**
 * Xpent functions for enquequing js and css files
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */


/**
 * this function is used to enqueue jquery file
 *
 * @author Saswati
 */
function xpent_include_jquery() {
    //disable the inbuil wp jquery
    wp_deregister_script( 'jquery' );
    //enqueuing th jquery and jquesy ui files
    wp_enqueue_script( 'jquery ', THEME_URI.'/js/jquery.min.js',array(),'1.000' );

    add_action( 'wp_enqueue_scripts', 'jquery' );
}

/**
 * this function is used to enqueue js and css file
 *
 * @author Saswati
 */
function xpent_scripts() {
    //Theme css files

    wp_enqueue_style( 'a-font-awesome', THEME_URI.'/css/font-awesome.min.css',  array(), false, 'all' );
    wp_enqueue_style( 'style', get_stylesheet_uri(),  array(), false, 'all' );
    wp_enqueue_style( 'a-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-magnific', THEME_URI.'/css/magnific-popup.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-custom', THEME_URI.'/css/custom.css',  array(), false, 'all' );
    wp_enqueue_style( 'a-responsive', THEME_URI.'/css/responsive.css',  array(), false, 'all' );
    
    //Theme js files
    wp_enqueue_script( 'b-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'b-jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', array(), '1.0.0', true );
    wp_enqueue_script( 'b-fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', array(), '1.0.0', true );
    wp_enqueue_script( 'b-magnific', THEME_URI.'/js/jquery.magnific-popup.js', array(), '1.0.0', true );
    wp_enqueue_script( 'b-carousel', THEME_URI.'/js/owl.carousel.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'b-custom', THEME_URI.'/js/custom.js', array( 'jquery' ), '1.0.1', true );
    wp_enqueue_script( 'b-star-rating', THEME_URI.'/js/star-rating.js', array( 'jquery' ), '1.0.1', true );
    
    
}
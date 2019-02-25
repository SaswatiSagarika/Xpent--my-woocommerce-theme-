<?php
/**
 * Xpent functions for loclizing scripts and perform the functionlity for ajax 
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */


/**
 * this function is used to register js fucntion and localize scripts
 *
 * @author Saswati
 */
function xpent_register_scripts() {

  /** Register JavaScript Functions File */
  wp_register_script( 'functions-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'functions.js' ), array( 'jquery' ), time(), true );
 
  /** Localize Scripts */
  $phpArray = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
  wp_localize_script( 'functions-js', 'MyAjax', $phpArray );
 
}


/**
 * this function is used to enqueue the function-js
 *
 * @author Saswati
 */
function xpent_enqueue_scripts() {
	wp_enqueue_script( 'functions-js' );
}


/**
 * this function is execute the call where action is review
 *
 * @author Saswati
 */
function xpent_ajax_review() {

	if( $_POST['action'] ) {

		$data = array(
		    'comment_post_ID' 		=> $_POST['comment-product-id'],
		    'comment_author' 		=> $_POST['comment-author'],
		    'comment_author_email' 	=> $_POST['comment-email'],
		    'comment_content' 		=> $_POST['comment-message'],
		    'comment_type' 			=> 'review',
		    'user_id' 				=> $_POST['user'],
		    'comment_approved' 		=> 1,
		);

		$result = wp_insert_comment( $data );
		if( !$result ) {
			echo 'error occured while adding comment';
		} 

		$addRating = add_comment_meta( $result, 'rating', $_POST['comment-rating'] );
		if( !$addRating ) {
			echo 'error occured while adding rating';
		} 
		echo $result;

	}
}

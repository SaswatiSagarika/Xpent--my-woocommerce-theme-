<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<header class="woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="woocommerce-products-header__title-page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>
	
		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>
	</header>
	<div class="col-md-9 col-sm-8">
		<?php 

		$userId = get_current_user_id();
		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        if($userId):
            $zipcode = get_user_meta($userId, 'zip_code', true);
            $args = array(
            	'meta-query' => array(
			        array('key' => 'zip_code', 'value' => $zipcode),
			    ),
                'post_type'   => 'product',
                'post_status' => 'publish',
    			'paged'		  => $paged,
            );
        else:
            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish', 
                'paged'		  => $paged, 
            );
        endif;
		if ( get_query_var( 'product_cat' ) ) :

			$args['tax_query']  = array(
                array(
                    'taxonomy' => 'product_cat',
			      	'field' => 'slug',
                    'terms' => get_query_var( 'product_cat' ),
                )
            );

		endif; 

		if ( get_query_var( 'orderby' ) ) :
			$args['orderby'] = 'meta_value_num';
			switch ( get_query_var( 'orderby' ) ) {
				case 'rating':
					$args['meta_query'] = array(
					        array(
					            'key' => '_wc_average_rating',
					        )
					    );
					break;
				case 'popularity':
					$args['meta_query'] = array(
					        array(
					            'key' => '_wc_review_count',
					            'compare' => 'EXISTS'
					        )
					    );
					break;
				case 'price':
					$args['meta_query'] = array(
					        array(
					            'key' => '_price',
					            'compare' => 'EXISTS'
					        )
					    );
					break;
				
				default:
					$args['orderby'] =  get_query_var( 'orderby' );
					break;
			}

		endif;

		if ( get_query_var( 'order' ) ) :

			$args['order']  =  get_query_var( 'order' );

		endif; 

	    $the_query = new WP_Query( $args );
	    
		if ( $the_query->have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop', $the_query );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop', $the_query );

			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
	</div>
	<?php

		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );


		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
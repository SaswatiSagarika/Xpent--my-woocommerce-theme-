<?php
/**
 * The main template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage xpent
 * @since 1.0
 * @version 1.0
 */
  get_header(); ?>

<section class="ptb-60">
	<div class="container">
		<div class="row">
			<?php
		    global $user_ID;
	        if( $user_ID ):
	            $zipcode = get_user_meta( $user_ID, 'zip_code', true );
	            $args = array(
	                'meta_key' => 'zip_code',
	                'meta_value' => $zipcode,
	                'post_type' => 'product',
	                'post_status' => 'any',
	            );
	        else:
	            $args = array(
	                'post_type' => 'product',
	                'post_status' => 'any',
	            );
	        endif;

		    $user_posts = get_posts( $args );
		    if ( have_posts() ) : 
		        while ( have_posts() ) : the_post(); ?>
					<div class="col-xs-12 col-md-3">
						<?php the_content(); ?>
					</div>
				<?php endwhile;
			endif;?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
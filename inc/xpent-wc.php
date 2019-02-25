<?php
/**
 * Xpent functions to make changes in the woocommerce hooks
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */

/**
*outputs opening divs for the content
*
*@author Saswati
*/
function xpent_wc_output_content_wrapper() {
	echo '<section class="ptb-60"><div class="container"><div class="row">';
}

/**
*outputs closing divs for the content
*
*@author Saswati
*/
function xpent_wc_output_content_wrapper_end() {
	echo '</div></div></section>';
}

/**
*remove the page title
*
*@author Saswati
*/
function xpent_wc_show_page_title() {
	return ;
}

/**
*add the custom item title
*
*@author Saswati
*/
function xpent_wc_loop_product_title() {
	//echo '<div class="item-title"><a href="'.$the_query->get_the_permalink().'">'.$the_query->get_the_title().'</a></div>';
}

/**
*outputs product thumbnail
*
*@author Saswati
*/
function xpent_wc_loop_product_thumbnail() {
	?>
		<div class="product-image"> 
			<a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
			<div class="product-detail-inner">
				<div class="item-overlay">
					<ul>
						<li><?php woocommerce_template_loop_add_to_cart(); ?></li>
						<li><?php CWL::render_button_wishlist(); ?></li>
						<li><a href="#" title="Compare"><i class="fa fa-random"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	<?php
}

/**
*outputs ratinga and pricing fields
*
*@author Saswati
*/
function xpent_wc_loop_rating_loop_price() {

	?>
		<div class="product-item-details">
			<div class="item-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></div>
			<div class="price-box"> 
				<?php woocommerce_template_loop_price(); woocommerce_template_loop_rating(); ?>
			</div>
		</div>
	<?php
}

function xpent_wc_pagination( $theQuery) {

echo "vnisvn";
if ( $theQuery->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination">
	<?php
	
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $theQuery->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'string',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
 ?>
	
</nav>
	<?php
}

function xpent_wc_result_count( $myPosts ) {
	?>
		<p class="woocommerce-result-count">
			<?php
				$paged    = max( 1, $myPosts->get( 'paged' ) );
				$perPage  = $myPosts->get( 'posts_per_page' );
				$total    = $myPosts->found_posts;
				$first    = ( $perPage * $paged ) - $perPage + 1;
				$last     = min( $total, $myPosts->get( 'posts_per_page' ) * $paged );

				if ( 1 === $total ) {
					_e( 'Showing the single result', 'woocommerce' );
				} 
				if ( $total <= $perPage || -1 === $perPage ) {
					printf( __( 'Showing all %d results', 'woocommerce' ), $total );
				} else {
					printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
				}
			?>
		</p>
	<?php
}

function xpent_wc_show_product_images() {
	
	global $product;
	$priid 	= $product->get_id();
	$product = new WC_product( $priid );
    $attachmentIds = $product->get_gallery_attachment_ids();


	?>
		<div class="col-md-5 col-sm-5 mb-xs-30">
           	<?php if( has_post_thumbnail() ):?>
           		<div class="fotorama" data-nav="thumbs" data-allowfullscreen="native"> 

					<img src="<?php the_post_thumbnail_url( 'largest' ); ?>" class="img-fluid" style="width:100%">
					<?php foreach ( $attachmentIds as $attachmentId ):
						echo wp_get_attachment_image( $attachmentId );
					endforeach; ?>
				</div>
			<?php endif; ?>
        </div>
	<?php
}

function xpent_wc_single_title() {
	global $product;
	?>
	<div class="col-md-7 col-sm-7">
	    <div class="row">
	        <div class="col-xs-12">
	            <div class="product-detail-main">
	                <div class="product-item-details">
	                    <h1 class="product-item-name product_title entry-title" itemprop="name"><?php the_title(); ?></h1>
	                    <div class="rating-block">
	                    	<?php woocommerce_template_single_rating(); ?>
	                  	</div>
	                    <div class="price-box"> 
	                    	<span class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	                    	<?php if ( $product->is_on_sale() ) :
	       						echo $product->get_sale_price(); ?></span> 
	       						<del class="price old-price"><?php echo $product->get_price_html(); ?></del>
	    					<?php else :
	    						echo  $product->get_price_html().'</span>';
	    					endif; ?>
	                    </div>
	                    <div class="product-info-stock-sku">
	                        <div>

	                            <label>Availability: </label>
	                            <span class="info-deta" itemprop="availability"><?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?></span> 
	                        </div>
	                        <div>
	                            <label>SKU: </label>
	                            <span class="info-deta"><?php echo $product->get_sku(); ?></span> 
	                        </div>
	                    </div>
	                    <p><?php echo $product->get_short_description(); ?></p>
	                </div>
	                <div class="mb-40">
	                	<?php woocommerce_template_single_add_to_cart(); ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>    
	<?php
}

function xpent_wc_output_product_data_tabs() {
	$productTabs = apply_filters( 'woocommerce_product_tabs', array() );
	// var_dump($tabs);
	?>
		<section class="ptb-60 ptb-xs-30">
		    <div class="container">
		        <div class="product-detail-tab">
		            <div class="row">
		                <div class="col-md-12">
		                    
	                        <ul class="nav nav-tabs">
	                        	<?php foreach ( $productTabs as $key => $tab ) : ?>
	                        		<li class="<?php echo esc_attr( $key ); ?>_tab">
										<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
									</li>
	                            <?php endforeach; ?>
	                        </ul>
		                    
	                        <div class="tab_content">
	                           
                            	<?php foreach ( $productTabs as $key => $tab ) : ?>
                                	<div id="tab-<?php echo esc_attr( $key ); ?>">
                                		<p>donodnon</p>
									</div>
                            	<?php endforeach; ?>
	                          
	                        </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
          
	<?php
}

function xpent_wc_remove_reviews_tab( $tabs ) {
  unset( $tabs[ 'reviews' ] );
  return $tabs;
}

function xpent_wc_show_reviews() {
	global $product;
	$args = array (
	    'post_type' => 'product', 
	    'post_id'   => $product->get_id(),  // Product Id
	    'status' 	=> "approve", // Status you can also use 'hold', 'spam', 'trash',
	    'type'		=> 'review', 
    );
	$comments = get_comments( $args );
	?>
	<div class="comments">
	<?php foreach ( $comments as $comment ) :
			$ratingCount = get_comment_meta( $comment->comment_ID, 'rating', true );
			?>
			<div class="comment-user"> <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?></div>
			
			<div class="comment-detail">
				<div class="star-rating" title="Rated <?php echo $ratingCount; ?> out of 5">
			    	<span class="rating" style="width:<?php echo ( $ratingCount / 5 ) * 100; ?>%">
			    		<?php echo $ratingCount; ?>
			    	</span>
			    </div>
				<span>
				    <div class="user-name"><?php echo $comment->comment_author; ?></div>
				    <div class="post-date"><?php echo $comment->comment_date; ?></div>
			    </span>
			   	<div class="post-content">
			    	<p><?php echo $comment->comment_content; ?></p>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="main-form mt-30">
			<h4>Leave a comments</h4>
			<div class="row mt-30">
			    <form method="post" onsubmit="return false;" class="myform">
			    	<input id="comment-product-id" name="comment-product-id" type="hidden" value="<?php echo $product->get_id(); ?>">			    	
			    	<input id="action" name="action" type="hidden" value="review">
			    	<input id="user" name="user" type="hidden" value="<?php echo get_current_user_id(); ?>">
			    	<div class="col-xs-10 mb-30">
			    		Your rating:
			            <select name="comment-rating" id="comment-rating" required>
		                    <option value="0" selected="selected">---Select---</option>
		                    <option value="1">Poor</option>
		                    <option value="2">Below Average</option>
		                    <option value="3">Average</option>
		                    <option value="4">Good</option>
		                    <option value="5">Excellent</option>
		                </select>
			        </div>
			        <div class="col-sm-4 mb-30">
			            <input type="text" id="comment-author" name="comment-author" placeholder="Name" required>
			        </div>
			        <div class="col-sm-4 mb-30">
			            <input type="email" id="comment-email" name="comment-email" placeholder="Email" required>
			        </div>
			        <div class="col-xs-12 mb-30">
			            <textarea cols="30" id="comment-message" name="comment-message" rows="3" placeholder="Message" required></textarea>
			        </div>
			        <div class="col-xs-12 mb-30">
			            <button class="btn-black add-review">Submit</button>
			        </div>
			    </form>
			</div>
		</div>
	</div>
	<?php

}

function xpent_wc_custom_cart_button_text() {
    return __( 'Buy Now', 'woocommerce' );
}


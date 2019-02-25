<?php 
/**
 * The template for sidebar for shop page
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage xpent
 * @since 1.0
 * @version 1.2
 */
?>
<div class="col-md-3 col-sm-4 mb-xs-30">

    <?php if ( ! dynamic_sidebar( 'product-sidebar' ) ) : ?>
    <?php do_action( 'before_sidebar' ); ?>
    
        <div class="sidebar-block">
            <div class="sidebar-box listing-box mb-40">
            </div>
            <div class="sidebar-box gray-box mb-40">
                <span class="opener plus"></span>
                <div class="sidebar-title">
                    <h3>Shop by</h3>
                </div>
                <div class="sidebar-contant">
                    <div class="price-range mb-30">
                        <div class="inner-title">Price range</div>
                        <input class="price-txt" type="text" id="amount">
                        <div id="slider-range"></div>
                    </div>
                    <div class="mb-20">
                        <div class="inner-title">Category</div>
                        <ul>
                            <li><a>Bags 2 <span>(0)</span></a></li>
                            <li><a>Clothing x2 2 <span>(05)</span></a></li>
                            <li><a>Lingerie 2 <span>(10)</span></a></li>
                        </ul>
                    </div>
                    <div class="mb-20">
                        <div class="inner-title">Color</div>
                        <ul>
                            <li><a>Black <span>(0)</span></a></li>
                            <li><a>Blue <span>(05)</span></a></li>
                            <li><a>Brown <span>(10)</span></a></li>
                        </ul>
                    </div>
                    <div class="mb-20">
                        <div class="inner-title">Manufacture</div>
                        <ul>
                            <li><a>Augue congue <span>(0)</span></a></li>
                            <li><a>Eu magna <span>(05)</span></a></li>
                            <li><a>Ipsum sit <span>(10)</span></a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-color">Refine</a> 
                </div>
            </div>
            <div class="sidebar-box sidebar-item">
                <span class="opener plus"></span>
                <div class="sidebar-title">
                    <h3>Best Seller</h3>
                </div>
                <div class="sidebar-contant">
                    <ul>
                        <li>
                            <div class="pro-media"> <a><img alt="T-shirt" src="<?php echo THEME_URI;?>/images/products/item-small-1.jpg"></a> </div>
                            <div class="pro-detail-info">
                                <a>Summer Women Nice Cloth</a>
                                <div class="price-box"> <span class="price">$80.00</span> </div>
                            </div>
                        </li>
                        <li>
                            <div class="pro-media"> <a><img alt="T-shirt" src="<?php echo THEME_URI;?>/images/products/item-small-2.jpg"></a> </div>
                            <div class="pro-detail-info">
                                <a>Summer Women Nice Cloth</a>
                                <div class="price-box"> <span class="price">$80.00</span> </div>
                            </div>
                        </li>
                        <li>
                            <div class="pro-media"> <a><img alt="T-shirt" src="<?php echo THEME_URI;?>/images/products/item-small-3.jpg"></a> </div>
                            <div class="pro-detail-info">
                                <a>Summer Women Nice Cloth</a>
                                <div class="price-box"> <span class="price">$80.00</span> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>  
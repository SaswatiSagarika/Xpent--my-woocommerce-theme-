 <?php
/**
 * The template for displaying the footer
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
            <!-- FOOTER START -->
            <div class="footer">
                <div class="footer-middle">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 f-col">
                                <div class="footer-static-block">
                                    <h3 class="title">About Us</h3>
                                    <p>Lorem khaled ipsum is a major key to success. It’s on you how you want to live your life. Everyone has a choice. I pick my choice, squeaky clean. Always remember in the jungle there’s a lot of they in there, after you overcome.</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4 f-col">
                                        <div class="footer-static-block">
                                            <h3 class="title">Information</h3>
                                            <ul class="link">
                                                <li><a>About</a></li>
                                                <li><a>Contact Us</a></li>
                                                <li><a>Blog</a></li>
                                                <li><a>Affiliates</a></li>
                                                <li><a>Career</a></li>
                                                <li><a>FAQ?</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 f-col">
                                        <div class="footer-static-block">
                                            <h3 class="title">Customer care</h3>
                                            <ul class="link">
                                                <li><a>My Account</a></li>
                                                <li><a>Order Tracking</a></li>
                                                <li><a>Wishlist</a></li>
                                                <li><a>Support</a></li>
                                                <li><a>Customer Services</a></li>
                                                <li><a>Exchange</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 f-col">
                                        <div class="footer-static-block">
                                            <h3 class="title">Address</h3>
                                            <ul class="address-footer">
                                                <li class="item">
                                                    <i class="fa fa-home"> </i>
                                                    <p>1056 Arlington Avenue, Mountain View, Arkansas</p>
                                                </li>
                                                <li class="item">
                                                    <i class="fa fa-envelope-o"> </i>
                                                    <p> <a>info@expent.info</a> </p>
                                                </li>
                                                <li class="item"> <i class="fa fa-phone"> </i>
                                                    <a href="tel:+223366554">+223366554</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 center-sm">
                                <div class="copy-right">© 2018  All Rights Reserved. Design By <a href="http://themespry.com/">Themespry</a></div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="payment float-none-xs center-sm">
                                    <img src="<?php echo  THEME_URI; ?>/images/payment-method.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-top">
                <div id="scrollup"></div>
            </div>
            <!-- FOOTER END --> 
            </div>
        <?php wp_footer(); ?>
    </body>
    <script type="text/javascript">
        $( document ).ready( function(){
            var getData = [];

            $( '.woocommerce-ordering' ).on( 'change', 'select.orderby', function() {
                $( this ).closest( 'form' ).submit();
            });

            $( '.add-review' ).click( function( e ) {
                e.preventDefault();
                var postId = $( '#comment-product-id' ).val();
                var ajaxaction = $( '#action' ).val();
                var user = $( '#user' ).val();
                var rating = $( '#comment-rating' ).val();
                var author = $( '#comment-author' ).val();
                var email = $( '#comment-email' ).val();
                var message = $( '#comment-message' ).val();
             
                $( ".error" ).remove();
             
                if ( author.length < 1 ) {
                  $( '#comment-author' ).after( '<span class="error">This field is required</span>' );
                }
                if ( rating.length < 1 ) {
                  $( '#comment-rating' ).after( '<span class="error">This field is required</span>' );
                }
                if ( email.length < 1 ) {
                  $( '#comment-email' ).after( '<span class="error">This field is required</span>' );
                } else {
                  var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@( ?:[A-Z0-9-]{1,63}\. ){1,125}[A-Z]{2,63}$/;
                  var validEmail = regEx.test( email );
                  if ( !validEmail ) {
                    $( '#email' ).after( '<span class="error">Enter a valid email</span>' );
                  }
                }
                if ( error == '' ) {
                   formData = $( 'form' ).serialize();
                   
                    $.ajax( {
                        cache: false,
                        type: "POST",
                        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                        data: formData ,
                        success:function( response ){
                            $( '#myform' )[0].reset();
                            comment = response;
                            row =  "<div class='comment-user'>"+
                                    "<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>"+
                                    +"</div>"+
                                    "<div class='comment-detail'>"+
                                        "<div class='star-rating' title='Rated"+ rating+"out of 5'>"+
                                            "<span class='rating' style='width:"+( rating / 5 ) * 100; +"%'>"+
                                               rating
                                            "</span>"+
                                        "</div>"+
                                        "<span>"+
                                            "<div class='user-name'>"+author+"</div>"+
                                            "<div class='post-date'>"+
                                        "<div class='post-content'>"+
                                            "<p>"+message+"</p>"+
                                        "</div>"+
                                    "</div>";
                            $("div.comments").append(row);
                        },
                        error:function ( xhr, textStatus, errorThrown ){
                           console.log( xhr );
                        }
                    });
                }
            });
        });
    </script>
</html>
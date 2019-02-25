<?php
/**
 * Xpent functions for setting up the theme and widget
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Xpent
 * @since 1.0
 */


/**
 * this function is used for adding theme support
 *
 * @author Saswati
 */
function xpent_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/xpent
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'xpent' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'xpent' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* Woocommerce plugin*/
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'xpent-featured-image', 2000, 1200, true );

	add_image_size( 'xpent-thumbnail-avatar', 100, 100, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'    => __( 'Primary Menu', 'xpent' ),
		'cat-nav'   	  => __( 'Categories','xpent' )
	) );

}

/**
 *create metabox for product and product variation
 *
 * @var $postId
 * @author Saswati
 */
function xpent_create_meta_box( $postId ) {
	$values = get_post_custom( $postId );
	$text = isset( $values['zip_code'] ) ? esc_attr( $values['zip_code'][0] ) : '12345';
	wp_nonce_field( 'xpent_create_zip_box', 'xpent_create_zip_box_nonce' );
    ?>
    <p>
        <label for="zip_code">Enter Zip Code</label>
        <input type="text" name="zip_code" id="zip_code" value="<?php echo $text; ?>" required />
    </p>
  	<?php 
}

/**
 *create metabox for product and product variation
 *
 *@author Saswati
 */
function xpent_create_meta_box_add() {
    add_meta_box( 'zip-meta-box', 'Add Zip Code ', 'xpent_create_meta_box', 'product', 'side', 'low' );
    add_meta_box( 'zip-meta-box', 'Add Zip Code ', 'xpent_create_meta_box', 'product_variation', 'side', 'low' );
}

/**
 *create metabox for post data in database
 *
 *@var $postId
 *@author Saswati
 */
function xpent_zip_meta_saver( $postId ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if( !current_user_can( 'edit_pages' ) ) {
        return;
    }
    if ( !isset( $_POST['xpent_create_zip_box_nonce'] ) || !wp_verify_nonce( $_POST['xpent_create_zip_box_nonce'], 'xpent_create_zip_box' ) ) {
        return $postId ;
    }
    $zipCode = ( isset( $_POST['zip_code'] ) ) ? $_POST['zip_code'] : '';
    $zipCodes = explode( ",", $zipCode );
    foreach ( $zipCodes as $zip ) {
        if( !metadata_exists( 'zip_code', $postId, $zip ) ) {
            add_post_meta( $postId, 'zip_code', $zip );
        } 
    }
}

/**
 * this function is used to add zip column in product table
 *
 * @var $columns
 * @author Saswati
 */
function xpent_add_zip_column( $columns ) {
	
	return array_merge( $columns, array(
        'zip' => __( 'ZIP' )
        )
    );

}

/**
 * this function is used to enqueue jquery file
 *
 * @var $columns
 * @var $postId
 * @author Saswati
 */
function xpent_zip_column( $column, $postId ) {
  if ( 'zip' === $column ) {
        $array =  get_post_meta( $postId ,'zip_code' ); 
        echo implode( ",", $array );
    }
}

/**
 * Register widget area.
 *
 * @author Saswati
 */
function xpent_widgets_init() {
	
	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'xpent' ),
		'id'            => 'product-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'xpent' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'xpent' ),
		'id'            => 'footer-one-sidebar',
		'description'   => __( 'Add widgets here to appear in your footer.', 'xpent' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'xpent' ),
		'id'            => 'footer-two-sidebar',
		'description'   => __( 'Add widgets here to appear in your footer.', 'xpent' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header 1', 'xpent' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your header.', 'xpent' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

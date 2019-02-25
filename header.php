<?php 
/**
 * The template for displaying the header
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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' );?>">
        <!-- SEO Meta
            ================================================== -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Specific Metas
            ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
            ================================================== -->
        <link rel="shortcut icon" href="<?php echo THEME_URI; ?>/images/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo THEME_URI; ?>/images/apple-touch-icon.html">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo THEME_URI; ?>/images/apple-touch-icon-72x72.html">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo THEME_URI; ?>/images/apple-touch-icon-114x114.html">
        <?php wp_head(); ?>
    </head>
    <body class="common-home">
        <div class="main">
        <!-- HEADER START -->
        <header class="navbar navbar-custom" id="header">
            <div class="header-bottom">
                <div class="container position-r">
                    <div class="row m-0">
                        <div class="col-md-3 position-i p-0">
                            <a class="navbar-brand page-scroll" href=""> 
                                <img alt=" " src="<?php echo THEME_URI; ?>/images/logo.png"> 
                            </a> 
                        </div>
                        <div class="col-md-9 p-0">
                            <div class="nav_sec position-r">
                                <div class="mobilemenu-title mobilemenu">
                                    <span>Menu</span>
                                    <i class="fa fa-bars pull-right"></i>
                                </div>
                                <?php 
                                    wp_nav_menu( 
                                        array(
                                            'theme_location' => 'primary-menu',
                                            'menu_class' => 'nav navbar-nav',
                                            'menu_id' => 'menu-main',
                                            'container_class' => 'mobilemenu-content',
                                        )
                                    );
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
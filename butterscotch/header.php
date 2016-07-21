<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php

    global $page, $paged;

    wp_title( '|', true, 'right' );

    bloginfo( 'name' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );

    ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/styles.css" />
<link href='http://fonts.googleapis.com/css?family=Glegoo|Noto+Sans:400,700,400italic,700italic|Lato:400,900|Crimson+Text:400,400italic,700' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/init.js"></script>

<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>

<?php include('ga.php'); ?>
</head>

<body <?php body_class(); ?>>

<!-- Facebook JS SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

 <div class="page-container clearfix">

    <header id="site-head" class="cf">
    	<div class="content-container">

                <img src="<?php bloginfo( 'template_url' ); ?>/images/img_icon_row.png" alt="Tasting Notes" style="vertical-align: middle;" />
                <span class="site-title"> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
                <span class="site-desc"><?php bloginfo( 'description' ); ?></span>

            <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
            <nav>
                <ul>
                    <li>
                        <a id="nav-ws" href="<?php bloginfo('url'); ?>/category/wine-sake/" class="wine-sake">Wine & Sak&#201;</a>
                    </li><li>
                        <a id="nav-sc" href="<?php bloginfo('url'); ?>/category/spirits-cocktails/" class="spirits-cocktails">Spirits & Cocktails</a>
                    </li><li>
                        <a id="nav-f" href="<?php bloginfo('url'); ?>/category/food/" class="food">food</a>
                    </li><li>
                        <a id="nav-n" href="<?php bloginfo('url'); ?>/category/news/" class="news">news</a>
                    </li><li>
                    	<a href="#" class="misc"><i class="icon-align-justify icon-white"></i></a>
                        <ul class="unstyled">
                        	<li><a href="<?php bloginfo('url'); ?>/contributors/">Contributors</a></li>
                            <li><a href="<?php bloginfo('url'); ?>/about/">About</a></li>
                        </ul>
                    </li>
                </ul> <!-- run li tags together to avoid 4px right-margin from inline-block -->
            </nav>
        </div>

    </header>

<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

<div class="content-container">
    <div class="page-title-container">		
    <?php get_search_form( $echo ); ?>
        <h1 class="page-title"><?php
            printf( __( '%s', 'starkers' ), '' . single_cat_title( '', false ) . '' );
        ?></h1>
    </div>        
        <?php
            $category_description = category_description();
            if ( ! empty( $category_description ) )
                echo '' . $category_description . '';

        get_template_part( 'loop', 'hub' );
        ?>
</div> <!-- .content-container -->
<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Butterscotch
 * @since Butterscotch 1.0
 */

get_header(); ?>

	<div class="hub-page content-container">
      <div class="page-title-container">
		  <?php get_search_form( $echo ); ?>
          <h1 class="page-title"><?php printf( __( '%s', 'starkers' ), '' . single_cat_title( '', false ) . '' ); ?></h1>
      </div>

        <div class="hub">
            <div class="column-container">
                <?php
                    $category_description = category_description();
                    if ( ! empty( $category_description ) )
                        echo '' . $category_description . '';

                get_template_part( 'loop', 'hub' );
                ?>
            </div>
            <div class="perenial col3">
                <ul>                                                         
                    <li>
                        <ul>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/astorwines-news/">Astor Wines News</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/astorwinesevents/">Astor Wines Events</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/astorcenter-news/">Astor Center News</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/astorcenter-events/">Astor Center Events</a></h3></li>
                        </ul>    
                    </li>
                </ul>
            </div>

        </div> <!-- .hub -->
                
	</div> <!-- .content-cotnainer --?
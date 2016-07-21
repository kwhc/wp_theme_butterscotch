<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
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
                <?php 
					$args = array(
                    'posts-per-page' => 1,
                    'category__and' => array(12,10)
                	);
                
                	$my_query = new WP_Query( $args );
                	while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li>
                     <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_tip.png" class="icon" />tip Jar</h3>
                    <article class="teaser">
                      <?php the_content(); ?>
                    </article> 
                </li>     
                <?php endwhile; ?>
  
                 <!-- New & Approved --> 
                <?php $my_query = new WP_Query('cat=16&posts_per_page=1');
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                        <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_check.png" class="icon" /><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
                        <article class="teaser">
                          <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                          <?php the_excerpt(); ?>
                         </article>
                     </li> 
                <?php endwhile; ?>
                 
                <!-- Wines We Love -->  
                <?php $args = array(
                	'posts_per_page' => 1, 'cat' => 14);
                	$my_query = new WP_Query( $args );
                	while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                        <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_love.png" class="icon" /><?php $category = get_the_category(); echo $category[1]->cat_name; ?></h3>
                        <article class="teaser">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                          <?php the_excerpt(); ?>
                        </article>    
                        </li>      
                <?php endwhile; ?>
                
                <!-- Booze for Thought -->
                <?php $my_query = new WP_Query('cat=18&posts_per_page=1');
                	while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                    <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_thought.png" class="icon" /><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
                      <article class="teaser">
                      <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                      <?php the_excerpt(); ?>
                      </article>
                     </li>
                <?php endwhile; ?>
                  
                  <li>
                      <ul>
                          <li><h3><a href="<?php bloginfo('url'); ?>/category/winegeek/">Wine Geek</a></h3></li>
                          <li class="hide"><h3><a href="<?php bloginfo('url'); ?>/category/sakegeek/">Sak&#201; Geek</a></h3></li>
                          <li><h3><a href="<?php bloginfo('url'); ?>/category/newandapproved-wineandsake/">New & Approved</a></h3></li>
                          <li><h3><a href="<?php bloginfo('url'); ?>/category/siponthis/">Booze For Thought</a></h3></li>
                          <li><h3><a href="<?php bloginfo('url'); ?>/category/wineswelove/">Wines We Love</a></h3></li>
                          <li class="hide"><h3><a href="<?php bloginfo('url'); ?>/category/sakewelove/">Sak&#201;s We Love</a></h3></li>
                          <li><h3><a href="<?php bloginfo('url'); ?>/category/meetthemaker/">Meet the Maker</a></h3></li>
                      </ul>    
                  </li>
              </ul>
          </div>
  
      </div>
                
	</div> <!-- .content-container -->
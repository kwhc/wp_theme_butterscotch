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
                  <?php $args = array('posts_per_page' => 1,'category__and' => array(12, 16));
                  $my_query = new WP_Query( $args );
                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <li>
                    <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_f_tip.png" class="icon" />Tip Jar</h3>
                    <article class="teaser">
                      <?php the_content(); ?>
                    </article>
                  </li>
                  <?php endwhile; ?>
                  
                  <!-- Recipe Card -->  
                  <?php $my_query = new WP_Query('cat=22&posts_per_page=1');
                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <li>
                      <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_f_recipe.png" class="icon" /><?php $category = get_the_category(); echo $category[1]->cat_name; ?></h3>
                      <article class="teaser">
                            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                            <?php the_excerpt(); ?>
                      </article>
                  </li>
                  <?php endwhile; ?>
					
                    <!-- Pairings -->	
                  <?php $my_query = new WP_Query('cat=23&posts_per_page=1');
                      while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <li>
                    <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_f_pairing.png" class="icon" />Pairings</h3>
                    <article class="teaser">
                      <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                      <?php the_excerpt(); ?>
                    </article>  
                  </li>
                  <?php endwhile; ?>
                  
                  <!-- Local Flavor -->
				  <?php $args = array('posts_per_page' => 1, 'category__in' => array(25, 24, 27)); //Dine & Dish, Neighborhood Spotlight, Best of NYC
                   $my_query = new WP_Query( $args );
                      while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <li>
                      <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_f_flavor.png" class="icon" />Local Flavor</h3>
                      <article class="teaser">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                      </article>  
                    </li>
                    <?php endwhile; ?>
                    
                    <li>
                        <ul>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/dineanddish-food/">Dine &amp; Dish</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/chewonthis/">Chew On This</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/bestofnyc/">Best of NYC</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/neighborhoodspotlight/">Neighborhood Spotlight</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/pairings/">Pairings</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/recipecard/">Recipe Card</a></h3></li>
                        </ul>    
                    </li>
                </ul>
            </div>

        </div> <!-- .hub -->
                
	</div> <!-- .content-cotnainer --?>
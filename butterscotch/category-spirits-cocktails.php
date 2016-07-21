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
			  <?php $args = array('posts_per_page' => 1,'category__and' => array(3, 58));	
              $my_query = new WP_Query( $args );
              while ($my_query->have_posts()) : $my_query->the_post(); ?>
              <li>
                  <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_sc_tip.png" class="icon" />Tip Jar</h3>
                  <article class="teaser">
                  	<?php the_content(); ?>
                  </article>
              </li>     
              <?php endwhile; ?>
    			
                <!-- New & Approved -->
				<?php $my_query = new WP_Query('cat=5&posts_per_page=1');
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li>
                    <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_sc_check.png" class="icon" />New + Approved</h3>
                    <article class="teaser">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    </article>  
                </li>
                <?php endwhile; ?>
    			
                <!-- Spirits We Love -->
				<?php $my_query = new WP_Query('cat=4&posts_per_page=1');
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                 <li>
                	<h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_sc_love.png" class="icon" />Spirits We Love</h3>
                        <article class="teaser">
                          <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                          <?php the_excerpt(); ?>
                         </article> 
                 </li>
                 <?php endwhile; ?>
                
                <!-- Recipe Card --> 
				<?php $my_query = new WP_Query('cat=11&posts_per_page=1');
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li>
                    <h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_sc_recipe.png" class="icon" />Recipe Card</h3>
                        <article class="teaser">
                          <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                          <?php the_excerpt(); ?>
                        </article>  
	                </li>
                    <?php endwhile; ?>
                    <li>
                        <ul>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/siponthisspirits/">Sip On This</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/spiritsgeek/">Spirits Geek</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/cocktailrecipecard/">recipe Card</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/spiritswelove/">Spirits We Love</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/newandapproved/">New & Approved</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/dineanddish/">Dine & Dish</a></h3></li>
                            <li><h3><a href="<?php bloginfo('url'); ?>/category/cocktailvideo/">Cocktail Videos</a></h3></li>
                        	<li><h3><a href="<?php bloginfo('url'); ?>/category/cocktailgeek/">Cocktail Geek</a></h3></li>
                        </ul>    
                    </li>
            </ul>
        </div>
    
    </div> <!-- .hub -->
                
	</div> <!-- .content-cotnainer -->
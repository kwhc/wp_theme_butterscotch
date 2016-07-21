<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>
 
 	<div class="index content-container">
    	
        <div class="">
        
		<div class="column-container clearfix">
        
        <div class="marquee">
        	<div class="marquee-mask">
			  <?php 
              $args = array('posts_per_page' => 1,'tag' => 'feature');                
              $my_query = new WP_Query( $args );
              while ($my_query->have_posts()) : $my_query->the_post(); ?>

                <article id="marqueeCopy">
                    <h4><?php child_cat_link(); ?></h4>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/marquee/<?php echo the_ID(); ?>.jpg" alt="<?php the_title(); ?>" /></a>
            
            <script>
				$(document).ready(function(){
					$('#marqueeCopy').hover(
						function(){
							$('#marqueeCopy').animate({bottom: '0px'}, 200);
						},
						function(){
							$('#marqueeCopy').animate({bottom: '-210px'}, 200); //matches .marquee article {bottom}
						}
					);
				});
			</script>
            <?php endwhile; ?>
            </div>
   		</div>

        
			<?php get_template_part( 'loop', 'hub' );  ?>
        </div>
        
        <div class="perenial col3">
        	<ul>
            	<li class="search">
		  			<?php get_search_form( $echo ); ?>
                </li>
            
                <?php 
				$args = array('posts_per_page' => 1,'cat' => 58);                
                $my_query = new WP_Query( $args );
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
            	<li class="category-wine-sake">
                	<h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_tip.png" class="icon" />tip jar</h3>
                    <article class="teaser">
                      <?php the_content(); ?>
                    </article>
                </li>
                <?php endwhile; ?>
                
                <?php 
				$args = array('posts_per_page' => 1,'cat' => 96,'orderby' => 'modified');                
                $my_query = new WP_Query( $args );
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
            	<li class="category-news">
                	<h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_n_store.png" class="icon" />What's in store</h3>
                    <article class="teaser">
                    	<?php tuesday_sale_bar(); ?>
                    	<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                      	<?php the_excerpt(); ?>
                    </article>
                </li>
                <?php endwhile; ?>

            	<li class="category-news">
                	<h3><img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_n_events.png" class="icon" />upcoming events</h3>                
                <?php 
				$args = array('posts_per_page' => 3,'category__in' => array(29,30));                
                $my_query = new WP_Query( $args );
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <article class="teaser">
                      <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					  <?php the_excerpt(); ?>
                    </article>
                <?php endwhile; ?>
                </li>
                
            </ul>
        </div>
        </div>
 	</div> <!-- .content-container -->
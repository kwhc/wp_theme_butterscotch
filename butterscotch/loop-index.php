<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
 
 <div class="content-container hub">
     
    <?php /* If there are no posts to display, such as an empty archive page */ ?>
    
	<?php if ( ! have_posts() ) : ?>
            <h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
                <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'starkers' ); ?></p>
                <?php get_search_form(); ?>
    <?php endif; ?>
     
    <?php while ( have_posts() ) : the_post(); ?>
    <?php if (in_category(28)) { continue; } //Skip news posts ?>

    <?php /* How to display posts of the Booze for Thought. */ ?>
     
        <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
         
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
                <header>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                </header>
              
        <?php the_excerpt(); ?>
      
                <footer>
                </footer>
            </article>
     
     
    <?php /* How to display all other posts. */ ?>
     
        <?php else : ?>
         
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>

                  <header>
                      <hgroup>
                          <h4><?php child_cat(); ?> | <?php starkers_posted_on(); ?></h4>
                          <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>     
                      </hgroup>
                  </header>
                    
                    <?php the_excerpt(); ?>
         
                <footer>
                    <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>                     
                </footer>
            </article>
     
                <?php comments_template( '', true ); ?>
     
        <?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
     
    <?php endwhile; // End the loop. Whew. ?>
     
    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <nav>
            <?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
            <?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
        </nav>
    <?php endif; ?>
</div> <!-- .content-container -->	
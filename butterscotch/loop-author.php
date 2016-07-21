<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
 
 <div>
     
    <?php /* If there are no posts to display, such as an empty archive page */ ?>
    <?php if ( ! have_posts() ) : ?>
            <h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
                <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'starkers' ); ?></p>
                <?php get_search_form(); ?>
    <?php endif; ?>
     
    <?php while ( have_posts() ) : the_post(); ?>
          
    <?php /* How to display all other posts. */ ?>
             
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                  <header>
                      <hgroup>
                          <h4><?php child_cat(); ?></h4>
                          <h2><?php the_title(); ?></h2>     
                      </hgroup>
                  </header>
                  </a>
             </article>
               
    <?php endwhile; // End the loop. Whew. ?>
     
    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <nav class="paging-nav">
            <?php //next_posts_link( __( '<h2 class="viewmore">View More Posts</h2>', 'starkers' ) ); ?>
            <?php //previous_posts_link( __( '<h2 class="viewmore">View Previous Posts</h2>', 'starkers' ) ); ?>
        </nav>
    <?php endif; ?>
</div> <!-- .content-container -->	
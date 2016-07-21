<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Butterscotch
 * @since Butterscotch 1.0
 */
?>
 
    
    <?php /* If there are no posts to display, such as an empty archive page */ ?>
    <?php if ( ! have_posts() ) : ?>
            <h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
           	<p><?php _e( 'Sorry, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'starkers' ); ?></p>
            <?php get_search_form(); ?>
    <?php endif; ?>

     <?php  ### Needs WP_Query_Columns --- see http://wordpress.stackexchange.com/q/9308/178
		$query_copy = clone $wp_query; // save to restore later
		
		global $query_string; //Keep existing query
		query_posts($query_string . '&cat=-58'); //Hide tip jar everywhere
		if (is_home()) {query_posts($query_string . '&cat=-28,-58');} //If home hide news and tip jar
	
		foreach( new WP_Query_Columns($wp_query, 4) as $columns_index => $column_count ) : ?>
        
     <ul class="loop-column">
        <?php while ( $column_count-- ) : the_post(); ?>
        <?php //if (in_category(12)) { continue; } //Skip tip-jar posts ?>
    	<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>
        <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
         
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
                <header>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                </header>
     
				<?php if ( post_password_required() ) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                <?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
                    if ( $images ) :
                        $total_images = count( $images );
                        $image = array_shift( $images );
                        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
                        
                        <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
                         
                        <p><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'starkers' ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images )); ?></p>
                
                <?php endif; ?>
                     
                    <?php the_excerpt(); ?>
                 
                <?php endif; ?>
     
                <footer>
                    <?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
                    <a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'starkers' ); ?>"><?php _e( 'More Galleries', 'starkers' ); ?></a> | 
                    
                    <?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
                    <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'starkers' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'starkers' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a> | 
                    
                    <?php endif; ?>
                    
                    <?php comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>
                    <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>
                </footer>
            </article>
     
    	<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>
        <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'starkers' ) )  ) : ?>
         
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
     
            <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
                    <?php the_excerpt(); ?>
            <?php else : ?>
                    <?php the_content( __( 'Continue reading &rarr;', 'starkers' ) ); ?>
            <?php endif; ?>
             
                <footer>
                    <?php starkers_posted_on(); ?> | <?php comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?> <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>
                </footer>
            </article>
            
    	<?php /* How to display all other posts. */ ?>     
        <?php else : ?>
         	<li>
            <article id="post-<?php the_ID(); ?>" <?php post_class('teaser cf'); ?>>
            	<div class="img-container">
            	<?php if ( has_post_thumbnail() && has_tag('bottle') ) : ?>
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('teaser-bottle'); ?></a>
                <?php elseif ( has_post_thumbnail()) : ?>
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
                <?php endif; ?>
               	</div>

                <div class="body-container">
                    <header>
                        <hgroup>
                            <h4><?php child_cat_link(); ?></h4>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>     
                        </hgroup>
                    </header>
         
                        <?php the_excerpt(); ?>
             
                    <footer>
                                              
                        <?php //comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>
                                             
                    </footer>
              </div> <!-- .body-container -->

            </article>
     
                <?php comments_template( '', true ); ?>
     		</li>
        <?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
        <?php endwhile; ?>
    </ul>       
<?php endforeach; ?>
<?php $wp_query = $query_copy;?>

          
    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if (  $wp_query->max_num_pages > 1 && ! is_home() ) : ?>
        <nav class="paging-nav">
            <?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
            <?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
        </nav>        
    <?php endif; ?>    

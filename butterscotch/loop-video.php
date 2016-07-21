<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content-container cf">
            
            	<div class="article-body">
                    <header>
                        <hgroup>
                            <h4><?php starkers_posted_on(''); ?>&nbsp;|&nbsp; <?php child_cat() ?></h4>
                            <h1><?php the_title(); ?></h1>
                        </hgroup>
                    </header>
        
                    <?php the_content(); ?>
                    
               		<?php comments_template( '', true ); ?>

                </div> <!-- .article-body -->
            
            </div>
					
			<footer>
            	<div class="content-container">
                    <ul>
                        <li class="meet-the-author container">
                            <h4>Meet the Author</h4>
                            <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 60 ) ); ?>
                                <h3><?php printf( esc_attr__( 'About %s', 'starkers' ), get_the_author() ); ?></h3>
                                <p></p>
                                  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                      <?php printf( __( 'View all posts by %s &rarr;', 'starkers' ), get_the_author() ); ?>
                                  </a>
                            <?php endif; ?>
        
                        </li> <!-- .meet-the-author -->
                        <li class="pairings container">
                            <h4>Pairings for this Post</h4>
                        </li>
                        <li class="related-posts container">
                            <h4>Related Posts</h4>
                        </li>
                    </ul>
                </div>
				<?php edit_post_link( __( 'Edit', 'starkers' ), '', '' ); ?>
			</footer>
	</article>

<?php endwhile; // end of the loop. ?>
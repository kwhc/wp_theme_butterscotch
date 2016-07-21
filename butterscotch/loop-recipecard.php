<?php
/**
 * The loop that displays a Recipe Card post.
 *
 * @package WordPress
 * @subpackage Butterscotch
 * @since Butterscotch 1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <div class="prep-switch">
       		<p>Prep View</p>
        </div>
        
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="content-container cf">
	
                <div class="page-title-container"><h1 class="page-title"><?php echo the_category(' &gt; '); ?></h1></div>
	
                <div class="col1">
                    <h4></h4>
                    <?php the_post_thumbnail( 'article-main', array('class' => 'article-gallery') ); ?> 
                </div> <!-- .gallery -->
				<script>
                    var image = document.querySelector('.article-gallery');
                    var origOffsetY = image.offsetTop;
                    
                    function onScroll(e){
                        window.scrollY >= origOffsetY ? image.classList.add('sticky-img') : image.classList.remove('sticky-img');
                    }
                    
                    document.addEventListener('scroll', onScroll);
                </script>

                
                <div class="article-body col2">
                    <header>
                        <hgroup>
                            <h1><?php the_title(); ?></h1>
                            <h4><?php starkers_posted_on(''); ?></h4>
                        </hgroup>
                    </header>
        
                    <?php the_content(); ?>
        
                    <?php comments_template( '', true ); ?>
                </div>
                
                <div class="article-recipecard col3">
                    <h4></h4>
                    <div class="recipe-card">
                    <h4><? if( get_post_meta( $post->ID, 'r_title', true )) :?>	<? echo get_post_meta( $post->ID, 'r_title', true ) ?><? endif; ?></h4>
                    <p> 						
                        <ul>
                        	<li><? if( get_post_meta( $post->ID, 'r_ing1', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing1', true ) ?><? endif; ?></li>
                            <li><? if( get_post_meta( $post->ID, 'r_ing2', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing2', true ) ?><? endif; ?></li>
                            <li><? if( get_post_meta( $post->ID, 'r_ing3', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing3', true ) ?><? endif; ?></li>
                            <li><? if( get_post_meta( $post->ID, 'r_ing4', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing4', true ) ?><? endif; ?></li>
                            <li><? if( get_post_meta( $post->ID, 'r_ing5', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing5', true ) ?><? endif; ?></li>
                            <li><? if( get_post_meta( $post->ID, 'r_ing6', true )) :?>	<? echo get_post_meta( $post->ID, 'r_ing6', true ) ?><? endif; ?></li>

                        </ul>
                    </p>
                    <p> <? get_post_meta( $post->ID, "ingredient1", true ); ?></p>
                    </div>
                </div> <!-- .card -->
            </div>		
			<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
		
			<?php include('article-footer.php'); ?>				
		</article>

<!--
		<nav>
			<?php // previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
			<?php // next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
		</nav>
-->

<?php endwhile; // end of the loop. ?>
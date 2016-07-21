<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>
 
<div class="author-profile content-page content-container cf">
<?php
    if ( have_posts() )
        the_post();
?>

    <div class="page-title-container"><?php get_search_form( $echo ); ?><h1 class="page-title">Meet the author</h1></div>
	<div class="page-content cf"> 
	<?php
    // If a user has filled out their description, show a bio on their entries.
    if ( get_the_author_meta( 'description' ) ) : ?>
        <div class="article-gallery col1">
           <?php author_portrait_lg(); ?>
        </div>
        <div class="col2">
            <h1><?php printf( __( '%s', 'starkers' ), get_the_author() ); ?></h1>
            <div class="job-title"><?php the_author_meta( jobtitle, $user_id ); ?></div>
            <p><?php the_author_meta( 'description' ); ?></p>
        </div>
    <?php endif; ?>
        <div class="col3"> 
            <h2>Archive</h2>
            <?php
                rewind_posts();
             
                get_template_part( 'loop', 'author' );
            ?>
        </div>
    </div>
 </div>
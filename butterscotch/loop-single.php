<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Butterscotch
 * @since Butterscotch 1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="content-container cf">
                <div class="page-title-container"><?php get_search_form( $echo ); ?><h1 class="page-title"><?php echo the_category(' &gt; '); ?></h1></div>

				<div class="col1">
                <?php if(in_category('cocktailvideo')){
				} else{
					the_post_thumbnail( 'article-main', array('class' => 'article-gallery') );
				}
	            	  ?>
				</div>
                <script>
					var image = document.querySelector('.article-gallery');
					var origOffsetY = image.offsetTop;

					function onScroll(e){
						window.scrollY >= origOffsetY ? image.classList.add('sticky-img') : image.classList.remove('sticky-img');
					}

					document.addEventListener('scroll', onScroll);
				</script>

            	<div class="article-body col2">
                  <?php echo tuesday_sale_bar();	?>

                  <header>
                      <hgroup>
                          <?php if (has_tag('gift-guide')): ?>
                          <h3>Gift Guide:</h3>
                          <?php endif; ?>
                          <h1><?php the_title(); ?></h1>
                          <h4><?php starkers_posted_on(''); ?></h4>
                      </hgroup>
                  </header>

                  <?php if(in_category('cocktailvideo')){include('video-embed.php');} ?>

                  <?php the_content(); ?>

									<div style="padding-bottom:64px;padding-top:64px;">
										<span class="pull-left"><?php previous_post_link('%link','<i class="fa fa-angle-double-left"></i> Previous Post','no'); ?></span>
										<span class="pull-right"><?php next_post_link('%link','Next Post <i class="fa fa-angle-double-right"></i>','no'); ?></span>
									</div>

               		<?php comments_template( '', true ); ?>

                </div> <!-- .article-body -->

                <div class="col3">
                	<?php
										if(get_post_meta($post->ID,'item_01',true) !== ''){
											if(in_category(180)){
												echo("<h2>Our top 11 list</h2>");
											}
											include('xml-parse.php');
										}
									?>
                </div>

            </div>

	<?php include('article-footer.php'); ?>
	</article>

<?php endwhile; // end of the loop. ?>

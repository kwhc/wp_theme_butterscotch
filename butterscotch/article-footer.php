<footer ID="article-footer">
    <div class="fade">
    </div>
    <div class="content-container">
        <ul>
            <li class="meet-the-author container">
                <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
                    <?php //echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 60 ) ); ?>
                    <?php author_portrait_sm(); ?>

                    <h4>Meet the Author</h4>
                    <h3><?php printf( esc_attr__( '%s', 'starkers' ), get_the_author() ); ?></h3>
                    <div class="job-title"><?php the_author_meta(jobtitle, $user_id); ?></div>
                      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                          <?php printf( __( 'View all posts by %s &rarr;', 'starkers' ), get_the_author() ); ?>
                      </a>
                <?php endif; ?>

            </li> <!-- .meet-the-author -->
            <li class="related-posts container">
                <?php $tags = wp_get_post_tags($post->ID);
                    if ($tags) {
                    $tag_ids = array();
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

                    $args=array(
                    'tag__in' => $tag_ids,
                    'post__not_in' => array($post->ID),
                    'showposts'=>1,  // Number of related posts that will be shown.
                    'caller_get_posts'=>1
                    );

                    $my_query = new wp_query($args);
                    if( $my_query->have_posts() ) {
                    echo '<div id="relatedposts">';
                    while ($my_query->have_posts()) {
                    $my_query->the_post();
                ?>

                <?php if ( has_post_thumbnail() ) { ?>
                <article class="teaser">
                    <div class="relatedthumb">
                    	<?php if (has_tag('bottle')){ ?>
							<?php the_post_thumbnail('footer-bottle'); ?>
                        <?php } else { ?>
							<?php the_post_thumbnail('related'); ?>
                        <?php }; ?>
                        <h4>Related Posts</h4>
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                </article>
                <?php } else { ?>
                <article class="teaser">
                    <div class="relatedthumb">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_post_meta($post->ID, 'Image',true) ?>" width="196" height="110" alt="<?php the_title_attribute(); ?>" /><?php the_title(); ?></a>
                    </div>
                </article>
                <?php } ?>

                <?php
                }
                }
                }
                $post = $backup;
                wp_reset_query();
                ?>

            </li>
            <li class="email container">
                <h4>Stay Posted</h4>
                <p>Sign up for the Astor Wines & Spirits email list to hear about sales and free tastings.</p>
                <div class="createsend-button" style="height:22px;display:inline-block;" data-listid="r/7E/EC4/6AE/350309872C70E028"></div>
                <script type="text/javascript">
                (function () { var e = document.createElement('script');
                e.type = 'text/javascript';
                e.async = true;
                e.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://btn.createsend1.com/js/sb.min.js?v=3';
                e.className = 'createsend-script';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(e, s); })();
                </script>
            </li>

        </ul>
    </div>
</footer>
<script>
	 $(window).scroll(function(){
	  // get the height of #wrap
	  var h = $('.page-container').height();
	  var y = $(window).scrollTop() - $('.page-container').position().top;
	  if( y > (h*.25) && y < (h*.75) ){
	   // if we are show keyboardTips
	   $("#article-footer").fadeIn("slow");
	  } else {
	   $('#article-footer').fadeOut('slow');
	  }
	 });
</script>

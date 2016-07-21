    	<?php /* How to display Geek posts, */ ?>
        <?php elseif ( in_category( 'winegeek' ) || in_category( 'spiritsgeek' ) ) : ?>
      	      
              <li>
              <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
             	
                <?php if ( in_category( 'winegeek' ) ) : ?>
                	<img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_ws_thought.png" class="icon" />
                <?php elseif ( in_category( 'spiritsgeek' ) ) : ?>
                    <img src="<?php echo content_url('/'); ?>themes/butterscotch/images/ic_sc_thought.png" class="icon" />
                <?php endif; ?>
                
                <header>
                	<hgroup>
                        <h4><?php child_cat_link(); ?></h4>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                	</hgroup>
                </header>
              
                <footer>
                    <?php // comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>                   
                </footer>
            </article>
     
            <?php comments_template( '', true ); ?>
			</li>

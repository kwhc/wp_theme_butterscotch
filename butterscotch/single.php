<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div class="content-page">
	<?php
		$post = $wp_query->post;
		
		if ( in_category('recipecard') || 'recipes' == get_post_type() ){
			 get_template_part( 'loop', 'recipecard' );
		} elseif (in_category('tuesdaysale')){
			get_template_part( 'loop', 'tuesdaysale' );
		} else{
			get_template_part('loop', 'single');
		}
		
 	?>
    
</div>
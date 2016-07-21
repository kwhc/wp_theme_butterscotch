<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<div class="search-container">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-search">
		<label for="s" class="assistive-text"></label>
		<input type="text" class="field search-query" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
	</form>
</div>
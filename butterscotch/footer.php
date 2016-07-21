<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>

	<footer>

<?php
	get_sidebar( 'footer' );
?>

		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>

		<?php do_action( 'starkers_credits' ); ?>
		
		<a href="<?php echo esc_url( __('http://wordpress.org/', 'starkers') ); ?>" title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'starkers'); ?>" rel="generator"> 
			<?php printf( __('Proudly powered by %s.', 'starkers'), 'WordPress' ); ?>
		</a>

	</footer>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</div> <!-- .page-container -->

<script type="text/javascript">
var disqus_shortname = 'tastingnotes';
(function () {
var s = document.createElement('script'); s.async = true;
s.type = 'text/javascript';
s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>
</body>
</html>
<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'starkers' ),
	) );
}
endif;

if ( ! function_exists( 'starkers_menu' ) ):
/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s says:', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
			<br />
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'starkers' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' );
			?>

		<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'starkers' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'starkers' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'starkers' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'starkers' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'starkers' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( __( '%2$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

//Child Category
function child_cat(){
foreach((get_the_category()) as $category) {
					if ($category->category_parent  != 0) {
					echo $category->name;
					}
				  }
}

function child_cat_link(){
foreach((get_the_category()) as $category) {
					if ($category->category_parent  != 0) {
					echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr(strip_tags($category->name)) . '" ' . '>' . $category->name.'</a> ';
					}
				  }	
}

/* Custom Excerpt Length */

function custom_excerpt($excerpt_length = 55, $ending = ' [...]', $superending = null)
{
	$text = get_the_content('');
	$text = strip_shortcodes( $text );

	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $ending;
		return '<p>'.$text.'</p>'.$superending;
	} else {
		$text = implode(' ', $words);
		return '<p>'.$text.'</p>';
	}
}

function twentyten_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * get_columns_array
 *
 * Columns for the loop, single function interface (limited) 
 *
 * Copyright (c) 2011 hakre <http://hakre.wordpress.com/>, some rights reserved
 *
 * USAGE:
 *
 *   foreach(get_columns_array($post_count) as $column_count) :
 *     // column starts here
 *     while ($column_count--) : $the_query->the_post();
 *         // output your post
 *     endwhile;
 *     // column ends here
 *   endforeach;
 * 
 * @author hakre <http://hakre.wordpress.com/>
 * @see http://wordpress.stackexchange.com/q/9308/178
 */
 
 // Define excerpt append
 function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_columns_array($totalCount, $columnSize) {
	$columns = array();
	$totalCount = (int) max(0, $totalCount);
	if (!$count)
		return $columns;	
	$columnSize = (int) max(0, $columnSize);
	if (!$columnSize)
		return $columns;
	($floor = (int) ($totalCount / $columnSize))
                && $columns = array_fill(0, $floor, $columnSize)
                ;
	($remainder = $totalCount % $columnSize)
		&& $columns[] = $remainder
		;
	return $columns;
}

/**
 * WP_Query_Columns
 *
 * Columns for the loop. 
 *
 * Copyright (c) 2011 hakre <http://hakre.wordpress.com/>, some rights reserved 
 * 
 * @author hakre <http://hakre.wordpress.com/>
 * @see http://wordpress.stackexchange.com/q/9308/178
 */
class WP_Query_Columns implements Countable, IteratorAggregate {
	/**
	 * column size
	 * @var int
	 */
	private $size;
	private $index = 0;
	private $query;
	public function __construct(WP_Query $query, $size = 10) {
		$this->query = $query;
		$this->size = (int) max(0, $size);
	}
	/**
	 * @return WP_Query
	 */
	public function query() {
		return $this->query;
	}
	private function fragmentCount($fragmentSize, $totalSize) {
		$total = (int) $totalSize;
		$size = (int) max(0, $fragmentSize);
		if (!$total || !$size)
			return 0;
		$count = (int) ($total / $size);
		$count * $size != $total && $count++;				
		return $count;
	}
	private function fragmentSize($index, $fragmentSize, $totalSize) {
		$index = (int) max(0, $index);
		if (!$index)
			return 0;
		$count = $this->fragmentCount($fragmentSize, $totalSize);
		if ($index > $count)
			return 0;
		return $index === $count ? ($totalSize - ($count-1) * $fragmentSize) : $fragmentSize;			
	}
	public function columnSize($index) {
		return $this->fragmentSize($index, $this->size, $this->query->post_count);
	}
	/**
	 * @see Countable::count()
	 * @return int number of columns
	 */
	public function count() {
		return $this->fragmentCount($this->size, $this->query->post_count);
	}
	/**
	 * @return array
	 */
	public function columns() {
		$count = $this->count();
		$array = $count ? range(1, $count) : array();
		return array_map(array($this, 'columnSize'), $array);
	}
	/**
	 * @see IteratorAggregate::getIterator()
	 * @return traversable columns
	 */
	public function getIterator() {
		return new ArrayIterator($this->columns());
	}
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'mini', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'related', 100, 100, true ); //(cropped)
	add_image_size('article-main', 400, 9999);
	add_image_size('teaser-bottle', 100, 9999);
	add_image_size('footer-bottle', 9999, 100);
}

//Tuesday Sale Bars
function tuesday_sale_bar(){
	$startdate=get_post_meta(get_the_ID(),'saledatestart',true);
	$enddate=get_post_meta(get_the_ID(),'saledateend',true);
	$saleurl=get_post_meta(get_the_ID(),'saleurl',true);
	if(date('m/d/Y')>=$startdate and date('m/d/Y')<=$enddate){
	echo "<a href=".$saleurl."><div style='padding:8px;background:#eeab1e;color:#fefefe;text-transform:uppercase;font-size:13px;margin-bottom:10px;'><i class='icon-star'></i> 15% Off at Astor Wines & Spirits Today</div></a>"; 
	}					

}

//Author's Portrait
function author_portrait_sm(){
	echo '<img src="' . get_bloginfo(template_url) . '/images/authors/' . get_the_author_meta(ID) . '.jpg" alt="' . get_the_author() . '" width="100" />';
}

function author_portrait_lg(){
	echo '<img src="' . get_bloginfo(template_url) . '/images/authors/' . get_the_author_meta(ID) . '.jpg" alt="' . get_the_author() . '" width="400" />';
}

// Custom Panels
function create_recipe_type(){
	register_post_type( 'recipes',
		array(
			'labels' => array(
				'name' => _( 'Recipes' ),
				'singular_name' => _( 'Recipe' )
				),
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category', 'post_tag')	
		)
	);
}
add_action( 'init', 'create_recipe_type' );

//// SOLUTION 1 BEGIN
//
//// Where is theme folder...
//define(	'MY_WORDPRESS_FOLDER', 	$_SERVER['DOCUMENT_ROOT'] );
//define( 'MY_THEME_FOLDER', str_replace("\\", '/', dirname(__FILE__)) );
//define( 'MY_THEME_PATH', '/' . substr(MY_THEME_FOLDER, stripos(MY_THEME_FOLDER, 'wp-content')) );
//
//add_action( 'admin_init', 'recipe_meta_init' );
//function recipe_meta_init() {
//	// Add CSS file
//	wp_enqueue_style( 'my_meta_css', get_template_directory_uri(). '/custom/recipe_panel.css' );
//	// Add write panel
//	add_meta_box( 'recipe_meta', 'Recipe Information', 'recipe_meta', 'recipes', 'advanced', 'high' );
//}
//
//// Link panel to custom fields
//function recipe_meta() {
//	global $post;
//	
//	//Variables
//	$recipe_title = get_post_meta($post->ID, 'recipe_title', TRUE);
//	$ingredient1 = get_post_meta($post->ID, 'ingredient1', TRUE);
//
//	// Call write panel HTML
//	include(MY_THEME_FOLDER . '/custom/recipe_information.php');
//	
//	//create custome nonce for submit
//	// verification later
//	echo '';
//
//}
//
//add_action( 'save_post', 'my_meta_save', 3, 1 );
//// Check authentication via nonce, save to DB
//function my_meta_save($post_id) {
//	//authentication check to be sure data came from meta box
//	//if(!wp_verify_nonce( $_POST['my_meta_noncename'], __FILE__) ) return $post_id;
//	if (!current_user_can('edit_post', $post_id)) {
//			return $post_id;
//	}
//	
//	//array for accepted fields for recipes
//	$accepted_fields['recipes'] = array( 'recipe_title', 'ingredient1' );
//	$post_type_id = $_POST['post_type'];
//	
//	// Loop through list of fields and save
//	foreach($accepted_fields[$post_type_id] as $key){
//		//set to a variable
//		$custom_field = $_POST[$key];
//		
//		// If no data is entered
//		if(is_null($custom_field)) {
//			//delete the field]
//			delete_post_meta( $post_id, $key );
//			// If there's already data, update it
//		}
//		elseif(isset($custom_field) && !is_null($custom_field))
//		{
//			//update
//			update_post_meta($post_id, $key, $custom_field);
//		} else {
//			//Add?
//			add_post_meta( $post_id, $key, $custom_field, TRUE) ;
//		}
//	}
//	return $post_id;
//	
//}
//
//// SOLUTION 1 END

//SOLUTION 2 BEGIN

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
	add_meta_box( 'my-meta-box-id', 'Recipe Information', 'cd_meta_box_cb', 'recipes', 'normal', 'high' );
}

function cd_meta_box_cb( $post )
{
	$values = get_post_custom( $post->ID );
	$r_title = isset( $values['r_title'] ) ? esc_attr( $values['r_title'][0] ) : '';
	$r_ing1 = isset( $values['r_ing1'] ) ? esc_attr( $values['r_ing1'][0] ) : '';
	$r_ing2 = isset( $values['r_ing2'] ) ? esc_attr( $values['r_ing2'][0] ) : '';
	$r_ing3 = isset( $values['r_ing3'] ) ? esc_attr( $values['r_ing3'][0] ) : '';
	$r_ing4 = isset( $values['r_ing4'] ) ? esc_attr( $values['r_ing4'][0] ) : '';
	$r_ing5 = isset( $values['r_ing5'] ) ? esc_attr( $values['r_ing5'][0] ) : '';
	$r_ing6 = isset( $values['r_ing6'] ) ? esc_attr( $values['r_ing6'][0] ) : '';
	$r_desc = isset( $values['r_desc'] ) ? esc_attr( $values['r_desc'][0] ) : '';
	$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
	$check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
		<label for="r_title">Title</label>
		<input type="text" name="r_title" id="r_title" value="<?php echo $r_title; ?>" />
	</p>

	<p>
		<label for="r_ing1">Ingredient 1</label>
		<input type="text" name="r_ing1" id="r_ing1" value="<?php echo $r_ing1; ?>" />
	</p>

	<p>
		<label for="r_ing1">Ingredient 2</label>
		<input type="text" name="r_ing2" id="r_ing2" value="<?php echo $r_ing2; ?>" />
	</p>

	<p>
		<label for="r_ing1">Ingredient 3</label>
		<input type="text" name="r_ing3" id="r_ing3" value="<?php echo $r_ing3; ?>" />
	</p>

	<p>
		<label for="r_ing4">Ingredient 4</label>
		<input type="text" name="r_ing4" id="r_ing4" value="<?php echo $r_ing4; ?>" />
	</p>

	<p>
		<label for="r_ing5">Ingredient 5</label>
		<input type="text" name="r_ing5" id="r_ing5" value="<?php echo $r_ing5; ?>" />
	</p>

	<p>
		<label for="r_ing6">Ingredient 6</label>
		<input type="text" name="r_ing6" id="r_ing6" value="<?php echo $r_ing6; ?>" />
	</p>

	<p>
		<label for="r_desc">Description</label>
		<textarea type="text" name="r_desc" id="r_desc" value="<?php echo $r_desc; ?>" rows="4" cols="40"></textarea>
	</p>

	
	<p>
		<label for="my_meta_box_select">Color</label>
		<select name="my_meta_box_select" id="my_meta_box_select">
			<option value="red" <?php selected( $selected, 'red' ); ?>>Red</option>
			<option value="blue" <?php selected( $selected, 'blue' ); ?>>Blue</option>
		</select>
	</p>
	<p>
		<input type="checkbox" name="my_meta_box_check" id="my_meta_box_check" <?php checked( $check, 'on' ); ?> />
		<label for="my_meta_box_check">Don't Check This.</label>
	</p>
	<?php	
}


add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['r_title'] ) )
		update_post_meta( $post_id, 'r_title', wp_kses( $_POST['r_title'], $allowed ) );

	if( isset( $_POST['r_ing1'] ) )
		update_post_meta( $post_id, 'r_ing1', wp_kses( $_POST['r_ing1'], $allowed ) );

	if( isset( $_POST['r_ing2'] ) )
		update_post_meta( $post_id, 'r_ing2', wp_kses( $_POST['r_ing2'], $allowed ) );

	if( isset( $_POST['r_ing3'] ) )
		update_post_meta( $post_id, 'r_ing3', wp_kses( $_POST['r_ing3'], $allowed ) );

	if( isset( $_POST['r_ing4'] ) )
		update_post_meta( $post_id, 'r_ing4', wp_kses( $_POST['r_ing4'], $allowed ) );

	if( isset( $_POST['r_ing5'] ) )
		update_post_meta( $post_id, 'r_ing5', wp_kses( $_POST['r_ing5'], $allowed ) );

	if( isset( $_POST['r_ing6'] ) )
		update_post_meta( $post_id, 'r_ing6', wp_kses( $_POST['r_ing6'], $allowed ) );

	if( isset( $_POST['r_desc'] ) )
		update_post_meta( $post_id, 'r_desc', wp_kses( $_POST['r_desc'], $allowed ) );
		
	if( isset( $_POST['my_meta_box_select'] ) )
		update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );
		
	// This is purely my personal preference for saving checkboxes
	$chk = ( isset( $_POST['my_meta_box_check'] ) && $_POST['my_meta_box_check'] ) ? 'on' : 'off';
	update_post_meta( $post_id, 'my_meta_box_check', $chk );
}

//SOLUTION 2 END

// Add Fields to User Profile
add_action('show_user_profile', 'my_show_extra_profile_fields');
add_action('edit_user_profile', 'my_show_extra_profile_fields');

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Job Title</label></th>

			<td>
				<input type="text" name="jobtitle" id="jobtitle" value="<?php echo esc_attr( get_the_author_meta( 'jobtitle', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Job Title.</span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

/* Disables stipping out ot HTML */
remove_filter('pre_user_description', 'wp_filter_kses');

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'jobtitle' to the field ID. */
	update_usermeta( $user_id, 'jobtitle', $_POST['jobtitle'] );
}

/* List Contributors */
function list_all_authors() {
	if (is_page('contributors')) {
    global $wpdb;
    $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
    foreach ($authors as $author ) { 
    $aid = $author->ID; ?>
	    <div class="author_info teaser cf <?php the_author_meta('user_nicename',$aid); ?>">
			<span class="author_photo"><a href="<?php bloginfo('url'); ?>/author/<?php the_author_meta('user_nicename', $aid); ?>"><img src="<?php bloginfo('template_url'); ?>/images/authors/<?php the_author_meta('ID', $aid); ?>.jpg" alt="<?php the_author() ?>" width="100" /></a></span>
        	<h2><a href="<?php bloginfo('url'); ?>/author/<?php the_author_meta('user_nicename', $aid); ?>"><?php the_author_meta('display_name',$aid); ?></a></h2>  
        	<span class="job-title"><?php the_author_meta('jobtitle',$aid); ?></span>
        </div> 
	<?php }
	}
}
add_action('thesis_hook_custom_template','list_all_authors');	
remove_action('thesis_hook_custom_template','thesis_custom_template_sample');	

//Allow iFrames
add_filter('tiny_mce_before_init', create_function( '$a',
'$a["extended_valid_elements"] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]"; return $a;') );
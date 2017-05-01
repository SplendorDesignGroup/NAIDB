<?php
/**
 * Functions
 */

/******************************************************************************
 * Included Functions
 ******************************************************************************/

// Helpers function
require_once get_stylesheet_directory() . '/inc/helpers.php';
// Install Recommended plugins
require_once get_stylesheet_directory() . '/inc/recommended-plugins.php';
// Walker modification
require_once get_stylesheet_directory() . '/inc/class-foundation-navigation.php';
// Home slider function
include_once get_stylesheet_directory() . '/inc/home-slider.php';
// Dynamic admin
include_once get_stylesheet_directory() . '/inc/class-dynamic-admin.php';
// SVG Support
include_once get_stylesheet_directory() . '/inc/svg-support.php';


/******************************************************************************
 * Global Functions
 ******************************************************************************/

// By adding theme support, we declare that this theme does not use a
// hard-coded <title> tag in the document head, and expect WordPress to
// provide it for us.
add_theme_support( 'title-tag' );

//  Add widget support shortcodes
add_filter( 'widget_text', 'do_shortcode' );

// Support for Featured Images
add_theme_support( 'post-thumbnails' );

// Custom Background
add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );

// Custom Header
add_theme_support( 'custom-header', array(
	'default-image' => get_template_directory_uri() . '/images/custom-logo.png',
	'height'        => '200',
	'flex-height'   => true,
	'uploads'       => true,
	'header-text'   => false
) );

// Custom Logo
add_theme_support( 'custom-logo', array(
	'height'      => '150',
	'flex-height' => true,
	'flex-width'  => true,
) );

function show_custom_logo() {
	if ( $custom_logo_id = get_theme_mod( 'custom_logo' ) ) {
		$attachment_array = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
		$logo_url         = $attachment_array[0];
	} else {
		$logo_url = get_stylesheet_directory_uri() . '/images/custom-logo.png';
	}
	$logo_image = '<img src="' . $logo_url . '" class="custom-logo" itemprop="siteLogo" alt="' . get_bloginfo( 'name' ) . '">';
	$html       = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ), $logo_image );
	echo apply_filters( 'get_custom_logo', $html );
}

// Add HTML5 elements
add_theme_support( 'html5', array(
	'comment-list',
	'search-form',
	'comment-form',
) );

// Register Navigation Menu
register_nav_menus( array(
	'header-menu' => 'Header Menu',
	'footer-menu' => 'Footer Menu'
) );

// Create pagination
function foundation_pagination( $query = '' ) {
	if ( empty( $query ) ) {
		global $wp_query;
		$query = $wp_query;
	}

	$big = 999999999;

	$links = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'prev_next' => false,
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $query->max_num_pages,
			'type'      => 'list'
		) );

	$pagination = str_replace( 'page-numbers', 'pagination', $links );

	echo $pagination;
}

// Register Sidebars
function foundation_widgets_init() {

	register_sidebar( array(
		'id'            => 'top_right_sidebar',
		'name'          => __( 'Top Right Sidebar' ),
		'description'   => __( 'This sidebar is located on top.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	/* Sidebar Right */
	register_sidebar( array(
		'id'            => 'foundation_sidebar_right',
		'name'          => __( 'Sidebar Right' ),
		'description'   => __( 'This sidebar is located on the right-hand side of each page.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'id'            => 'services_sidebar',
		'name'          => __( 'Services Sidebar' ),
		'description'   => __( 'This sidebar is located on each service page.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'id'            => 'news_sidebar',
		'name'          => __( 'News Sidebar' ),
		'description'   => __( 'This sidebar is located on each news page.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
}

add_action( 'widgets_init', 'foundation_widgets_init' );

// Remove #more anchor from posts
function remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

add_filter( 'the_content_more_link', 'remove_more_jump_link' );


/******************************************************************************************************************************
 * Enqueue Scripts and Styles for Front-End
 *******************************************************************************************************************************/

function foundation_scripts_and_styles() {
	if ( ! is_admin() ) {

		// Load Stylesheets
		//core
		wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.min.css', null, '6.3.0' );

		//plugins
		wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/css/plugins/font-awesome.min.css', null, '4.7.0' );
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/plugins/slick.css', null, '1.6.0' );
		wp_enqueue_style( 'jquery.fancybox', get_template_directory_uri() . '/css/plugins/jquery.fancybox.css', null, '2.1.5' );

		//system
		wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css', null, null );/*3rd priority*/
		wp_enqueue_style( 'media-screens', get_template_directory_uri() . '/css/media-screens.css', null, null );/*2nd priority*/
		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', null, null );/*1st priority*/

		// Load JavaScripts
		//core
		wp_localize_script( 'jquery', 'myajax',
			array(
				'url'       => admin_url( 'admin-ajax.php' ),
				'template_url' => get_template_url()
			)
		);
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'foundation.min', get_template_directory_uri() . '/js/foundation.min.js', null, '6.3.0', true );

		//plugins
		wp_enqueue_script( 'html5shiv-respond', get_template_directory_uri() . '/js/plugins/html5shiv_respond.js', null, null, false );
		wp_script_add_data( 'html5shiv-respond', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/plugins/slick.min.js', null, '1.6.0', true );
		wp_enqueue_script( 'jquery.matchHeight-min', get_template_directory_uri() . '/js/plugins/jquery.matchHeight-min.js', null, '0.7.0', true );
		wp_enqueue_script( 'jquery.fancybox.pack', get_template_directory_uri() . '/js/plugins/jquery.fancybox.pack.js', null, '2.1.5', true );
		wp_enqueue_script( 'masonry.pkgd.min', get_template_directory_uri() . '/js/plugins/masonry.pkgd.min.js', null, null, true );
		wp_enqueue_script( 'google.maps.api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAs19C89zcw7bQ12hJEKgtPGK9Q8iuLkQ4&v=3.exp', null, null, true );

		//custom javascript
		wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', null, null, true ); /* This should go first */

	}
}

add_action( 'wp_enqueue_scripts', 'foundation_scripts_and_styles' );

// Initialise Foundation JS
function foundation_js_init() {
	echo '<script>!function ($) { $(document).foundation(); }(window.jQuery); </script>';
}

add_action( 'wp_footer', 'foundation_js_init', 50 );

/******************************************************************************
 * Additional Functions
 *******************************************************************************/

// Enable revisions for all custom post types
add_filter( 'cptui_user_supports_params', function () {
	return array( 'revisions' );
} );

if ( function_exists( 'cptui_get_post_type_data' ) ) {
	add_filter( 'wp_revisions_to_keep', 'limit_revisions_number', 10, 2 );

	function limit_revisions_number( $num, $post ) {
		$custom_post_types = cptui_get_post_type_data();
		foreach ( $custom_post_types as $custom_post_type ) {
			$cpt_names[] = $custom_post_type['name'];
		}
		if ( in_array( $post->post_type, $cpt_names ) ) {
			$num = 15;
		}

		return $num;
	}
}

// Register Post Type Slider
function post_type_slider() {
	$post_type_slider_labels = array(
		'name'               => _x( 'Slider', 'post type general name' ),
		'singular_name'      => _x( 'Slide', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'slide' ),
		'add_new_item'       => __( 'Add New' ),
		'edit_item'          => __( 'Edit' ),
		'new_item'           => __( 'New ' ),
		'all_items'          => __( 'All' ),
		'view_item'          => __( 'View' ),
		'search_items'       => __( 'Search for a slide' ),
		'not_found'          => __( 'No slides found' ),
		'not_found_in_trash' => __( 'No slides found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Slider'
	);
	$post_type_slider_args   = array(
		'labels'        => $post_type_slider_labels,
		'description'   => 'Display Slider',
		'public'        => true,
		'menu_icon'     => 'dashicons-format-gallery',
		'menu_position' => 5,
		'supports'      => array(
			'title',
			'thumbnail',
			'page-attributes',
			'editor'
		),
		'has_archive'   => true,
		'hierarchical'  => true
	);
	register_post_type( 'slider', $post_type_slider_args );
}

add_action( 'init', 'post_type_slider' );

// Stick Admin Bar To The Top
if ( ! is_admin() ) {
	add_action( 'get_header', 'my_filter_head' );

	function my_filter_head() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}

	function stick_admin_bar() {
		echo "
			<style type='text/css'>
				body.admin-bar {margin-top:32px !important}
				@media screen and (max-width: 782px) {
					body.admin-bar { margin-top:46px !important }
				}
			</style>
			";
	}

	add_action( 'admin_head', 'stick_admin_bar' );
	add_action( 'wp_head', 'stick_admin_bar' );
}

// Customize Login Screen
function wordpress_login_styling() {
	if ( $custom_logo_id = get_theme_mod( 'custom_logo' ) ) {
		$custom_logo_img = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
		$custom_logo_src = $custom_logo_img[0];
	} else {
		$custom_logo_src = 'wp-admin/images/wordpress-logo.svg?ver=20131107';
	}
	?>
	<style type="text/css">
		.login #login h1 a {
			background-image: url('<?php echo $custom_logo_src; ?>');
			background-size: contain;
			background-position: 50% 50%;
			width: auto;
			height: 120px;
		}

		body.login {
			background-color: #f1f1f1;
			<?php if ($bg_image = get_background_image()) {?>
			background-image: url('<?php echo $bg_image; ?>') !important;
			<?php } ?>
			background-repeat: repeat;
			background-position: center center;
		}
	</style>
<?php }

add_action( 'login_enqueue_scripts', 'wordpress_login_styling' );

function admin_logo_custom_url() {
	$site_url = get_bloginfo( 'url' );
	return ( $site_url );
}

function get_template_url() {
	$template_url = get_bloginfo( 'template_url' );
	return ( $template_url );
}

add_filter( 'login_headerurl', 'admin_logo_custom_url' );

// ACF Pro Options Page

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

}

// Set Google Map API key

function set_custom_google_api_key() {
	acf_update_setting( 'google_api_key', 'AIzaSyAs19C89zcw7bQ12hJEKgtPGK9Q8iuLkQ4' );
}

add_action( 'acf/init', 'set_custom_google_api_key' );

// Disable Emoji

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Wrap any iframe and emved tag into div for responsive view

function iframe_wrapper( $content ) {
	// match any iframes
	$pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
	preg_match_all( $pattern, $content, $matches );

	foreach ( $matches[0] as $match ) {
		// wrap matched iframe with div
		$wrappedframe = '<div class="responsive-embed widescreen">' . $match . '</div>';

		//replace original iframe with new in content
		$content = str_replace( $match, $wrappedframe, $content );
	}

	return $content;
}

add_filter( 'the_content', 'iframe_wrapper' );


// Dynamic Admin
if ( is_admin() ) {
	$dynamic_admin = new DynamicAdmin();
//	$dynamic_admin->addField( 'page', 'template', 'Page Template', 'template_detail_field_for_page' );

	$dynamic_admin->run();
}

/*********************** PUT YOU FUNCTIONS BELOW ********************************/

add_image_size( 'full_hd', 1920, 1080, array('center', 'center'));
// add_image_size( 'name', width, height, array('center','center'));

add_filter( 'gform_confirmation_anchor', '__return_false' );

//rename posts to news
function revcon_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';
	$submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
	$labels->all_items = 'All News';
	$labels->menu_name = 'News';
	$labels->name_admin_bar = 'News';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );


add_filter('excerpt_more', function($more) {
	return '...';
});


function new_excerpt_length($length) {
	return 18;
}
add_filter('excerpt_length', 'new_excerpt_length');


add_action( 'widgets_init', 'my_widgets' );

function my_widgets() {
	register_widget( 'Search_Widget' );
	register_widget( 'Latest_Resource' );
	register_widget( 'Sign_Up' );
}
class Latest_Resource extends WP_Widget{
	public function __construct() {
		parent::__construct("resource_widget", "Latest Resource");
	}
	public function widget( $args ) {
		ob_start();
		//get values
		$widget_title = get_field('widget_title','widget_'.$args['widget_id']);
		$widget_image = get_field('widget_image','widget_'.$args['widget_id']);
		$widget_url = get_field('widget_url','widget_'.$args['widget_id']);
		$widget_url_text = get_field('widget_url_text','widget_'.$args['widget_id']); ?>
		<aside class="widget resource_widget text-center">
			<?php if ( $widget_title ) : ?>
				<h5 class="text-left"><?php echo $widget_title; ?></h5>
			<?php endif;
			if ( $widget_image ) : ?>
			    <img src="<?php echo $widget_image['sizes']['medium']; ?>" />
			<?php endif;
			if ( $widget_url && $widget_url_text ) : ?>
				<a href="<?php echo $widget_url; ?>"><?php echo $widget_url_text; ?></a>
			<?php endif; ?>
		</aside>
		<?php ob_end_flush();
	}
	public function form( $instance ) {}

}

class Sign_Up extends WP_Widget{
	public function __construct() {
		parent::__construct("sign_up", "Sign Up");
	}
	public function widget( $args ) {
		ob_start();
		//get values
		$sign_up_title = get_field('sign_up_title','widget_'.$args['widget_id']);
		$sign_up_form = get_field('sign_up_form','widget_'.$args['widget_id']); ?>
		<aside class="widget sign_up_widget">
			<?php if ( $sign_up_title ) : ?>
				<h5><?php echo $sign_up_title; ?></h5>
			<?php endif;
			if ( $sign_up_form ) :
				echo do_shortcode('[gravityform id="' . $sign_up_form['id'] . '" title="false" description="false" ajax="true" tabindex=3]');
			endif; ?>
		</aside>
		<?php ob_end_flush();
	}
	public function form( $instance ) {}

}

class Search_Widget extends WP_Widget{
	public function __construct() {
		parent::__construct("search_widget", "Property Search Widget");
	}
	public function widget( $args ) {
		ob_start();
		//get values
		$property_search_text = get_field('property_search_text','widget_'.$args['widget_id']);
		$property_search_icon = get_field('property_search_icon','widget_'.$args['widget_id']);
		$property_search_link = get_field('property_search_link','widget_'.$args['widget_id']); ?>
		<aside class="widget search_widget">
			<a href="<?php echo $property_search_link ?>">
				<?php if ( $property_search_text ) : ?>
					<h4>
						<?php echo $property_search_text; ?>
					</h4>
				<?php endif;
				if ( $property_search_icon ) : ?>
					<img src="<?php echo $property_search_icon['sizes']['thumbnail']; ?>" />
				<?php endif; ?>
			</a>
		</aside>
		<?php ob_end_flush();
	}
	public function form( $instance ) {}

}

function get_property_data($astro_xml,$act){

}

// Add and Update Properties
require_once get_stylesheet_directory() . '/inc/properties.php';

// Properties Map filters
add_action( 'wp_ajax_nopriv_properties', 'filter_properties' );
add_action('wp_ajax_properties', 'filter_properties');

function filter_properties() {
	$status  = $_POST['status'];
//	$type  = $_POST['pr_type'];
//	$country  = $_POST['country'];
//	$city  = $_POST['city'];
//	$cur_page  = intval($_POST['cur_page']);
	//construct meta array
	$meta_array = array('relation' => 'AND');
	$meta_small_array = array('relation' => 'OR');
	if( $status ){
		foreach($status as $item):
			$status_array = array(
				'key' => 'property_activestatus',
				'value' => $item,
				'compare' => 'LIKE'
			);
			array_push($meta_array,$status_array);
		endforeach;
	}
//	if( $type ){
//		foreach($type as $item):
//			$type_array = array(
//				'key' => 'property_type',
//				'value' => $item,
//				'compare' => 'LIKE'
//			);
//			array_push($meta_small_array,$type_array);
//		endforeach;
//	}
//	if( $country ){
//		$country_array = array(
//			'key' => 'country',
//			'value' => $country
//		);
//		array_push($meta_small_array,$country_array);
//	}
//	if( $city ){
//		$city_array = array(
//			'key' => 'city',
//			'value' => $city
//		);
//		array_push($meta_small_array,$city_array);
//	}
	array_push($meta_array,$meta_small_array);
	//var_dump($meta_array);
	$filter_args = array(
		'post_type'	    => 'properties',
		'order'		    => 'DESC',
		'orderby'	    => 'date',
		'post_status'  => 'publish',
		'posts_per_page'    => 50,
		'meta_query' => $meta_array
	);
	$the_query = new WP_Query( $filter_args );
	if ( $the_query->have_posts() ) : ?>
		<h3 class="no-results"><?php _e('No properties match your search criteria. Please try a new search.'); ?></h3>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post();
			get_template_part('parts/property-grid');
		endwhile; ?>
		<div class="small-12 columns text-center properties-pagination">
			<?php foundation_pagination($the_query); ?>
		</div>
	<?php endif; wp_reset_query(); ?>

	<?php	die();
}

function del_properties(){

	//get properties posts
	$arg = array(
		'post_type'	  => 'properties',
		'numberposts' => -1,
		'post_status' => 'publish'
	);
	$properties = get_posts( $arg );
	if ( $properties ) :
		foreach($properties as $property):
			wp_delete_post(intval($property->ID));
		endforeach;
	endif;
}
//del_properties();

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ){
	$existing_mimes['vcf'] = 'text/x-vcard'; return $existing_mimes;
}

?>
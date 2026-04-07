<?php
// Includes
include_once dirname(__FILE__) . '/inc/admin-functions.php';
/**
 * New functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package New
 */

if ( ! function_exists( 'new_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function new_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Thumbnails
		// Thumbnail 250 x 250
		add_image_size( 'large-thumbnail', 600, 600, true );

		add_image_size( 'large-cropped', 1200, 900, true );
		add_image_size( 'medium-cropped', 800, 600, true );
		add_image_size( 'small-cropped', 400, 300, true );
		add_image_size( 'small-preview', 120, 0, false );

		add_image_size( 'small', 400, 0, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header', 'eldo' ),
			'menu-2' => esc_html__( 'Footer', 'eldo' ),
			'menu-3' => esc_html__( 'Footer 2', 'eldo' ), 
			'menu-4' => esc_html__( 'Legal', 'eldo' ), 
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'new_setup' );

// Disable medium_large image size automatically created by WordPress
function shapeSpace_customize_image_sizes($sizes) {
	unset($sizes['medium_large']); // 768px
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'shapeSpace_customize_image_sizes');


// Register widget area
function new_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'new' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'new' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// register_sidebar( array(
	// 	'name'          => esc_html__( 'Sidebar', 'new' ),
	// 	'id'            => 'sidebar-2',
	// 	'description'   => esc_html__( 'Add widgets here.', 'new' ),
	// 	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	// 	'after_widget'  => '</section>',
	// 	'before_title'  => '<h2 class="widget-title">',
	// 	'after_title'   => '</h2>',
	// ) );
}
add_action( 'widgets_init', 'new_widgets_init' );

// Enqueue scripts and styles.
function new_scripts() {
	wp_register_style( 'core-css', get_template_directory_uri() . '/css/core.css', false, false );
	wp_enqueue_style( 'core-css' );

	wp_enqueue_style( 'eldo-style', get_stylesheet_uri() );

	wp_register_script( 'mainjs', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );

	wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'mainjs' ), false, true );
	wp_enqueue_script( 'custom' );

	wp_register_script( 'util', get_template_directory_uri() . '/js/util.js', array( 'mainjs' ), false, true );
	wp_enqueue_script( 'util' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'new_scripts' );


// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'min.js?ver=' ) || strpos( $src, 'min.css?ver='))
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


// Remove website from comment form
add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields)
{
if(isset($fields['url']))
unset($fields['url']);
return $fields;
}

// load anim css in footer
function prefix_add_footer_styles() {
    wp_enqueue_style( 'anim', get_template_directory_uri() . '/css/animate.min.css');
};
add_action( 'get_footer', 'prefix_add_footer_styles' );

// allow shortcode in acf fields
add_filter('acf/format_value/type=textarea', 'do_shortcode');
add_filter('acf/format_value/type=text', 'do_shortcode');


// Testimonial Relationship Field
add_filter('acf/fields/relationship/result/name=testimonials', 'id_relationship_result', 10, 4);
function id_relationship_result($title, $post, $field, $post_id) {
    // load a custom field from this $object and show it in the $result
    $testimonial = get_field('testimonial', $post->ID) ?: ' Empty Testimonial Field ';
    $name = get_field('name', $post->ID) ?: '';


	if ($testimonial && $name) {
		$short_testimonial = mb_strimwidth($testimonial, 0, 100, "...");
		$title = $name . ' - ' . $short_testimonial;
	} elseif ($testimonial) {
		$short_testimonial = mb_strimwidth($testimonial, 0, 100, "...");
		$title = $short_testimonial;
	} else {
		$title = 'Untitled - ' . $post_id;
	} 

    // return
    return $title;
}


/*
  WooCommerce
*/

// Theme Support
function eldo_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'eldo_add_woocommerce_support' );

// Gallery Support
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change image size for WC thumbnails
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
	return 'thumbnail';
} );

/**
 * Get an HTML img element representing an image attachment
 *
 * returns wp_get_attachment_image without a srcset
 * @param int          $attachment_id Image attachment ID.
 * @param string|array $size          (Optional)
 * @param bool         $icon          (Optional)
 * @param string|array $attr          (Optional)
 * @return string      HTML img element or empty string.
 */
function wp_get_attachment_image_no_srcset($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
    // add a filter to return null for srcset
    add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
    // get the srcset-less img html
    $html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
    // remove the above filter
    remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
    return $html;
}

/*
  Our Flexible Layout
*/

// Get section ID
function sectionId() {
	$settings = get_sub_field('bg_settings');

	if ($settings['id']) {
		$id = 'id="' . $settings['id'] . '"';
	}  else {
		return;
	}
	echo $id;
}

// Get image and output style
function bgImage() {
  $settings = get_sub_field('bg_settings');

	$image_array = wp_get_attachment_image_src($settings['background_image'], 'full');

	if ($image_array) {
		$image_url = $image_array[0];

		if ($image_url && $settings['background'] == 'image is-dark') {
	    echo 'style="background-image: url(' . $image_url . ')"';
	  }
	}

}
// Output relevant classes to section
function classes() {
  $settings = get_sub_field('bg_settings');

	if ($settings['background'] == 'none') {
		echo " no-bg";
	}
	if ($settings['background'] != 'none' && $settings['background'] != 'image') {
		echo ' ' . $settings['background'];
	}
	if ($settings['classes']) {
		echo ' ' . $settings['classes'];
	}
	if ($settings['background'] == 'image' || $settings['background'] == 'image is-dark') {
		echo ' background-image cover';
	}
	if ($settings['container_size']) {
		echo ' ' . $settings['container_size'] . '-container';
	}
	if ($settings['gutter_size']) {
		echo ' ' . $settings['gutter_size'];
	}
	if ($settings['vertical_layout_gap']) {
		echo ' ' . $settings['vertical_layout_gap'];
	}
	if ($settings['padding']) {
		echo ' ' . $settings['padding'];
	}
}
// Output column classes
function cols($field, $default) {
  $columns = get_sub_field($field);
  if ($columns) {
    if ($columns == 'One') {
      return 'co col-12';
    } elseif ($columns == 'Two') {
      return "co col-md-6";
    } elseif ($columns == 'Three') {
      return "co col-md-6 col-lg-4";
    } elseif ($columns == 'Four') {
      return "co col-sm-6 col-md-4 col-lg-3";
	} elseif ($columns == 'Five') {
      return "co col five";
    } else {return 'co col'; }
  } else { return 'co ' . $default; }
}

// Remove protected title from password protected pages
add_filter( 'private_title_format', 'myprefix_private_title_format' );
add_filter( 'protected_title_format', 'myprefix_private_title_format' );
function myprefix_private_title_format( $format ) {
    return '%s';
}

// Remove spaces from string
function remove_whitespace($string) {
	echo str_replace(' ', '', $string);
}

// Remove all spaces and special characters, replace spaces with hyphen
function shorten($content) {
	$content = str_replace(' ', '-', $content); // Replaces all spaces with hyphens.
	$content = preg_replace('/[^A-Za-z0-9\-]/', '', $content); // Removes special chars.
	$content  = preg_replace('/-+/', '-', $content); // Replaces multiple hyphens with single one.
	return strtolower($content); // Makes it all lowercase
}

// Posts per page for custom post type
function set_posts_per_page_for_studies_cpt( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'studies' ) ) {
    $query->set( 'posts_per_page', '5' );
  }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_studies_cpt' );


// Remove emoji script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Change excerpt to dots
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// Change excerpt length
function wpdocs_custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


/*--------------------------------------------------------------
# Custom admin settings
--------------------------------------------------------------*/

if( class_exists('acf') ) {

	// Development mode users check
	function is_dev_user() {
		$user = wp_get_current_user();
		$dev_users = get_field('development_users', 'options') ?: array();

		if ($user && in_array($user->ID, $dev_users)) {
			return true;
		} else {
			return false;
		}
	}

	// Check if in development mode
	function is_dev_mode() {
		 if (get_field('development_mode', 'options')) {
			 return true;
		 } else {
			 return false;
		 }
	}

	// Require user login
	if (get_field('require_login', 'option')) {
		function the_login_message( $message ) {
		    if ( empty($message) ){
					if (get_field('login_message', 'options')) {
						return "<h3>" . get_field('login_message', 'options') . "</h3>";
					} else {
						return $message;
					}

		    } else {
		        return $message;
		    }
		}
		add_filter( 'login_message', 'the_login_message' );

		add_action( 'template_redirect', 'require_login' );
		function require_login() {
		if ( ! is_user_logged_in() ) {
		  auth_redirect();
		  }
		}

		function require_login_notice(){
		   echo '<div class="notice notice-warning">
			 	<p>Require login is enabled! Go to <a href="/wp-admin/admin.php?page=acf-options-admin">Admin</a> > Development to disable.</p>
		   </div>';
		}
		if (is_dev_user()) {
			add_action('admin_notices', 'require_login_notice');
		}
	}


	// Disable small screens
	if (get_field('desktop_only', 'option')) {
		add_action('wp_head', 'my_custom_styles', 100);
			function my_custom_styles()
			{
				if (!is_dev_user()) {
					?>
					<style media="screen">
					.desktop-only {
						display: none;
					}
						@media screen and (max-width: <?php echo get_field('desktop_only_size', 'options') ?: '1024'; ?>px) {
							.desktop-only {
								display: flex;
								height: 100%;
								width: 100%;
								justify-content: center;
								flex-direction: column;
								background: #fff;
								align-items: center;
								padding: 20px;
								text-align: center;
								font-size: 1.2em;
								position: fixed;
								z-index: 99999999999;
							}
							.desktop-only img {
								display: block;
								width: 200px;
								margin-bottom: 10px;
							}
							html, body {
    							height: 100%;
							}
							
						}
						</style>
						<script>
						window.addEventListener('click', function (evt) {
							if (evt.detail === 3) {
								const element = document.getElementById("desktop-only");
								element.remove();
							}
						});
						</script>
						<div class="desktop-only" id="desktop-only">
							<?php if (get_field('logo', 'options')): ?>
								<?php echo wp_get_attachment_image_no_srcset( get_field('logo', 'options'), 'small' ); ?>
							<?php endif; ?>
							<p><?php echo get_field('desktop_only_message', 'options') ?: 'We are currently optimising the site for smaller devices. In the meantime, please view the site on a desktop size screen.'; ?></p>
						</div>
						<?php
				}
		}
		function desktop_only_notice() {
		   echo '<div class="notice notice-warning">
		       <p>Desktop only is enabled! Go to <a href="/wp-admin/admin.php?page=acf-options-admin">Admin</a> > Development to disable.</p>
		   </div>';
		}
		if (current_user_can('administrator')) {
			add_action('admin_notices', 'desktop_only_notice');
		}
	}
}


//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
   } 
   add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/*--------------------------------------------------------------
# Gravity Forms 
--------------------------------------------------------------*/

// Form Styles
add_filter( 'gform_default_styles', function( $styles ) {
    return '{
		"theme":"",
		"inputSize":"lg",
		"inputBorderRadius":"2",
		"inputBorderColor":"#ccc",
		"inputBackgroundColor":"#f0f0f0",
		"inputColor":"#112337",
		"inputPrimaryColor":"#0093B2",
		"descriptionFontSize":"15",
		"labelFontSize":"18",
		"labelColor":"#112337",
		"descriptionColor":"#585e6a",
		"buttonPrimaryBackgroundColor":"#0093B2",
		"buttonPrimaryColor":"#fff"
	}';
} );

// Editor Access
function add_grav_forms() {
  $role = get_role( 'editor' );
  $role->add_cap( 'gform_full_access' );
}
add_action('admin_init','add_grav_forms');


/*--------------------------------------------------------------
# Disable Tags
--------------------------------------------------------------*/
add_action('init', function(){
    register_taxonomy('post_tag', []);
});

// Disable email notifications
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );

/**
 * Disable Admin Notification of User Password Change
 *
 * @see pluggable.php
 */
if ( ! function_exists( 'wp_password_change_notification' ) ) {
    function wp_password_change_notification( $user ) {
        return;
    }
}


add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );


// JOBS

function hrheads_job_field_names(){
	//return array('level', 'contract', 'salary_scale', 'location');
	return array('contract', 'location');	
}
// Custom query vars
function hrheads_add_jobs_query_vars_filter( $vars ){
	$field_names = hrheads_job_field_names();
	foreach ( $field_names as $field_name ) {
		$vars[] = $field_name;
	}
	return $vars;
}
add_filter( 'query_vars', 'hrheads_add_jobs_query_vars_filter' );

function hrheads_remove_jobs_category_from_edit() {
	remove_meta_box( 'jobs_category'.'div', 'job', 'side' );
}
add_action( 'admin_menu', 'hrheads_remove_jobs_category_from_edit' );

function hrheads_load_level_field_choices( $field ) {

	$field_name = $field['name'];

	$parent_of_field_name = sprintf('parent_of_%s_dropdown', $field_name );

	// reset choices
	$field['choices'] = array();


	$term_ID = get_field($parent_of_field_name, 'option', false);

	$terms = get_terms( array(
		'taxonomy' => 'jobs_category',
		'hide_empty' => false,
		'child_of'  => $term_ID
	) );

	$field['choices'][ 0 ] = 'N/A';

	$parents = array();
	foreach ( $terms as $term ) {
		if ( $term->parent === $term_ID ) {
			$parents[] = $term;
		}
	}

	foreach ( $parents as $parent ) :
		$field['choices'][ esc_attr( $parent->term_id ) ] = esc_attr( $parent->name );
		//Indent the children
		foreach ( $terms as $term ) {
			if ( $term->parent === $parent->term_id ) {
				$field['choices'][ esc_attr( $term->term_id ) ] = esc_attr( '- ' . $term->name );
			}
		}
	endforeach;

//	foreach ( $terms as $term ) :
//		$field['choices'][ esc_attr( $term->term_id ) ] = esc_attr( $term->name );
//	endforeach;


	// return the field
	return $field;

}

add_filter('acf/load_field/name=level', 'hrheads_load_level_field_choices');
add_filter('acf/load_field/name=contract', 'hrheads_load_level_field_choices');
add_filter('acf/load_field/name=salary_scale', 'hrheads_load_level_field_choices');
add_filter('acf/load_field/name=location', 'hrheads_load_level_field_choices');

function hrheads_insert_child_term($term_to_add, $field_name, $taxonomy, $post_id) {
	$term_id = false;
	if ( $term_to_add && $field_name ) {
		//Clear the update field
		update_field('add_' . $field_name, '', $post_id);

		//Determine the parent
		$parent_term_id = get_field('parent_of_' . $field_name . '_dropdown', 'option', false);

		//Override parent if the location field has been set to a County
		if ( $field_name === 'location' ) {
			$location_id = get_field( 'location' );
			$location_term = get_term( $location_id, $taxonomy );
			if ( $location_term->parent === $parent_term_id ){
				//a parent term is selected so make that the new parent
				$parent_term_id = $location_term->term_id;
			}
		}

		$new_level = wp_insert_term( $term_to_add, $taxonomy, $args = array('parent'=> $parent_term_id) );
		if ( is_wp_error( $new_level ) ) {
			// Term exists so set $level_id to error term_id.
			$term_id = $new_level->error_data['term_exists'];
		} else {
			$term_id = $new_level['term_id'];
		}

		//Set the level field to the new level
		update_field($field_name, $term_id, $post_id);
	}
	return $term_id;
}

/**
 *
 * When a job is submitted, update the jobs_category based on the 'level', 'contract' dropdowns
 * Or check there is an addition to the categroy and add the term
 *
 * @param $post_id
 */
function hrheads_save_jobs_meta( $post_id ) {

	if ( get_post_type() != 'job' ) return;
	$taxonomy = 'jobs_category';
	$check_additions = hrheads_job_field_names();

	$term_IDs = false;

	foreach ( $check_additions as $check ) {
		$add_check = get_field( 'add_'. $check );
		if ( $add_check ) {
			//Add new term
			$check_additions[$check] = hrheads_insert_child_term( $add_check, $check, $taxonomy, $post_id);
		} else {
			//No new terms added so get the existing values
			$check_additions[$check] = get_field($check,$post_id);
		}
		if ( $check_additions[$check] ) {
			if( is_array( $check_additions[$check] ) ) {
				foreach ( $check_additions[$check] as $add_term ) {
					$term_IDs[] = intval( $add_term );
				}
			} else {
				$term_IDs[] = intval( $check_additions[$check] );
			};
		}
	}


	//This will wipe all existing terms from the post.
	wp_set_object_terms( $post_id, $term_IDs, $taxonomy );

}

add_action( 'acf/save_post', 'hrheads_save_jobs_meta', 100, 1 );

function hrheads_jobs_dropdown( $term_ID, $class = '' ){

	if (!$term_ID) return false;
	$taxonomy = 'jobs_category';
	$parent_term = get_term( $term_ID, $taxonomy );

	$terms = get_terms( array(
		'taxonomy' => $taxonomy,
		'hide_empty' => true,
		'child_of'  => $term_ID
	) );

	$field[ 0 ] = 'All ' . $parent_term->name . 's';

	$class = ( $class ) ? ' ' . esc_attr($class) : '';

	$parents = array();
	foreach ( $terms as $term ) {
		if ( $term->parent === $term_ID ) {
			$parents[] = $term;
		}
	}

	foreach ( $parents as $parent ) :
		$field[ esc_attr( $parent->slug ) ] = esc_attr( $parent->name );
		//Indent the children
		foreach ( $terms as $term ) {
			if ( $term->parent === $parent->term_id ) {
				$field[ esc_attr( $term->slug ) ] = esc_attr( '- ' . $term->name );
			}
		}
	endforeach;

	$select_template = '<select name="%1$s" id="%1$s" class="jobs-filter%2$s">%3$s</select>';
	$option_template = '<option value="%s"%s>%s</option>';

	$query_var = get_query_var( $parent_term->slug );

	$options = '';
	foreach ( $field as $key => $name ) :
		$selected = ( $key === $query_var ) ? ' selected':'';
		$options .= sprintf($option_template, $key, $selected, $name);
	endforeach;

	return sprintf($select_template, $parent_term->slug, $class, $options);
}

function hrheads_pre_get_jobs( $wp_query ) {

	//only interested in Jobs query
	if ( $wp_query->query['post_type'] === 'job'  || $wp_query->query['jobs_category'] ){
		set_query_var('posts_per_page', -1 );
		$check_additions = hrheads_job_field_names();
		$jobs_query = array();
		foreach ( $check_additions as $check ) {
			if ( get_query_var( $check, 0 ) ) {
				$jobs_query[] = get_query_var( $check );
			}
		}

		if ( count( $jobs_query ) ){
			set_query_var('jobs_category', implode('+', $jobs_query) );
		}
	}

}
add_action('pre_get_posts', 'hrheads_pre_get_jobs' );

function hrheads_get_job_terms($post_ID, $separator, $slug = false, $parent = false){
	$terms = get_the_terms( $post_ID, 'jobs_category' );
	$post_terms = array();
	$name = ($slug) ? 'slug' : 'name';

	foreach ($terms as $term) {
		$post_terms[$term->term_id] = $term->$name;
	}
	if ( count($post_terms) ) {
		return implode($separator, $post_terms);
	}
	return false;
}

function hrheads_get_job_meta( $post_ID ){
	$meta_array = array();
	$taxonomy = 'jobs_category';

	$terms = get_the_terms( $post_ID, 'jobs_category' );

	foreach( $terms as $term ){
		$parent = get_term( $term->parent, $taxonomy );

		if ( $parent->parent !== 0 ){
			//This is a child we need the parent
			$term->name .= ', ' . $parent->name;
			$parent = get_term( $parent->parent, $taxonomy );
		}
		$value = $term->name;
		if ( $meta_array[$parent->slug] ) {
			$value = $meta_array[$parent->slug] . ', ' . $term->name;
		}
		$meta_array[$parent->slug] = $value;

	}
	return $meta_array;
}
function hrheads_check_cookie_last_viewed() {
	$post_type = get_post_type();
	$singular = is_singular( "job" );

	if ( $post_type === "job" && $singular ) {
		$id = get_the_ID();
		$cookie_name = 'hrheads_jobs_viewed';

		if ( ! isset( $_COOKIE[ $cookie_name ] ) ) {
			//No cookie
			$viewed = array($id);
		} else {
			//Cookie found
			$viewed = hrheads_get_last_viewed_cookie_array($cookie_name);
			//If the page is already here
			if ( !is_array($viewed) || in_array($id, $viewed) ) return;
			array_unshift($viewed, $id);
		}
		hrheads_set_last_viewed_cookie($viewed, $cookie_name);
	}
}
add_action( 'template_redirect', 'hrheads_check_cookie_last_viewed' );

function hrheads_get_last_viewed_cookie_array($cookie_name){
	$cookie = $_COOKIE[$cookie_name];
	$cookie = stripslashes($cookie);
	$savedCardArray = json_decode($cookie, true);
	return $savedCardArray;
}

function hrheads_clear_last_viewed_cookie($cookie_name){
	unset( $_COOKIE[$cookie_name] );
	setcookie( $cookie_name, null, -1, '/' );
}

function hrheads_set_last_viewed_cookie($viewed, $cookie_name){
	$json = json_encode($viewed);
	setcookie( $cookie_name, $json, strtotime( '+30 days' ), COOKIEPATH, COOKIE_DOMAIN );
}

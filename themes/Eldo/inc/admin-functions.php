<?php

/*--------------------------------------------------------------
# Removing/disabling things
--------------------------------------------------------------*/

// Remove gravity forms widget
function example_remove_dashboard_widgets() {
	remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

// Remove version number from dashboard
function my_footer_shh() {
    remove_filter( 'update_footer', 'core_update_footer' );
}
add_action( 'admin_menu', 'my_footer_shh' );


// Remove WordPress Logo
function annointed_admin_bar_remove() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

// Remove dashboard widgets
function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}
add_action( 'admin_init', 'remove_dashboard_meta' );

// Unregister widgets
 function remove_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	// unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('Akismet_Widget');
	//unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'remove_default_widgets', 11);

// remove wordpress menu pages
add_action( 'admin_menu', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'users.php' );                  //Users

	if(!current_user_can('administrator') ) {
  	remove_menu_page( 'tools.php' );
		remove_menu_page( 'options-general.php' );        //Settings
		remove_menu_page( 'WP-Optimize' );        // WP Optimize
		// remove_menu_page( 'themes.php' );                 //Appearance
	}
};

// Remove help tab from admin
add_filter('contextual_help_list','contextual_help_list_remove');
function contextual_help_list_remove(){
    global $current_screen;
    $current_screen->remove_help_tabs();
}
// Remove comments from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


// Remove customiser link admin menu
add_action( 'wp_before_admin_bar_render', 'wpse200296_before_admin_bar_render' );

function wpse200296_before_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize');
}

// Remove description column in posts -> categories
function jw_remove_taxonomy_description($columns)
{
 // only edit the columns on the current taxonomy, replace category with your custom taxonomy (don't forget to change in the filter as well)
 if ( !isset($_GET['taxonomy']) || $_GET['taxonomy'] != 'category' )
 return $columns;

 if ( $posts = $columns['description'] ){ unset($columns['description']); }
 return $columns;
}
add_filter('manage_edit-category_columns','jw_remove_taxonomy_description');

// Remove Wordpress welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// Disable plugin deactivation
add_filter( 'plugin_action_links', 'disable_plugin_deactivation', 10, 4 );
function disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {

    if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array(
        'advanced-custom-fields-pro/acf.php',
        'admin-site-enhancements/admin-site-enhancements.php'
    )))
        unset( $actions['deactivate'] );
    return $actions;
}


// Disable the WordPress site admin email verification screen
add_filter( 'admin_email_check_interval', '__return_false' );


// Remove login page language switcher
add_filter( 'login_display_language_dropdown', '__return_false' );

// Responsive video shortcode
function video_embed( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'url' => 'no video'
	), $atts, 'video' );

	if ($atts['url']) {
		ob_start();
		?>
		<div class="video-container shortcode float">
			<div class="embed-container">
				<?php echo wp_oembed_get($atts['url']); ?>
			</div>
		</div>
		<?php $output = ob_get_contents();
		ob_end_clean();
		return $output;
	} else {
		return "Video not found.";
	}
}
add_shortcode( 'embed_video', 'video_embed' );

// Phone shortcode
function phone_shortcode( $atts ) {
	if (get_field('phone', 'options')) {
		ob_start();
		?><a class="general-phone" href="tel:<?php remove_whitespace(get_field('phone', 'options')); ?>"><?php the_field('phone', 'options'); ?></a><?php $output = ob_get_contents();
		ob_end_clean();
		return $output;
	} elseif (current_user_can('administrator') || current_user_can('editor')) {
		return '[Enter phone number in General]';
	} else {
		return;
	}
}
add_shortcode( 'phone', 'phone_shortcode' );

// Email shortcode
function email_shortcode( $atts ) {
	if (get_field('email', 'options')) {
		ob_start();
		?><a class="general-email" href="mailto:<?php remove_whitespace(get_field('email', 'options')); ?>"><?php the_field('email', 'options'); ?></a><?php $output = ob_get_contents();
		ob_end_clean();
		return $output;
	} elseif (current_user_can('administrator') || current_user_can('editor')) {
		return '[Enter email in General]';
	} else {
		return;
	}
}
add_shortcode( 'email', 'email_shortcode' );



// custom tinymce button
add_action( 'init', 'tryvary_buttons' );
function tryvary_buttons() {
    add_filter( "mce_external_plugins", "tryvary_add_buttons" );
    add_filter( 'mce_buttons', 'tryvary_register_buttons' );
}
function tryvary_add_buttons( $plugin_array ) {
    $plugin_array['tryvary_code_block'] = get_template_directory_uri() . '/js/video-shortcode.js';
    return $plugin_array;
}
function tryvary_register_buttons( $buttons ) {
    array_push( $buttons, 'tryvary_code_block'); // droid_title
    return $buttons;
}

// Add favicon to admin
function add_my_favicon() {
	$favicon_path = get_template_directory_uri() . '/images/favicon.ico';
	echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '" />';
 }
 
 add_action( 'admin_head', 'add_my_favicon' ); //admin end
/*--------------------------------------------------------------
# Modifying things
--------------------------------------------------------------*/

// Change login logo link
function loginpage_custom_link() {
	return site_url();
}
add_filter('login_headerurl','loginpage_custom_link');

// WordPress footer
function modify_admin_footer () {

 	if( class_exists('acf') ) {
		if (get_field('white_label', 'options')) {
			?>
			<?php echo get_field('white_label_text', 'options') . ' '; ?>
			<a href="<?php echo get_field('white_label_website', 'options') ?: 'https://www.eldo.co.uk'; ?>">
				<?php echo get_field('white_label_company', 'options') ?: 'Eldo™'; ?>
			</a>
			<?php
		} else {
			echo 'Designed and Developed by <a href="https://www.eldo.co.uk" target="blank">Eldo™</a>';
		}
	}
}
add_filter('admin_footer_text', 'modify_admin_footer');

// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

// Rename default page template
add_filter('default_page_template_title', function() {
    return __('Standard Page', 'your_text_domain');
});

// User contact details
function modify_contact_methods($profile_fields) {
	// Add new fields
	$profile_fields['twitter'] = 'Twitter Username';
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['instagram'] = 'Instagram URL';
	$profile_fields['pinterest'] = 'Pinterest URL';
	$profile_fields['linkedin'] = 'LinkedIn URL';
	$profile_fields['vimeo'] = 'Vimeo URL';

	// Remove old fields
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');



// Change login logo
function my_login_logo() { ?>

	<?php if( class_exists('acf') ) { ?>

		<?php
			$image_array = wp_get_attachment_image_src(get_field('logo', 'options'), 'full');
			$image_url = $image_array[0];
		?>

	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo $image_url; ?>;) !important;
			padding-bottom: 0px;
			background-size: contain;
			background-position: center;
			width: 100%;
			max-width: 300px;
		}
		body.login {
			background: #fff!important;
		}
		.login #login_error, .login .message, .login form {
			border-left: 2px solid #3498db;
			background-color: #f5f5f5!important;
		}
	</style>
	<?php } ?>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// ACF Flexible title in admin
add_filter('acf/fields/flexible_content/layout_title', function ($title, $field, $layout, $i) {
	 $title_field = apply_filters('acf_flexible_content_title_field', 'section_title', $field, $layout);
	 $title_value = get_sub_field($title_field);
	 return $title;
	//  return $title_value ? "<strong>$title_value</strong> - <small>$title</small>" :  "<i>Untitled</i> - <small>$title</small>";
}, 10, 4);

// Show ACF menu item for admins only
add_filter('acf/settings/show_admin', 'my_acf_show_admin');
function my_acf_show_admin( $show ) {
  return current_user_can('administrator');
}

//Disable ACF field group settings
add_filter( 'acf/field_group/disable_field_settings_tabs', '__return_true' );


/*
 * Change the featured image metabox title text
 */
function km_change_featured_image_metabox_title() {
	remove_meta_box( 'postimagediv', 'my_post_type_name', 'side' );
	add_meta_box( 'postimagediv', __( 'Banner Image', 'km' ), 'post_thumbnail_meta_box', 'page', 'side' );
}
add_action('do_meta_boxes', 'km_change_featured_image_metabox_title' );
/*--------------------------------------------------------------
# Adding things
--------------------------------------------------------------*/

// ACF options page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Admin Settings',
		'icon_url' => 'dashicons-hammer',
		'menu_title'	=> 'Admin',
		'capability'	=> 'administrator',
		'updated_message'	=> __("Admin Settings Updated", 'acf'),
	));
}


add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Custom Menu Page Title', 'Menu', 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 90 );
}



add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {
		if (get_field('enable_mega_menu', 'options')) {
			acf_add_options_page(array(
				'page_title'    => __('Mega Menu'),
				'menu_title'    => __('Mega Menu'),
				'menu_slug'     => 'mega-menu',
				'update_button' => __('Update Mega Menu', 'acf'),
				'capability'    => 'edit_theme_options',
				'icon_url'    => 'dashicons-menu-alt',
				'updated_message' => __("Mega Menu Updated", 'acf'),
				'redirect'      => false
			));
		}
    }
}




 
function eldo_welcome_notice() { 
	
	$screen = get_current_screen();
	
	if ($screen -> id == "dashboard") {
	?>

<div class="notice eldo notice-info is-dismissible">
	<div class="row">	
		<div class="col message">
			<?php $current_user = wp_get_current_user();
			$name = 'Hi there, ' . $current_user->user_firstname ; ?>
			<h1><strong><?php echo $name; ?></strong></h1>
			<?php if( class_exists('acf') ) { ?>
				<?php the_field('welcome', 'option'); ?>
			<?php } ?>
		</div>
			<div class="col-auto dash-logo">
			<?php if( class_exists('acf') ) { ?>
			<?php
				$image_array = wp_get_attachment_image_src(get_field('logo', 'options'), 'full');
				$image_url = $image_array[0];
			?>
			<img src="<?php echo $image_url; ?>">
				<a href="<?php echo home_url(); ?>" class="button">View Website</a>
			<?php } ?>
			</div>
		</div>

		<style>
		.dash-logo img {
			display: block;
			width: 100%;
			max-width: 280px;
			margin-bottom: 20px;
		}
		.notice.eldo h1 {
			margin-top: 0 !important;
			padding-top: 0 !important;
		}
		.notice.eldo h4 {
			font-size: 1.4em;
    		line-height: 1.4em;
			margin-bottom: 0;
		}
		.container {
			width: 100%;
			padding-right: 40px;
			padding-left: 40px;
			margin-right: auto;
			margin-left: auto;
			max-width: 1240px;
		}
		.col, .col-auto {
			padding: 0 20px;
		}
		.row {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -20px;
			margin-left: -20px;
		}
		.notice.eldo {
			padding: 40px;
		}
		.notice.eldo p {
			margin: 1em 0;
    		padding: 0;
		}
		.col-auto {
			-ms-flex: 0 0 auto;
			flex: 0 0 auto;
			width: auto;
			max-width: 100%;
		}
		.col {
			-ms-flex-preferred-size: 0;
			flex-basis: 0;
			-ms-flex-positive: 1;
			flex-grow: 1;
			min-width: 0;
			max-width: 100%;
		}
		</style>


      </div>
	  <?php } ?>
<?php } 


add_action( 'admin_notices', 'eldo_welcome_notice' );

remove_action('welcome_panel', 'wp_welcome_panel');



// Custom styles in WordPress admin
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() { ?>
	<style>
 .acf-fc-popup a {
		display: none;
	} 

	a[data-layout="one_third_two_third"],
a[data-layout="image_left_text_right"],
a[data-layout="layout_title"],
a[data-layout="call_to_actions"],
a[data-layout="testimonial"],
a[data-layout="text_boxes"],
a[data-layout="latest_posts"],
a[data-layout="text_left_image_right"],
a[data-layout="call_to_action"],
a[data-layout="features_list"],
a[data-layout="contact_details"],
a[data-layout="google_map"],
a[data-layout="featured_posts"],
a[data-layout="table"],
a[data-layout="upcoming_events"],
a[data-layout="accordion_layout"],
a[data-layout="background_video"],
a[data-layout="logos_layout"],
a[data-layout="counters"],
a[data-layout="counters_image"],
a[data-layout="featured_jobs"],
a[data-layout="featured_posts_grid"],
a[data-layout="post_categories"],
a[data-layout="image_top_text_bottom"],
a[data-layout="links_layout"],
a[data-layout="images"],
a[data-layout="gallery"],
a[data-layout="video_layout"],
a[data-layout="meet_the_team"],
a[data-layout="partners"],
a[data-layout="child_pages"],
a[data-layout="testimonial_grid"] {
display: block;
}


	.acf-field.acf-field-flexible-content {
		background: none !important;
	}
	#wp-content-editor-tools {
		background: #f5f5f5 !important;
	}
	.acf-fc-popup ul {
		max-height: 300px;
		overflow-y: auto;
	}
	.bgsettings .acf-field .acf-label {
		margin: 0;
	}
	.acf-actions {
		padding-bottom: 25px;
	}
	i.mce-ico.mce-i-plus {
		font-size: 20px !important;
	}
	.mce-i-plus:before {
		font-family: "dashicons", sans-serif !important;
		content: "\f236" !important;
	}
	.mega-menu .acf-repeater.-row > table > tbody > tr > td, .mega-menu .acf-repeater.-block > table > tbody > tr > td {
		border-bottom: 20px solid #ddd;
	}
	.mega-menu .additional-menus .acf-repeater.-row > table > tbody > tr > td, .mega-menu .additional-menus .acf-repeater.-block > table > tbody > tr > td {
  		border-bottom: 0;
	}
	.mega-menu .acf-accordion .acf-accordion-title {
		background: #eee;
	}
	.mega-menu .acf-accordion .acf-accordion-title:hover {
		background: #e7e7e7;
	}
	.bgsettings img {
		width: auto !important;
		height: 140px !important;
	}
	#main-section .acf-table>tbody>tr>td {
	  border-bottom: 20px solid #ddd;
	}
	#main-section .acf-field-flexible-content .acf-table>tbody>tr>td  {
		border-bottom: none;
	}
	a.acf-icon.-collapse.small {
	  display: block;
	}
	#adminmenu li.wp-menu-separator {
		margin-bottom:6px!important;
		margin-top:6px!important;
		background:rgba(255,255,255,0.2);
		height:3px
	}
	ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after {
		border-right-color: #ddd;
	}

	a.acf-button.button.button-primary {
	  border: none;
	  border-radius: 4px;
	  padding: 3px 10px;
	  text-transform: uppercase;
	  font-weight: bold;
	}
	.acf-repeater .acf-row-handle.order {
		color: #000;
	}
	.acf-tooltip {
		background: #222;
	}
	.acf-fc-popup ul {
		max-height: 275px;
		overflow-y: auto;
	}
	.acf-fc-popup a:hover {
		background: #3498db;
	}
	.acf-flexible-content .layout .acf-fc-layout-handle {
		font-size:15px;
	}
	.acf-flexible-content .layout {
		margin-top:30px
	}
	.bgsettings {
  		background: #f4f4f4;
	}
  </style>
<?php }

// Add custom image sizes to media library
 function display_custom_image_sizes( $sizes ) {
  global $_wp_additional_image_sizes;
  if ( empty($_wp_additional_image_sizes) )
    return $sizes;
  foreach ( $_wp_additional_image_sizes as $id => $data ) {
    if ( !isset($sizes[$id]) )
      $sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
  }
  return $sizes;
}
add_filter( 'image_size_names_choose', 'display_custom_image_sizes' );

// Add styles to WordPress editor
add_action( 'init', 'cd_add_editor_styles' );
function cd_add_editor_styles() {
    add_editor_style( get_stylesheet_uri() );
	add_editor_style('https://kit.fontawesome.com/fe5fa3d3c4.css');
}
function mce_mod( $init ) {
    unset($init['preview_styles']);
    $init['style_formats_merge'] = false;
    return $init;
}
add_filter('tiny_mce_before_init', 'mce_mod');

// Collapse all ACF Fields on load
function ACF_flexible_content_collapse() {
?>

<style id="acf-flexible-content-collapse">.acf-flexible-content .acf-fields { display: none; }</style>
<script type="text/javascript">
    jQuery(function($) {
		$('.acf-flexible-content .layout').not('.clones .layout').addClass('-collapsed');
        $('#acf-flexible-content-collapse').detach();
    });
</script>
<?php
}

add_action('acf/input/admin_head', 'ACF_flexible_content_collapse');

// Custom format styles dropdown
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

// Add button to WordPress editor
function my_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
		array(
		  'title' => 'Buttons & Links',
		  'items' => array(
			array( 'title' => 'Primary Button', 'selector' => 'a, button', 'classes' => 'button primary'),
			// array( 'title' => 'Secondary Button', 'selector' => 'a, button', 'classes' => 'button secondary'),
			array( 'title' => 'Secondary Button', 'selector' => 'a, button', 'classes' => 'button secondary'),
			array( 'title' => 'Text Link', 'selector' => 'a, button', 'classes' => 'text-link'),
			array( 'title' => 'Button Link', 'selector' => 'a, button', 'classes' => 'button-link'),
		  ),
		),
		// array(
		//   'title' => 'Titles',
		//   'items' => array(
		// 	array( 'title' => 'Pre-Title', 'selector' => 'h4', 'classes' => 'pt f'),
		// 	array( 'title' => 'Title', 'selector' => 'h2', 'classes' => 'lt f'),
		// 	array( 'title' => 'Subtitle', 'selector' => 'h4', 'classes' => 'st f'),
		//   ),
		// ),
		array(
		  'title' => 'Text',
		  'items' => array(
			array( 'title' => 'Bigger paragraph', 'selector' => 'p', 'classes' => 'bigger'),
			array( 'title' => 'Pre heading', 'selector' => 'p', 'classes' => 'pre-heading'),
			array( 'title' => 'Heading', 'selector' => 'h2', 'classes' => 'heading'),
		  ),
		),
		array(
		  'title' => 'Lists',
		  'items' => array(
			array( 'title' => 'List - Standard', 'selector' => 'ul', 'classes' => 'list standard'),
			array( 'title' => 'List - Ticks', 'selector' => 'ul', 'classes' => 'list ticks'),
		  ),
		),
	  );
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;

}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );



/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
From: https://brutalbusiness.com/automatically-set-the-wordpress-image-title-alt-text-other-meta/
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );
	}
}

/*--------------------------------------------------------------
# Security Ninja
--------------------------------------------------------------*/

// Disable application passwords
add_filter('wp_is_application_passwords_available', '__return_false');


/*--------------------------------------------------------------
# User permissions
--------------------------------------------------------------*/

// Allow Editors to manage users
function isa_editor_manage_users() {

    if ( get_option( 'isa_add_cap_editor_once' ) != 'done' ) {

        // let editor manage users

        $edit_editor = get_role('editor'); // Get the user role
        $edit_editor->add_cap('edit_users');
        $edit_editor->add_cap('list_users');
        $edit_editor->add_cap('promote_users');
        $edit_editor->add_cap('create_users');
        $edit_editor->add_cap('add_users');
        $edit_editor->add_cap('delete_users');

        update_option( 'isa_add_cap_editor_once', 'done' );
    }

}
add_action( 'init', 'isa_editor_manage_users' );

//prevent editor from deleting, editing, or creating an administrator
// only needed if the editor was given right to edit users

class ISA_User_Caps {

  // Add our filters
  function __construct() {
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }
  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }
  // If someone is trying to edit or delete an
  // admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){
    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

$isa_user_caps = new ISA_User_Caps();

// get the the role object
$role_objects = get_role( 'editor' );
$role_objects->add_cap('update_core');

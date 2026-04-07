<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package New
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
	
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/03def6a486.js" crossorigin="anonymous"></script>
	
	<?php wp_head(); ?>
	<?php if ( !has_post_thumbnail() ) { ?>
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
	<meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
	<?php } ?>
	<?php if( get_field('header_code', 'options') ) { echo '<!-- Start Header Code -->' . get_field('header_code', 'options') . '<!-- End Header Code -->';} ?>

	<?php if (is_singular('job')) { ?>
	
		<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "JobPosting",
	"title" : "<?php the_title(); ?>",
	"description" : "<?php echo get_the_excerpt(); ?>",
	"datePosted" : "<?php the_time('Y-m-d'); ?>",
	"hiringOrganization" : {
        "@type" : "Organization",
        "name" : "confidential"
      },
 
	"employmentType": [],
	"jobLocation": {
		"@type": "Place",
		"address": {
			"streetAddress": "",
			"addressLocality": "",
			"addressRegion": "",
			"addressCountry": "United Kingdom of Great Britain and Northern Ireland"
		}
	}
}
</script>

		
	<?php } ?>
</head>

<body <?php body_class(); ?>>



<?php if( get_field('body_code', 'options') ) { echo '<!-- Start Body Code -->' . get_field('body_code', 'options') . '<!-- End Body Code -->';} ?>

<nav id="mobile-menu-overlay" class="float dark-bg is-dark">

		<header id="mobile-header" class="float">
			<div class="container">
			  <div class="row justify-content-between align-items-center">
				  <div class="col logo">
			        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php echo wp_get_attachment_image_no_srcset( get_field('alternative_logo', 'options'), 'medium' ); ?>
			        </a>
			      </div>

			      <div class="col-auto close-button-wrap">
						<div class="close-menu">
							<i class="fas fa-times"></i>
						</div>
					</div>
			  </div>
	  		</div>
		</header>


		 
		<div class="mobile-center float d-flex align-items-center">

			<div class="float mobile-menu" id="mobile-main">
				<div class="container">
					<div class="row">
						<div class="col-12">
						    <?php
						      wp_nav_menu( array(
						        'theme_location' => 'menu-1',
						        'menu_id'        => 'mobile-menu',
						        'container' => false,
						        'menu_class' => 'sm sm-clean nav-menu'
						      ) );
						    ?>
						</div>
					</div>
					<div class="row narrow justify-content-between align-items-center mob-ctas">

						<?php if( get_field('phone_', 'options') ): ?>
							<div class="col button-wrap">
								<a class="button phone d-block" href="tel:<?php remove_whitespace(get_field('phone', 'options')); ?>">Call <i class="fas fa-phone"></i></a></span>
							</div>
						<?php endif; ?>

						<?php if( get_field('email_', 'options') ): ?>
							<div class="col button-wrap">
								<a class="button email d-block secondary" href="mailto:<?php the_field('email', 'options'); ?>">Email <i class="fas fa-envelope"></i></a>
							</div>
						<?php endif; ?>

							<?php
							$link = get_field('header_button', 'options');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<div class="col header-button-mobile button-wrap d-md-none">
								<a class="button d-block" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								</div>
							<?php endif; ?>
							<?php
							$link = get_field('header_button_2', 'options');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<div class="col header-button-mobile button-wrap d-md-none">
								<a class="button d-block" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								</div>
							<?php endif; ?>
							<div class="col-12 social">
								<?php include( get_template_directory() . '/inc/social-links.php'); ?>
							</div>
					</div>
				</div>
			</div>


		</div>
	</nav>


	<?php $header_layout = get_field('header_layout', 'option') ?: 'left-aligned'; ?>

	<?php if ($header_layout == 'left-aligned') {
		get_template_part( 'template-parts/header', 'left-aligned' );
	} ?>
	<?php if ($header_layout == 'full-width-menu') {
		get_template_part( 'template-parts/header', 'full-width-menu' );
	} ?>

	<nav id="mobile-menu-wrap" class="float d-lg-none standard">
		<div class="container">
			<?php
				wp_nav_menu( array(
				  'theme_location' => 'menu-1',
				  'menu_id'        => 'mobile-menu-standard',
				  'container' => false,
				  'menu_class' => 'sm sm-clean nav-menu'
				) );
			?>
		</div>
	</nav>

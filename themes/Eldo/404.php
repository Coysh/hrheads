<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package New
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="section clear error-404">
		<div class="container">
			<div class="row align-items-center">
				<div class="col" id="icon">
					<i class="fal fa-exclamation-circle"></i>
				</div>
				<div class="col">
					<h1 class="title-404">Oops! That page can't be found</h1>
					<p>It looks like nothing was found at this location. Use the menu above, or browse our <a href="<?php echo esc_url( home_url( '/' ) ); ?>">homepage</a>.</p>
					<?php if( get_field('email', 'options') ) { ?>
						<p>If you need any other help, just <a href="mailto:<?php the_field('email', 'options'); ?>">send us an email</a>.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

</article>
<?php
get_footer();

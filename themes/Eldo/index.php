<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package New
 */


if (get_field('disable_blog', 'options') && get_post_type() == 'post') {
	exit;
}

get_header();

$postsPage = get_option('page_for_posts');
$blogStyle = get_field('blog_style', 'option') ?: 'standard';
$showSidebar = get_field('show_sidebar', 'option') ?: false;

if ($showSidebar) {
	$columns = 'col-md-6';
} else {
	$columns = 'col-md-4';
}
?>

	<?php include( get_template_directory() . '/inc/banner.php'); ?>

  <?php if ($blogStyle == 'standard' || $blogStyle == 'classic') { ?>
		<?php if ( have_posts() ) : ?>
      <div class="section blog-<?php echo $blogStyle; ?><?php if ($showSidebar) { echo " has-sidebar"; } ?>" id="news-page">
  			<div class="container">
					<?php if( !$showSidebar ) { include( get_template_directory() . '/inc/category-dropdown.php'); } ?>
  				<div class="row">
  					<div class="col">
  						<div class="row narrow">
  							<?php while ( have_posts() ) : ?>
  								<?php the_post(); ?>
  								<div class="<?php echo $columns; ?> co d-flex excerpt-archive <?php echo $blogStyle; ?><?php if ( is_sticky() ) { ?> sticky<?php } ?>">
  									<?php
                    if ($blogStyle == 'standard') {
                      get_template_part( 'template-parts/content', 'excerpt' );
                    } elseif ($blogStyle == 'classic') {
                      get_template_part( 'template-parts/content', 'excerpt-classic' );
                    }
                  ?>
  								</div>
  							<?php endwhile; ?>
  							</div>
  						</div>
              <?php if ($showSidebar) { get_sidebar(); } ?>
  					</div>
  					<div class="pagination">
  						<?php echo paginate_links(); ?>
  					</div>
          </div>
          </div>
  			<?php else : get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	<?php } ?>

  <?php if ($blogStyle == 'isotope') { ?>
    <?php if ( have_posts() ) : ?>
      <div class="section" id="news-page">
        <div class="container">
          <div class="grid">
            <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <div class="grid-item post">
              <div class="excerpt-grid<?php if ( is_sticky() ) { ?> sticky<?php } ?>">
                <?php get_template_part( 'template-parts/content', 'excerpt' ); ?>
              </div>
            </div>
            <?php endwhile; ?>
            </div>
            <div class="pagination">
              <?php echo paginate_links(); ?>
            </div>
          </div>
        </div>
          <?php else : ?>
        <?php	get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
  <?php } ?>



<?php

get_footer();

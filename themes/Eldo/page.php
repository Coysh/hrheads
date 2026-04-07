<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package New
 */

get_header();
$homepageId = get_option( 'page_on_front' );
?>

<?php include( get_template_directory() . '/inc/banner.php'); ?>


<?php if (isset($_GET['all_pages'])) { ?>
	<?php
    $args = array(
      'post_type'              => array( 'page' ),
      'posts_per_page'         => '-1',
      'order'                  => 'ASC',
      'orderby'                => 'title',
      // 'post__not_in'           => array(6461), 
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
    $layouts_used = array();
    ?>
      <div class="float all-pages">
      <?php while ( $query->have_posts() ) { $query->the_post(); ?>
        <?php if( have_rows('section') ): ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
        <?php endif; ?>
      <?php }  ?>
    </div>

    <?php  }  else { ?>
    <?php } wp_reset_postdata(); ?>
<?php } ?>

  



<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );

	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>

<?php

get_footer();

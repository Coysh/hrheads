<?php
/*
  Default template for custom post types
*/

get_header();
$homepageId = get_option( 'page_on_front' );
?>


  <?php
  if (get_field('show_banner', 'options') && has_post_thumbnail()) {
  	include( get_template_directory() . '/inc/banner.php');
  }
  ?>

 <?php $parent = wp_get_post_parent_id( get_the_id() ); if ($parent != 0) { ?>
 <div id="breadcrumbs" class="section">
 	<div class="container">
 		<div class="row">
 			<div class="col-12">
 				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb();}?>
 			</div>
 		</div>
 	</div>
 </div>
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

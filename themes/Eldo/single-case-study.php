<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package New
 */


get_header();
?>

<?php include( get_template_directory() . '/inc/banner.php'); ?>

<div class="section" id="single-case-study">

	   
				<?php
				while ( have_posts() ) :
					the_post();

						get_template_part( 'template-parts/content-page');

				endwhile; // End of the loop.
				?>

 


				<?php

				$prevPost = get_previous_post();
				$nextPost = get_next_post(); ?>

				<?php
				if ($nextPost) {
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID,'small-cropped');
					if (!$nextthumbnail) {
						$nextthumbnail = '<img src="' . get_template_directory_uri() . '/images/placeholder.jpg' . '">';
					}
				}
				if ($prevPost) {
					$prevthumbnail = get_the_post_thumbnail($prevPost->ID,'small-cropped');

					if (!$prevthumbnail) {
						$prevthumbnail = '<img src="' . get_template_directory_uri() . '/images/placeholder.jpg' . '">';
				 	}
				}
				?>

   
        </div>
</div>






<?php if (is_singular('case-study') && geT_field('case_studies_page', 'options')) { ?>

	<section class="back-to tc">
	<div class="container">
	<a class="main-page text-link left" href="<?php the_field('case_studies_page', 'options'); ?>">Case Studies</a>
	</div>
</section>
            
           
          <?php } ?>

<?php
get_footer();

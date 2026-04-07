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

<div class="section" id="single-post">
	<div class="container">
	   
				<?php
				while ( have_posts() ) :
					the_post();

						get_template_part( 'template-parts/content-event');

				endwhile; // End of the loop.
				?>

			 
				<?php if( get_field('related_posts') ) { ?>
					<div id="related-posts" class="float clear">
						<h2>You may also like...</h2>
							<div class="row">
							<?php $posts = get_field('related_posts');
								if( $posts ): ?>
										<?php foreach( $posts as $post): ?>
											<div class="col-md-6 d-flex">
												<?php setup_postdata($post); ?>
											<?php get_template_part( 'template-parts/content', 'excerpt-related' ); ?>
											</div>

										<?php endforeach; ?>
								<?php wp_reset_postdata(); ?>
							<?php endif; ?>
							</div>
					</div>
				<?php } else { ?>
				<?php
					$cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
					$args = array(
					'post_type'              => array('post'),
					'posts_per_page'         => 4,
					'ignore_sticky_posts'	 => 1,
					'post__not_in'			 => array(get_the_ID()),
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $cats,
							'include_children' => true,
							'operator' => 'IN'
						)
					),
					'order'                  => 'DESC',
					'orderby'                => 'date',
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) { $i = 1; ?>
					<div id="related-posts" class="float clear">
						<h2>You may also like...</h2>
							<div class="row">
								<?php while ( $query->have_posts() ) { $query->the_post(); ?>
									<div class="col-md-6 d-flex">
										<?php get_template_part( 'template-parts/content', 'excerpt-related' ); ?>
									</div>
								<?php $i++; }  ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>



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

        <div id="post-nav" class="float clear">
          <div class="row">
            <?php if ($prevPost) { ?>
              <div class="prev-post col-sm-6">
              <?php // previous_post_link('%link', $prevthumbnail); ?>
              <?php previous_post_link('<h4>Previous Event</h4>'); ?>
              <?php previous_post_link('<h3>%link</h3>'); ?>
              </div>
            <?php } ?>
            <?php if ($nextPost) { ?>
              <div class="next-post col-sm-6">
                <?php // next_post_link('%link', $nextthumbnail); ?>
                <?php next_post_link('<h4>Next Event</h4>'); ?>
                <?php next_post_link('<h3>%link</h3>'); ?>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
</div>

<?php
get_footer();

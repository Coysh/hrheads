 





<div class="inner-section filters">
<div class="container">
  <div class="row">


	<div class="ui-group col-12 text-center">
		<!-- <p>Filter the Team:</p> -->
		<div class="filter" data-filter-group="department">


			<?php $departments = get_terms( array(
				'taxonomy' => 'testimonial-category',
				'hide_empty' => true,
				'orderby' => 'term_order'
				) );
			?>
			<button class="button white current" data-filter="*">All</button>
			<?php foreach ($departments as $department): ?>
				<button class="button white filter<?php if ($department->slug == 'onshore-crew'): ?> current<?php endif; ?>" data-filter=".<?php echo $department->slug; ?>"><?php echo $department->name; ?> Testimonials</button>

  
			<?php endforeach; ?>
		</div>
	</div>
  </div>
</div>
</div>

<div class="inner-section testimonial-grid">
	<div class="container big clear">
	 
		<div class="grid testimonials">

			<?php // WP_Query arguments
			$args = array(
			'post_type'              => array( 'testimonial' ),
			'posts_per_page'         => '-1',
			'order'                  => 'DESC',
			'orderby'                => 'rand',
			);

			// The Query
			$query = new WP_Query( $args );

			// The Loop
			if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
			$query->the_post(); ?>


			<?php $term_list = wp_get_post_terms($post->ID, 'testimonial-category', array("fields" => "slugs"));
			$departments = implode(' ', $term_list); ?>
			<?php $term_list = wp_get_post_terms($post->ID, 'testimonial-category', array("fields" => "names"));
			$departments2 = implode(', ', $term_list); ?>

			<?php
			    global $post;
			    $post_slug = $post->post_name;
			?>

				<div class="grid-item testimonial <?php echo $departments;?>">
        <div class="inner float">
        <div class="float">
			<p><i class="fa fa-quote-left"></i><?php the_field('testimonial'); ?><i class="fa fa-quote-right"></i></p>
		</div>
		<div class="float bottom">
			<div class="row narrow align-items-center">
			<?php if( get_field('image') ) { ?>
			<div class="col-auto">
				<?php echo wp_get_attachment_image( get_field('image'), 'thumbnail', false, array( 'loading' => false ) );?>
			</div>
			<?php } ?>
			<?php if( get_field('name') || get_field('company') ): ?>
				<div class="col author">
					<?php if( get_field('name') ) { ?>
						<?php the_field('name'); ?>
					<?php } ?>
					<?php if( get_field('name') ) { ?>
					<br>
					<span class="company">
						<?php the_field('company'); ?>
					</span>
					<?php } ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
        </div>
				</div>



			<?php	}
			} else {
			// no posts found
			}

			// Restore original Post Data
			wp_reset_postdata(); ?>

		</div>

	  </div>
 
</div>


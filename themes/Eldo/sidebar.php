<?php
/*
	The Blog Sidebar
*/

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area col d-lg-flex">
	<div class="inner float">
	<?php
		$post_type = get_post_type();
$singular = is_singular( "job" );

if ( $singular ) {
	if ( isset( $_COOKIE[ 'hrheads_jobs_viewed' ] ) ) {
		$visited_jobs = hrheads_get_last_viewed_cookie_array( 'hrheads_jobs_viewed' );
		if ( is_array($visited_jobs)) $visited_jobs = array_slice($visited_jobs, 0, 3);
		$args = array(
			'post__in' => $visited_jobs,
			'post_type' => 'job',
			'posts_per_page' => 3,
			'orderby' => 'post__in'
		);
		$visited_query = new WP_Query( $args );

		if ( $visited_query->have_posts() ) : ?>
		 	<section class="widget viewed">

		
					<h2>Recently Viewed Positions</h2>
					<?php /* Start the Loop */ ?>
					<?php while ( $visited_query->have_posts() ) : $visited_query->the_post(); ?>
				 	<div class="float item-wrap">

				
					<?php
 
$job_meta = hrheads_get_job_meta( get_the_ID() );
$salary = ( get_field('custom_salary_display') ) ? get_field('custom_salary_display') : $job_meta['salary_scale'];

?>
 	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <dl class="picks__job-list">
		<?php if ( $job_meta['location'] ) printf('<dt class="show-for-sr">Location</dt><dd class="picks__job-location"><i class="fa-solid fa-location-dot"></i>  %s</dd>', $job_meta['location']) ?>
		<?php if ( $salary )  printf('<dt class="show-for-sr">Salary</dt><dd class="picks__job-salary">%s</dd>', $salary) ?>
    </dl>

 
	</div>
							 <?php endwhile; ?>
						 
					
 


		
			<?php wp_reset_postdata(); ?>
		<?php endif; // End have_posts() check.
?>
  </section>
<?php	}
}
?>

		<?php if ($singular) { ?>
		
			<?php
    $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-3');
    $cats = get_sub_field('event_type');
    $today = date('Ymd');


    if ($cats) {
      $args = array(
        'post_type'              => 'event',
        'posts_per_page'         => get_sub_field('max_posts') ?: 3,
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'event_type',
                'field' => 'id',
                'terms' => $cats,
                'include_children' => true,
                'operator' => 'IN'
            )
        ),
        'orderby' => 'meta_value_num',

  				'order'	=> 'ASC',
        'meta_key'     => 'end_date',
        'meta_value'   => $today,
        'meta_compare' => '>=',
      );
    } else {
      $args = array(
        'post_type'              => 'event',
        'posts_per_page'         => get_sub_field('max_posts') ?: 4,
        'ignore_sticky_posts' => 1,
        'orderby' => 'meta_value_num',
      
          'order'	=> 'ASC',
        'meta_key'     => 'end_date',
        'meta_value'   => $today,
        'meta_compare' => '>=',
      );
    }

    $latest = new WP_Query( $args );

    if ( $latest->have_posts() ) { $i = 1; ?>
	<section class="widget ue">


	<h2 class="upcoming-events">Upcoming Events</h2>
    <div class="row">
      <?php while ( $latest->have_posts() ) { $latest->the_post(); ?>
        <div class="col-12 column d-flex" data-wow-delay="<?php echo $i / 8; ?>s">
          <?php get_template_part( 'template-parts/content-excerpt', get_post_type() ); ?>
        </div>
       <?php $i++; }  ?>
     </div>
	 </section>
   <?php  } else { echo "There are currently no events to display.";?>
 <?php } wp_reset_postdata(); ?>
		<?php } ?>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>

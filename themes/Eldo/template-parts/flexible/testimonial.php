<?php
$show = get_sub_field('show') ?: 'all';

if ($show == 'custom') {
  $count = count( get_sub_field('testimonials') );
  if ($count == 1) {
    $class = 'testimonial-slider has-one';
  } else {
    $class = 'testimonial-slider';
  }
}  else {
  $class = 'testimonial-slider';
}

$limit = get_sub_field('limit') ?: 10;
?>

<div class="inner-section testimonials">
  <div class="testimonial-slider">
    <?php if ($show == 'all') { ?>
      <?php
      $args = array(
        'post_type' => 'testimonial',
        'orderby' => 'rand',
        'order'   => 'DESC',
        'posts_per_page' => $limit,
      );
      $query = new WP_Query( $args );
      ?>
      <?php if( $query->have_posts() ) { ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <?php get_template_part( 'template-parts/content-excerpt-t-slide' ); ?>
        <?php endwhile; ?>
      <?php } ?>
      
     <?php wp_reset_query(); ?>
    <?php } elseif ($show == 'custom') { ?>
        <?php
        $featured_posts = get_sub_field('testimonials');
        if( $featured_posts ): ?>
          <?php foreach( $featured_posts as $post ): setup_postdata($post); ?>
              <?php get_template_part( 'template-parts/content-excerpt-t-slide' ); ?>
          <?php endforeach; ?>

        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
  <?php } ?>
    </div>
</div>

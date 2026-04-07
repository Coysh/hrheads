<div class="inner-section upcoming-events">
<div class="container">
  <?php if( get_sub_field('section_title') ): ?>
    <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
  <?php endif; ?>

    <?php
    $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-3');
    $cats = get_sub_field('event_type');
    $today = date('Ymd');


    if ($cats) {
      $args = array(
        'post_type'              => 'event',
        'posts_per_page'         => get_sub_field('max_posts') ?: 4,
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
    <div class="row">
      <?php while ( $latest->have_posts() ) { $latest->the_post(); ?>
        <div class="<?php echo $cols; ?> column d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
          <?php get_template_part( 'template-parts/content-excerpt', get_post_type() ); ?>
        </div>
       <?php $i++; }  ?>
     </div>
   <?php  } else { echo "There are currently no events to display.";?>
 <?php } wp_reset_postdata(); ?>
	 <?php
		$link = get_sub_field('button');
		if( $link ):
		    $link_url = $link['url'];
		    $link_title = $link['title'];
		    $link_target = $link['target'] ? $link['target'] : '_self';
		    ?>
			 <div class="tc">
			    <a class="button alt" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
		<?php endif; ?>
</div>
</div>

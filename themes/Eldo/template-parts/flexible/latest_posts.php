<div class="inner-section latest-posts">
<div class="container">
    <?php
    $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-4');
    $cats = get_sub_field('category');
    $case_study_cats = get_sub_field('case_study_category');


    $post_type = get_sub_field('post_type') ?: 'post';

    if ($cats) {
      $args = array(
        'post_type'              => array( $post_type ),
        'posts_per_page'         => get_sub_field('max_posts'),
        'ignore_sticky_posts' => 1,
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
    } elseif ($case_study_cats) { 
      $args = array(
        'post_type'              => array( $post_type ),
        'posts_per_page'         => get_sub_field('max_posts'),
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'case-study-category',
                'field' => 'id',
                'terms' => $case_study_cats,
                'include_children' => true,
                'operator' => 'IN'
            )
        ),
        'order'                  => 'DESC',
        'orderby'                => 'date',
      ); 
    }else {
      $args = array(
        'post_type'              => array( $post_type ),
        'posts_per_page'         => get_sub_field('max_posts'),
        'ignore_sticky_posts' => 1,
        'order'                  => 'DESC',
        'orderby'                => 'date',
      );
    }

    $latest = new WP_Query( $args );

    if ( $latest->have_posts() ) { $i = 1; ?>
    <div class="row">
      <?php while ( $latest->have_posts() ) { $latest->the_post(); ?>

        
        <div class="<?php echo $cols; ?> ex-<?php echo get_post_type(); ?> d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
          <?php get_template_part( 'template-parts/content-excerpt', get_post_type() ); ?>
        </div>
       <?php $i++; }  ?>
     </div>
   <?php  } else { echo "There are currently no latest posts to display.";?>
 <?php } wp_reset_postdata(); ?>
</div>
</div>

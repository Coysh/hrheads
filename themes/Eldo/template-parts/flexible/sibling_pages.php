<?php $parent = wp_get_post_parent_id( get_the_id() ); if ($parent != 0) { ?>
    <?php
      $currentId = get_the_ID();
      $args = array(
        'post_type'              => array( 'page' ),
        'posts_per_page'         => '-1',
        'post_status' 					 => 'publish',
        'post_parent'            => wp_get_post_parent_id(get_the_ID()),
        'order'                  => 'ASC',
        'post__not_in'           => array(get_the_ID()),
        'orderby'                => 'menu_order',
      );

      // The Query
      $query = new WP_Query( $args );

      // The Loop
      if ( $query->have_posts()) {  $i = 1; ?>
        <div class="inner-section sibling-pages">

          <div class="container clear">
            <div class="row justify-content-center">
            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
              <div class="d-flex col-md-6 col-lg-4 sibling-page <?php if ($currentId == get_the_ID()) {echo "current";} ?>">
                <?php get_template_part( 'template-parts/content-excerpt-sibling-page'); ?>
              </div>
              <?php $i++;  }  ?>
            </div>
            
          <?php } else { ?>
            <?php if (is_user_logged_in()): ?>
              <div class="float">
                <div class="container no-block">
                  <h3>Empty Block</h3>
                  <p>This page has no siblings.</p>
                </div>
              </div>
            <?php endif; ?>
          <?php } ?>
          <div class="float text-center parent-page">
              <a href="<?php echo get_the_permalink(wp_get_post_parent_id(get_the_id())); ?>"><i class="fas fa-chevron-left"></i> <?php echo get_the_title(wp_get_post_parent_id(get_the_ID())); ?></a>
            </div>
        </div>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php } else { ?>
      <?php if (is_user_logged_in()): ?>
      <div class="float">
        <div class="container no-block">
          <h3>Empty Block</h3>
          <p>This page has no siblings.</p>
        </div>
      </div>
        <?php endif; ?>
    <?php } ?>

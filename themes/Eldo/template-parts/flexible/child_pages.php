<div class="inner-section child-pages">
    <div class="container clear">
        <div class="row">
            <?php
            $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-4');
              if (get_sub_field('child_pages_of')) {
                $parent_id = get_sub_field('child_pages_of', false, false);
              } else {
                $parent_id = get_the_ID();
              }

              $args = array(
                'post_type'              => array( 'page' ),
                'posts_per_page'         => '-1',
                'post_status' 					 => 'publish',
                'post_parent'            => $parent_id,
                'order'                  => 'ASC',
                'orderby'                => 'menu_order',
              );
              // The Query
              $query = new WP_Query( $args );
              // The Loop
              if ( $query->have_posts() ) { $i = 1; ?>
                <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                  <div class="<?php echo $cols; ?> excerpt-page d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
                      <?php get_template_part( 'template-parts/content-excerpt-page' ); ?>
                  </div>
                <?php $i++;  }  ?>
                <?php } else {  ?>
                  <?php if (is_user_logged_in()): ?>
                    <div class="float">
                      <div class="container no-block">
                        <h3>No child pages found</h3>
                        <p>If you're seeing this, it means that there is a child block added to the page, but there are no child pages of <strong><?php echo get_the_title($parent_id); ?></strong>.</p>
                      </div>
                    </div>
                <?php endif; ?>
            <?php } ?>
            <?php wp_reset_postdata();  ?>
        </div>
    </div>
</div>
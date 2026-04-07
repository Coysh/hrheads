 

<div class="inner-section post-categories">
  <div class="container large">
 

    <?php
    $categories = get_sub_field('categories');
    $cols = cols('columns', 'col-md-6 col-lg-4');

    if( $categories ): ?>

        <div class="row narrow">
          
          <?php if( get_sub_field('section_title') ): ?>
            <div class="cat col-md-4 title-wrap d-flex">
              <div class="inner text float d-flex flex-column justify-content-center">
                <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2> 

                <?php if( get_sub_field('description') ) { ?>
                <?php the_sub_field('description'); ?>
                <?php } ?>
                
              </div>
      
      </div>
        <?php endif; ?>
          
        <?php foreach( $categories as $category ): ?>
          <?php $icon = get_field('icon', $category); ?>

          <div class="<?php echo $cols; ?> cat d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
            <div class="inner float d-flex flex-column">
              <h2 class="section-title">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                <div class="row narrow align-items-center">
                <?php if ($icon) { ?>
                  <div class="col-auto icon">
                    <?php echo wp_get_attachment_image( $icon, 'small' ); ?>
                  </div>
                <?php } ?>

                  <div class="col">
                    <?php echo esc_html( $category->name ); ?>
                  </div>
                </div>
                

           
              </a>
              </h3>
              <?php
              $cat_slug = $category->slug;
              $args = array(
                'post_type'              => array( 'post' ),
                'posts_per_page'         => '4',
                'order'                  => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $cat_slug,
                    ),
                  ),
                'orderby'                => 'date',
              );

              $query = new WP_Query( $args );

              if ( $query->have_posts() ) {  $b = 0; ?>

              	<?php while ( $query->have_posts() ) { $query->the_post(); ?>

                  
                  <?php 
                    
                  
                    if (get_field('url')) {
                      $permalink = get_field('url');
                      
                      $target = '_blank';
                    } else {
                      $permalink = get_the_permalink();
                      $target = '_self';
                    }  
                  ?>

                  <?php if ($b == 0) { ?>
                      <div class="cat-title float">
                        <a class="float link-wrap<?php if (get_field('url')) { ?> external<?php } ?>" href="<?php echo $permalink;?>" target="<?php echo $target; ?>">
                          <div class="excerpt-thumb float clear">
                        <?php if ( has_post_thumbnail(get_the_ID()) ) { ?>
                        <?php
                       if (is_home() && 'isotope' === get_field('blog_style', 'options')) {
                         the_post_thumbnail('medium');
                       } else {
                          echo wp_get_attachment_image( get_post_thumbnail_id(), 'small' );
                       }
                       ?>
                     <?php } else { ?>
                       <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php bloginfo( 'name' ); ?>">
                     <?php }?>

                    </div>
                    <span class="date"><?php the_time('d/m/y')?></span>
                    <h4><?php the_title(); ?></h4>

                    
                    <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 140, "..."); ?></p>
                    </a>
                    </div>
                  <?php } else { ?>
                    <div class="cat-title float">
                      <h4>
                        <a href="<?php echo $permalink;?>" target="<?php echo $target; ?>">
                        <div class="row narrow align-items-center justify-content-between">
                        <div class="col-auto">
                          <span class="date"><?php the_time('d/m/y')?></span>
                          </div>
                        
                          <div class="col">
                            <span class="small-post-title"><?php the_title(); ?><?php if (get_field('url')) { ?>
      <i class="external fa-solid fa-arrow-up-right-from-square"></i>
    <?php } ?></span>
                          </div>

                         
                        
                        </div>
                        
                      </a>
                    </h4>
                    </div>
                  <?php } ?>
              	<?php $b++;  }  ?>

              <?php  }  else { ?>
              	<!-- // no posts found -->
                <p>No posts to display.</p>
              <?php } wp_reset_postdata(); ?>

             <?php // echo esc_html( $category->description ); ?>

              <div class="view-all float bottom">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">View All <i class="fa-regular fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</div>
 
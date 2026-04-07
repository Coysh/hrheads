<div class="inner-section meet-team tc">
  <div class="container">

    <?php
    $cols = cols('columns', 'col-12 col-sm-6 col-md-4 col-lg-3');
    $posts = get_sub_field('team');
      
    if( $posts ): $i = 1; ?>
      <div class="row justify-content-center">
      <?php if( get_sub_field('intro_text') ) { ?>
      <div class="cta col-12 d-flex anim fadeIn intro">
        <div class="inner float d-flex flex-column justify-content-center">
          <?php the_sub_field('intro_text'); ?>  
        </div>
      </div>
      <?php } ?>
      
        <?php foreach( $posts as $post): ?>
          <?php setup_postdata($post); ?>
            <div class="<?php echo $cols; ?> d-flex member justify-content-center d-flex anim zoomIn" data-wow-delay="<?php echo $i / 8; ?>s">
              <div class="inner float d-flex flex-column">
              <?php if( get_field('bio') ): ?>
                <a class="image-link fancybox" data-fancybox="team" data-options='{"touch" : false}' data-src="#modal-<?php echo get_the_ID(); ?>" href="javascript:;">
              <?php endif; ?>

              <?php if (get_field('photo')) { ?>
                <?php echo wp_get_attachment_image( get_field('photo'), 'large-thumbnail' ); ?> 
              <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/user-placeholder.jpg" class="" alt="<?php bloginfo( 'name' ); ?>">
              <?php } ?>
              
              <?php if( get_field('bio') ): ?>
                </a>
              <?php endif; ?>

              <h3 class="team-title"><?php the_title(); ?></h3>

              <?php if( get_field('title') ): ?>
                <h4 class="team-subtitle"><?php the_field('title'); ?></h4>
              <?php endif; ?>

              <?php if( get_field('bio') ): ?>
                <div class="float bottom">
                  <a class="button-link" data-fancybox="team-button" data-options='{"touch" : false}' data-src="#modal-<?php echo get_the_ID(); ?>" href="javascript:;">Read More</a>
                </div>
              <?php endif; ?>
              </div>
            </div>

            <div style="display: none;" class="modal" id="modal-<?php echo get_the_ID(); ?>">
                <div class="modal-team">
                  <div class="row">
                    <div class="col-md-5 col-lg-5">
                      <?php if (get_field('photo'))  { ?>
                        <div class="modal-image image small">
                        <?php echo wp_get_attachment_image( get_field('photo'), 'large-thumbnail' ); ?>
                        </div>
                      <?php } else { ?>
                        <div class="modal-image image small">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/user-placeholder.jpg" class="" alt="<?php bloginfo( 'name' ); ?>">
                        </div>
                        <?php } ?>


                        <?php if( get_field('email') ) { ?>
                        <p class="link-wrap email"><a href="mailto:<?php the_field('email'); ?>"><i class="fas fa-envelope"></i> <?php the_field('email'); ?></a></p>
                      <?php } ?>

                      <?php if( get_field('phone') ) { ?>
                        <p class="link-wrap phone"><a href="tel:<?php remove_whitespace(get_field('phone')); ?>"><i class="fas fa-phone"></i> <?php the_field('phone'); ?></a></p>
                      <?php } ?>
                      <?php if( get_field('linkedin') ): ?>
                      <p class="link-wrap linkedin">
                        <a href="<?php the_field('linkedin'); ?>" class="social-link d-inline-flex align-items-center justify-content-center linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                      </p>
                      <?php endif; ?>

                        <?php
                        $link = get_field('booking_link');
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>

                            <p><a class="button secondary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
                        <?php endif; ?>
                  
                    </div>
                    <div class="col">
                    <h2 class="modal-name"><?php the_title(); ?></h2>
                    <?php if( get_field('title') ): ?>
                      <h3 class="modal-title"><?php the_field('title'); ?></h3>
                    <?php endif; ?>

               


                    <?php the_field('bio'); ?>
                    </div>
                  </div>
                </div>
            </div>
           <?php $i++; endforeach; ?>
        </div>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  </div>
</div>

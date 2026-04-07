<div class="inner-section contact-details">
  <div class="container">
    <div class="row align-items-center">
      <div class="col contact-info order-2 order-lg-2">
        <?php if( get_field('phone', 'options') ): ?>
          <div class="float phone detail">
            <h3 class="d-flex align-items-center"><i class="fa-solid fa-phone"></i> Telephone</h3>
            <p>
              <div class="row narrow">
                <?php if( get_field('phone_label', 'options') ) { ?>
                  <div class="col-auto label">
                    <?php the_field('phone_label', 'options'); ?>:
                  </div>
                  <?php } ?>
                  <div class="col">
                    <a href="tel:<?php remove_whitespace(get_field('phone', 'options')); ?>"><?php the_field('phone', 'options'); ?></a></p>
                  </div>
               
              </div>
              
          </div>
        <?php endif; ?>

        <?php if ( have_rows('additional_phone_numbers', 'options') ) : ?>
          <div class="float phone-extra detail">
          <?php while( have_rows('additional_phone_numbers', 'options') ) : the_row(); ?>
          <div class="row narrow">
          <?php if( get_sub_field('label') ) { ?>
              <div class="col-auto label">
                <?php the_sub_field('label'); ?>:
              </div>
            <?php } ?>
          <?php if( get_sub_field('phone_number') ) { ?>
            <div class="col number-wrap">
              <p><a href="tel:<?php remove_whitespace(get_sub_field('phone_number')); ?>"><?php the_sub_field('phone_number'); ?></a></p>
            </div>
          <?php } ?>
          </div>        
          <?php endwhile; ?>
          </div>
        <?php endif; ?>
        

        <?php if( get_field('email', 'options') ): ?>
          <div class="float email detail">
            <h3 class="d-flex align-items-center"><i class="fa-solid fa-envelope"></i> Email</h3>
            <p>
              <div class="row narrow">
                <?php if( get_field('email_label', 'options') ) { ?>
                  <div class="col-auto label">
                    <?php the_field('email_label', 'options'); ?>:
                  </div>
                <?php } ?>
                  <div class="col">
                  <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a>
                  </div>
              </div>
            
            </p>
          </div>
        <?php endif; ?>


        <?php if ( have_rows('additional_email_addresses', 'options') ) : ?>
          <div class="float email-extra detail">
          <?php while( have_rows('additional_email_addresses', 'options') ) : the_row(); ?>
          <div class="row narrow">
          <?php if( get_sub_field('label') ) { ?>
              <div class="col-12 label">
                <?php the_sub_field('label'); ?>:
              </div>
            <?php } ?>
          <?php if( get_sub_field('email') ) { ?>
            <div class="col email-wrap">
             <p><a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></p>
            </div>
          <?php } ?>
          </div>        
          <?php endwhile; ?>
          </div>
        <?php endif; ?>

        <?php if( get_field('address', 'options') ): ?>
          <div class="float address detail">
            <h3 class="d-flex align-items-center"><i class="fa-solid fa-location-dot"></i> Address</h3>
            <p><?php the_field('address', 'options'); ?></p>
          </div>
        <?php endif; ?>

        <?php if( have_rows('business_hours', 'option') ): ?>
          <div class="float bh detail">
            <h3 class="d-flex align-items-center"><i class="fa-solid fa-clock"></i> Business Hours</h3>
            <?php while( have_rows('business_hours', 'option') ): the_row(); ?>
              <div class="inner float">
                <div class="row align-items-center narrow justify-content-between">
                  <div class="col-12 col-sm business-day">
                    <?php the_sub_field('day'); ?>
                  </div>
                  <div class="col-12 col-sm-auto business-time">
                    <?php the_sub_field('times'); ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>

          <?php if( get_field('business_hours_notes', 'option') ) {?>
            <div class="notes float">
              <em><?php the_field('business_hours_notes', 'option'); ?></em>
            </div>
          <?php } ?>
          </div>
        <?php endif; ?>

      <div class="float social-wrap detail">
        <h3 class="d-flex align-items-center"><i class="fa-solid fa-thumbs-up"></i> Social</h3>
        <?php include( get_template_directory() . '/inc/social-links.php'); ?>
        </div>
      </div>

    <div class="col-lg-7 col-xl-7 form-wrap order-2 order-lg-2">
      <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
    </div>
  </div>
</div>

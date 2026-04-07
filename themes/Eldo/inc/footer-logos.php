<?php if ( have_rows('footer_logos', 'options') ) : ?>
<section class="footer-logos">
  <div class="container">
    <div class="row justify-content-center justify-content-md-between align-items-centers">
      <div class="col-12 col-md d-flex align-items-center">
      <?php $cols = cols('columns', 'col-auto'); ?>
        <div class="inner-section logo-carousel">
          <?php if( get_field('footer_logos_carousel', 'options') ) { ?>
            <div class="container carousel-wrap">
            <?php if( have_rows('footer_logos', 'options') ): $i = 1; ?>
              <div class="carousel">
                <?php while( have_rows('footer_logos', 'options') ): the_row(); ?>
                  <div class="carousel-image">
                    <?php echo wp_get_attachment_image( get_sub_field('logo'), 'small', false, array( 'loading' => false ) );?>
                  </div>
                <?php $i++; endwhile; ?>
              </div>
            <?php endif; ?>
            </div>
          <?php } else { ?>
            <div class="container">
            <?php if( have_rows('footer_logos', 'options') ): $i = 1; ?>
              <div class="row align-items-center logo-row justify-content-center justify-content-md-start justify-content-lg-start">
                <?php while( have_rows('footer_logos', 'options') ): the_row(); ?>
                <div class="<?php echo $cols; ?> logo-wrap">
                <?php $link = get_sub_field('link'); ?>
                    <?php if( $link ): ?>
                      <a class="image-link" href="<?php echo $link; ?>" target="_blank">
                    <?php endif; ?>
                      <?php echo wp_get_attachment_image_no_srcset( get_sub_field('logo'), 'small' ); ?>
                    <?php if( $link ): ?>
                      </a>
                    <?php endif; ?>
                    </div>
                  <?php $i++; endwhile; ?>
              </div>
            <?php endif; ?>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="col-auto part-of">
          <?php if( get_field('heads_resourcing_logo', 'options') ) { ?>
            <span class="h4">Part of:</span>
            <?php echo wp_get_attachment_image( get_field('heads_resourcing_logo', 'options'), 'small' ); ?>
          <?php } ?>
      </div>
      <div class="col-auto">
      <span class="h4">Our Sister Brands:</span>
            <ul class="list standard">
              <li><a href="https://www.executiveheads.co.uk/" target="_blank">Executive Heads</a></li>
              <li><a href="https://www.procurementheads.com/" target="_blank">Procurement Heads</a></li>
            </ul>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
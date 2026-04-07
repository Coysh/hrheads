<?php $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-3'); ?>
<div class="inner-section logo-carousel">

  <?php if( get_sub_field('carousel') ) { ?>
    <div class="container carousel-wrap">
    <?php if( have_rows('logos') ): $i = 1; ?>
      <div class="carousel">
        <?php while( have_rows('logos') ): the_row(); ?>
          <div class="carousel-image">
          <?php $link = get_sub_field('link'); ?>
            <?php if( $link ): ?>
              <a class="image-link" href="<?php echo $link; ?>">
            <?php endif; ?>
            <?php echo wp_get_attachment_image( get_sub_field('image'), 'small', false, array( 'loading' => false ) );?>
            <?php if( $link ): ?>
              </a>
            <?php endif; ?>
          </div>
        <?php $i++; endwhile; ?>
      </div>
    <?php endif; ?>
    </div>
  <?php } else { ?>
    <div class="container">
    <?php if( have_rows('logos') ): $i = 1; ?>
      <div class="row align-items-center logo-row justify-content-center">
        <?php while( have_rows('logos') ): the_row(); ?>
        <div class="<?php echo $cols; ?> logo-wrap">
        <?php $link = get_sub_field('link'); ?>
            <?php if( $link ): ?>
              <a class="image-link" href="<?php echo $link; ?>">
            <?php endif; ?>
              <?php echo wp_get_attachment_image_no_srcset( get_sub_field('image'), 'small' ); ?>
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

<div class="inner-section image-top">
  <div class="container">
    <?php $cols = cols('columns', 'col-md-6'); ?>
    <?php if( have_rows('content') ): ?>
      <div class="row">
        <?php while( have_rows('content') ): the_row(); ?>
          <div class="<?php echo $cols; ?> d-flex ittb">
            <div class="inner flex-column">
              <div class="float image-wrap">
                <?php if (get_sub_field('no_crop')) {
                  $imageSize = 'medium';
                } else {
                  $imageSize = 'medium-cropped';
                }
                ?>
                <?php echo wp_get_attachment_image( get_sub_field('image'), ''.$imageSize.'' ); ?>
              </div>
              <div class="content float">
                <?php the_sub_field('text'); ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

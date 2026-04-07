<?php $images = get_sub_field('gallery'); ?>

<div class="inner-section gallery count-<?php echo count( $images ); ?>">
  <div class="container">
    <?php if( $images ): $i = 1; ?>
      <div class="row">
         <?php foreach( $images as $image ): ?>
          <div class="gallery-image co col anim fadeIn" data-wow-delay="<?php echo $i / 7; ?>s">
            <a href="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>" data-fancybox="gallery<?php echo get_row_index(); ?>" data-caption="<?php echo $image['caption']; ?>" >
              <div class="inner">
                <?php echo wp_get_attachment_image( $image['ID'], 'large-thumbnail' ); ?>
              </div>
            </a>
          </div>
         <?php $i++; endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

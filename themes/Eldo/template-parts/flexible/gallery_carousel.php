<?php $images = get_sub_field('gallery'); ?>
<?php if ($images) { ?>
  <?php $count = count($images); ?>
<?php } else { ?>
  <?php $count = 0; ?>
<?php } ?>

  <div class="inner-section gallery-carousel count-<?php echo $count; ?>">
    <div class="container">
      <?php if( $images ): $i = 1; $j = 1; ?>
        <div class="float gallery-carousel-wrap">
          <div class="float gallery-main" data-flickity='{ "cellAlign": "center", "contain": true, "prevNextButtons":false, "pageDots":false, "draggable":false, "imagesLoaded":true, "wrapAround":false, "fade":true}'>
            <?php foreach( $images as $image ): ?>
               <div class="image float">
                  <?php echo wp_get_attachment_image( $image['ID'], 'large' ); ?>
               </div>
            <?php $i++; endforeach; ?>
          </div>

          <div class="float gallery-thumbs" data-flickity='{ "asNavFor": ".gallery-main", "imagesLoaded": true, "groupCells":true, "freeScroll":true, "cellAlign": "center", "pageDots":false, "wrapAround":true}'>
            <?php foreach( $images as $image ): ?>
             <div class="thumb">
                <?php echo wp_get_attachment_image( $image['ID'], 'thumbnail' ); ?>
             </div>
            <?php $j++; endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

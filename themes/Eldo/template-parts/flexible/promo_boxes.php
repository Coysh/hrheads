<div class="inner-section promo-boxes">
<div class="container">
  <?php $cols = cols('columns', 'col'); ?>
  <?php if( have_rows('boxes') ): $i = 1; ?>
    <div class="row">
    <?php while( have_rows('boxes') ): the_row(); $link = get_sub_field('link');  ?>
      <?php
        
        if (get_sub_field('image')) {
          $image_array = wp_get_attachment_image_src(get_sub_field('image'), 'medium');
          $image_url = $image_array[0];
        }
        
      ?>
      <div class="promo-box <?php echo $cols; ?> d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
        <div class="inner float d-flex flex-column cover" <?php if (get_sub_field('image')) { ?>style="background-image: url(<?php echo $image_url; ?>);<?php } ?>">
          <div class="float">
            <?php if( get_sub_field('title') ) { ?>
              <h3><?php the_sub_field('title'); ?></h3>
            <?php } ?>

            <?php if( get_sub_field('description') ) { ?>
              <?php the_sub_field('description'); ?>
            <?php } ?>
          </div>
          <div class="float bottom">
            <a class="button" href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title'] ?: 'Read More'; ?></a>
          </div>
        </div>
      </div>
   <?php $i++; endwhile; ?>
   </div>
  <?php endif; ?>
</div>
</div>

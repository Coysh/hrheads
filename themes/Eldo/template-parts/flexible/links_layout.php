<div class="inner-section links">
<div class="container">
  <div class="row">
 
      <?php $cols = cols('columns', 'col-md-4'); ?>
    <?php if( have_rows('links') ): $i = 1; ?>

      <?php while( have_rows('links') ): the_row(); ?>
        <div class="<?php echo $cols; ?> link d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
          <div class="box d-flex flex-column">  

        <?php if( get_sub_field('image') ) { ?>
          <div class="link-image float">
            <?php echo wp_get_attachment_image( get_sub_field('image'), 'small' ); ?>
          </div>
        <?php } ?>

            <?php

            $link = get_sub_field('link');

            if( $link ): ?>

            <?php if( get_sub_field('title') ): ?>
              <h3 class="link-title"><?php the_sub_field('title'); ?></h3>
            <?php endif; ?>
            <?php if( get_sub_field('description') ) { ?>
              <p class="link-description"><?php the_sub_field('description'); ?></p>
            <?php } ?>
              <div class="float bottom">
                <a class="button secondary" href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title'] ?: 'Visit Website'; ?><?php if ($link['target']) { ?> <i class="fas fa-external-link-alt"></i><?php } ?></a>
              </div>
            <?php endif; ?>

          </div>

        </div>
      <?php $i++; endwhile; ?>
    <?php endif; ?>
  </div>
</div>
</div>

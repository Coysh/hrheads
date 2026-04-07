<div class="inner-section image-left full-width number-counter with-image">
  <div class="container-fluid np">
    <div class="row no-gutters align-items-center">
      <div class="col-lg-6 col-xl-6 image-wrap anim fadeInLeft">
        <?php if (get_sub_field('no_crop')) {
          $imageSize = 'large';
        } else {
          $imageSize = 'large-cropped';
        }
        ?>
        <?php echo wp_get_attachment_image( get_sub_field('image'), ''.$imageSize.'' ); ?>
      </div>
      <div class="col-lg-6 col-xl-6 text d-flex flex-column justify-content-center">
        <div class="inner float">


        <?php if( get_sub_field('title') ) { ?> 
        <h2 class="lt"><?php the_sub_field('title'); ?></h2>
        <?php } ?> 
        <?php $cols = cols('columns', 'col-sm-6 col-md-4'); ?>
        <?php if( have_rows('numbers') ): $i = 1; ?>
        <div class="row">
            <?php while( have_rows('numbers') ): the_row(); ?>
            <div class="col-md-6 number d-flex" data-wow-delay="<?php echo $i / 3; ?>s"
                data-wow-duration="1.2s">
                <div class="inners float d-flex flex-column">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12 the-number">
                            <?php if( get_sub_field('not_a_number') ) { ?>
                            <h3><span class="counter no"><?php if( get_sub_field('number_prefix') ) { ?><span
                                        class="prefix"><?php the_sub_field('number_prefix'); ?></span><?php } ?><?php the_sub_field('number') ?></span><?php if( get_sub_field('number_suffix') ) { ?><span
                                    class="suffix"><?php the_sub_field('number_suffix'); ?></span><?php } ?></h3>
                            <?php } else { ?>
                            <h3><?php if( get_sub_field('number_prefix') ) { ?><span
                                    class="prefix"><?php the_sub_field('number_prefix'); ?></span><?php } ?><span
                                    class="counter"><?php the_sub_field('number') ?></span><?php if( get_sub_field('number_suffix') ) { ?><span
                                    class="suffix"><?php the_sub_field('number_suffix'); ?></span><?php } ?></h3>
                            <?php } ?>
                        </div>
                        <div class="col-12 text">
                            <p><?php the_sub_field('description'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endwhile; ?>
        </div>
        <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>




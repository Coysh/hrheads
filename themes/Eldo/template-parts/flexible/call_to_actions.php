<div class="inner-section ctas">
    <div class="container">
        <?php $cols = cols('columns', 'col-sm-12 col-md-6 col-lg-4'); ?>
        <div class="row justify-content-center">
            <?php if( get_sub_field('intro_text') ) { ?>
            <div class="cta <?php echo $cols; ?> d-flex anim fadeIn intro">
                <div class="inner float d-flex flex-column justify-content-center">
                    <?php the_sub_field('intro_text'); ?>
                </div>
            </div>
            <?php } ?>

            <?php if( have_rows('cta') ): $i = 1; while ( have_rows('cta') ) : the_row(); ?>
            <?php $icon_type = get_sub_field('icon_type') ?: 'image'; ?>


            <div class="cta <?php echo $cols; ?> d-flex anim fadeIn" data-wow-delay="<?php echo $i / 6; ?>s" data-wow-duration="2s">
                <div class="inner anim fadeInUp float d-flex flex-column">
                    <div class="float">
                        <?php if ($icon_type == 'image' && get_sub_field('icon')) { ?>
                        <div class="cta-image float">
                            <?php echo wp_get_attachment_image( get_sub_field('icon'), 'small-phone' ); ?>
                        </div>
                        <?php } elseif ($icon_type == 'fa' && get_sub_field('fontawesome_icon')) { ?>
                        <div class="cta-icon float">
                            <?php the_sub_field('fontawesome_icon'); ?>
                        </div>
                        <?php } ?>

                        <div class="float">
                            <h3 class="cta-title"><?php the_sub_field('title'); ?></h3>
                            <div class="clear">
                                <p><?php the_sub_field('text'); ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="float bottom">
                        <?php $link = get_sub_field('link'); if( $link ): ?>
                        <a class="button secondary" href="<?php echo $link['url']; ?>"
                            <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"
                            <?php } ?>><?php echo $link['title'] ?: 'Read More'; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
          <?php $i++; endwhile; endif; ?>
        </div>
    </div>
</div>
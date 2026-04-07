<?php $override = get_sub_field('override_general_content') ?: false; ?>


<div class="inner-section calltoaction">
  <div class="container">
    <div class="row justify-content-between align-items-center">
    <div class="col cta-logo anim fadeInLeft" data-wow-duration="2s">
      <?php echo wp_get_attachment_image_no_srcset( get_field('logo', 'options'), 'medium' ); ?>
      </div>
      <div class="col-md-8 text">
        <div class="inner float">


        <?php if ($override && get_sub_field('layout_title')) { ?>
          <h2 class="lt heading"><?php the_sub_field('layout_title'); ?></h2>
        <?php } elseif (get_field('generic_cta_title', 'options')) { ?>
          <h2 class="lt heading"><?php the_field('generic_cta_title', 'options'); ?></h2>
        <?php } ?>

        <?php if( $override && get_sub_field('text') ) { ?>
          <?php the_sub_field('text'); ?>
        <?php } elseif (get_field('generic_cta_text', 'options')) { ?>
          <?php the_field('generic_cta_text', 'options'); ?>
        <?php } ?>

        <?php

if ($override) {
  $link = get_sub_field('link') ?: get_field('generic_cta_link', 'options');
} else {
  $link = get_field('generic_cta_link', 'options');
}

if( $link ): ?>

  <a class="button" href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title'] ?: 'Read More'; ?></a>

<?php endif; ?>
      </div>
      </div>
     
    </div>
  </div>
</div>

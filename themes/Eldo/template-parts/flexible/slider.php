<div class="inner-section slider-wrap is-dark">
<?php
$count = count( get_sub_field( 'slides' ) );

if ($count == 1) {
  $class = 'slider has-one anim fadeIn';
} else {
  $class = 'slider anim fadeIn';
}
?>
<?php
if( have_rows('slides') ): $i = 1; ?>
<div class="<?php echo $class; ?>">
    <?php while ( have_rows('slides') ) : the_row(); ?>
    <?php
      $image_array = wp_get_attachment_image_src(get_sub_field('image'), 'full');
      $image_url = $image_array[0];
    ?>
      <div class="slide vc cover" data-flickity-bg-lazyload="<?php echo $image_url; ?>">
          <div class="container">
            <div class="row">
              <div class="col text">
              <?php if( get_sub_field('slide_title') ): ?>
              <h2><?php the_sub_field('slide_title'); ?></h2>
            <?php endif; ?>
            <?php if( get_sub_field('text') ): ?>
             <p><?php the_sub_field('text'); ?></p>
            <?php endif; ?>

            <?php $link = get_sub_field('link'); if( $link ): ?>
              <a class="button " href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title'] ?: 'Read More'; ?></a>
            <?php endif; ?>
              </div>
            </div>
          </div>
      </div>
    <?php $i++; endwhile; ?>
</div>
  <?php else :
  // no rows found
  endif;
  ?>
</div>

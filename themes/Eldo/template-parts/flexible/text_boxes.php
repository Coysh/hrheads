<?php
if (get_sub_field('vertical_align')) { $align_center = true;
} else {  $align_center = false; }
?>

<div class="inner-section text-box">
  <div class="container">
    <?php $cols = cols('columns', 'col-12'); ?>
    <?php if( have_rows('text_box') ):  ?>
        <div class="row<?php if($align_center) { ?> align-items-center<?php } ?> justify-content-center">
      <?php while( have_rows('text_box') ): the_row(); ?>
      <?php $highlight = get_sub_field('highlight'); ?>
        <div class="<?php echo $cols; ?><?php if($highlight) { ?> d-flex box-wrap<?php } ?>">
          <?php if($highlight) { ?>
            <div class="hb">
          <?php } ?>
            <?php the_sub_field('text');?>
          <?php if($highlight) { ?>
            </div>
          <?php } ?>
        </div>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>
  </div>
</div>

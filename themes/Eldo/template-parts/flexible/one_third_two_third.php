<?php
if (get_sub_field('vertical_align')) { $align_center = true;
} else {  $align_center = false; }
?>
<div class="inner-section one-third-two-third">
  <div class="container">
    <div class="row<?php if($align_center) { ?> align-items-center<?php } ?>">
      <?php
      $classes = 'co col-12 col-lg-4';
      if (get_sub_field('reverse')) {
        $classes = 'co col-12 col-lg-8';
      }
      ?>
      <div class="<?php echo $classes; ?>">
        <?php the_sub_field('text'); ?>
      </div>
      <div class="col co">
        <?php the_sub_field('text_2'); ?>
      </div>
    </div>
  </div>
</div>

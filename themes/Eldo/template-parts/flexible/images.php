<?php
if (get_sub_field('vertical_align')) { $align_center = true;
} else {  $align_center = false; }
?>

<div class="inner-section images-layout">
  <div class="container">
    <?php $cols = cols('columns', 'col-12'); ?>
  
    <?php 

      if( get_sub_field('columns') == 'One' ) { ?>
          <?php if (get_sub_field('no_crop')) {
            $imageSize = 'full';
          } else {
            $imageSize = 'large-cropped';
          }
          ?>
      <?php } else { ?>
        <?php if (get_sub_field('no_crop')) {
          $imageSize = 'large';
        } else {
          $imageSize = 'large-cropped';
        }
        ?>
      <?php } ?>

        
     <?php if( have_rows('images') ):  ?>
        <div class="row narrow<?php if($align_center) { ?> align-items-center<?php } ?>">
          <?php while( have_rows('images') ): the_row(); ?>
            <div class="<?php echo $cols; ?>">
              <?php echo wp_get_attachment_image( get_sub_field('image'), ''.$imageSize.'' ); ?>
            </div>
          <?php endwhile; ?>
        </div>
    <?php endif; ?>
  </div>
</div>

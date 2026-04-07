<?php $full_width = get_sub_field('full_width') ?: false; ?>

<?php if ($full_width) { ?>
<div class="inner-section image-right full-width">
  <div class="container-fluid np">
    <div class="row no-gutters">
      <div class="col-lg-6 order-2 order-lg-1 col-xl-6 text d-flex flex-column justify-content-center align-items-end">
        <div class="inner float">
          <?php the_sub_field('text'); ?>
        </div>
      </div>
      <div class="col-lg-6 col-xl-6 order-1 order-lg-2 image-wrap anim fadeInRight">
        <?php if (get_sub_field('no_crop')) {
          $imageSize = 'large';
        } else {
          $imageSize = 'large-cropped';
        }
        ?>
        <?php echo wp_get_attachment_image( get_sub_field('image'), ''.$imageSize.'' ); ?>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <div class="inner-section image-right">
    <div class="container">
      <div class="row align-items-center">
        <div class="co col-lg-6 col-xl-6 order-2 order-lg-1 text">
	        <div class="inner">
	          <?php the_sub_field('text'); ?>
	        </div>
        </div>
        <div class="co col-lg-6 col-xl-6 order-1 order-lg-2 image-wrap">
          <?php if (get_sub_field('no_crop')) {
            $imageSize = 'medium';
          } else {
            $imageSize = 'medium-cropped';
          }
          ?>
          <?php echo wp_get_attachment_image( get_sub_field('image'), ''.$imageSize.'' ); ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

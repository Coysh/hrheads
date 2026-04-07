<?php $banner = get_field('banner'); ?>





<a class="inner float d-flex flex-column is-dark"  href="<?php the_permalink(); ?>">
  <div class="thumb-wrap">

      <?php 
      if (get_field('page_thumbnail')) {
        echo wp_get_attachment_image( get_field('page_thumbnail'), 'large' );
      } elseif (has_post_thumbnail()) { ?>
        <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'large' ); ?>
      <?php } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="" alt="<?php the_title(); ?>">
      <?php } ?>

      <div class="content float">
        <div class="text float">
        <h3><?php the_title(); ?></h3>
        

        <?php if ($banner['introduction']) { ?>
<p><?php echo $banner['introduction']; ?></p>
<?php } ?>
      </div>
      
    </div>

  </div>
</a>
 
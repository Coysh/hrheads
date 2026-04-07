<div class="inner float"  href="<?php the_permalink(); ?>">
  <div class="row narrow align-items-center">
    <div class="col-auto thumb-wrap">
      <a href="<?php the_permalink();?>">
      <?php 
      if (get_field('page_thumbnail')) {
        echo wp_get_attachment_image( get_field('page_thumbnail'), 'large-thumbnail' );
      } elseif (has_post_thumbnail()) { ?>
       <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'large-thumbnail' ); ?>
      <?php } else { ?>
      <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder-square.jpg" class="" alt="<?php the_title(); ?>">
      <?php } ?>
      </a>
    </div>
    <div class="col text">
      <div class="content float">
        <div class="text float">
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </div> 
      </div>
    </div>
  </div>
</div>
 
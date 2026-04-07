<article id="post-<?php the_ID(); ?>" <?php post_class('float d-flex flex-column excerpt event'); ?> >
	<div class="excerpt-thumb float clear">
		<a href="<?php the_permalink();?>">
			<?php if ( has_post_thumbnail(get_the_ID()) ) { ?>
 		 	<?php
 		 if (is_home() && 'isotope' === get_field('blog_style', 'options')) {
 			 the_post_thumbnail('small');
 		 } else {
			  echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium-cropped' );
 		 }
 		 ?>
 	 <?php } else { ?>
 		 <img width="800" height="600" src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php bloginfo( 'name' ); ?>">
 	 <?php }?>
	 	</a>
	</div>

  <div class="inner float">
    <header class="excerpt-header float clear">

	<?php if( get_field('location') ) { ?>
		<span class="location"><i class="fa-light fa-location-dot"></i> <?php the_field('location'); ?></span>
		<?php } ?>

      <h3 class="event-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

	  <span class="date">
		<?php if( get_field('start_date') && get_field('end_date') ) { ?>
			<?php if (get_field('start_date') == get_field('end_date')) { ?>
				<?php the_field('start_date'); ?>
			<?php } else { ?>
			<?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
			<?php } ?>
		<?php } ?>
	</span>
      <div class="meta float">
		
        
      </div>
    </header>
	 
    <div class="excerpt-content float">
			<?php echo mb_strimwidth(get_field('description'), 0, 140, "..."); ?>
    </div>

  </div>
	<footer class="excerpt-footer float bottom">
		<a class="button secondary" href="<?php the_permalink();?>">Event Details <i class="fa-regular fa-arrow-right"></i></a>
	</footer>

</article>

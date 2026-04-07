<article id="post-<?php the_ID(); ?>" <?php post_class('float d-flex flex-column excerpt standard'); ?> >
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
	<span class="date"><?php the_time('d/m/y')?></span>
      <h3 class="excerpt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

	  <div class="categories float"><?php the_category(); ?></div>
      <div class="meta float d-none">
    

<!--
				<?php if(has_tag()) { ?><span class="tags"><?php the_tags( '<i class="fas fa-tags"></i> ', ', ' ); ?><br></span><?php } ?>
				<span class="comments"><a href="<?php comments_link(); ?>"><i class="fas fa-comments"></i> <?php comments_number( 'No comments', 'One Comment', '% Comments' ); ?></a></span>
-->
      </div>
    </header>
	
    <div class="excerpt-content float">
			<?php echo mb_strimwidth(get_the_excerpt(), 0, 140, "..."); ?>
    </div>

  </div>
	<footer class="excerpt-footer float bottom">
		<a class="button secondary" href="<?php the_permalink();?>">Read More</a>
	</footer>

</article>

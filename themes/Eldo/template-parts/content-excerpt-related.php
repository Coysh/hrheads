<article id="post-<?php the_ID(); ?>" <?php post_class('float d-flex flex-column excerpt-related'); ?> >
	<a href="<?php the_permalink(); ?>">
	<div class="row align-items-center">
		<div class="col image">
			<div class="excerpt-thumb float clear">
				<?php if ( has_post_thumbnail(get_the_ID()) ) { ?>
		 		 	<?php
		 		 if (is_home() && 'isotope' === get_field('blog_style', 'options')) {
		 			 the_post_thumbnail('small');
		 		 } else {
					  echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium-cropped' );
		 		 }
		 		 ?>
		 	 <?php } else { ?>
		 		 <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php bloginfo( 'name' ); ?>">
		 	 <?php }?>
			</div>
		</div>
		<div class="col text">
			<div class="float">
				<header class="excerpt-header float clear">
					<h3 class="excerpt-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<div class="meta float clear">
						<span class="date"><?php the_time('d/m/y'); ?></span>
					</div>
				</header>
			</div>
		</div>
	</div>
</a>
</article>

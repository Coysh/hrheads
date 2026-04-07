<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package New
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('float clear'); ?>>
	 
	


	<div class="single-content float clear">
		<div class="row">
		<div class="col-lg-3 side">
			<div class="inner float">

				<h4 class="categories">Date</h4>
				<p class="date"><?php the_time('F jS, Y')?></p>
			
				<h4 class="categories">Category</h4>
				<p class="categories-list"><?php the_category( ', ' ); ?></p>


				<?php if ( get_the_author_meta('description_') ) { ?>
					<div id="written-by" class="float clear">
						<?php echo get_avatar( get_the_author_meta('user_email'), '150', '' ); ?>
						<h4>Written by <?php the_author(); ?></h4>
						
						<h5>
						<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
								<a href="<?php the_author_meta('linkedin' );?>" target="_blank"><i class="fab fa-linkedin"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
								<a href="<?php the_author_meta('pinterest' );?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'googleplus' ) ) : ?>
								<a href="<?php the_author_meta('googleplus' );?>" target="_blank"><i class="fab fa-google-plus"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
								<a href="<?php the_author_meta('instagram' );?>" target="_blank"><i class="fab fa-instagram"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
								<a href="http://twitter.com/<?php the_author_meta('twitter' );?>" target="_blank"><i class="fab fa-twitter"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
								<a href="<?php the_author_meta('facebook' );?>" target="_blank"><i class="fab fa-facebook"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'vimeo' ) ) : ?>
								<a href="<?php the_author_meta('vimeo' );?>" target="_blank"><i class="fab fa-vimeo"></i></a>
							<?php endif; ?>
							<?php if ( get_the_author_meta( 'user_url' ) ) : ?>
								<a href="<?php the_author_meta('user_url' );?>" target="_blank"><i class="fa fa-laptop"></i></a>
							<?php endif; ?>
						</h5>

						<?php the_author_meta('description'); ?>
				</div>
				<?php } else { ?>
					<!-- <h4 class="author">Written by</h4>
					<p><?php the_author(); ?></p> -->
				<?php } ?>

				<?php if(has_tag()) { ?>
					<!-- <h4 class="tags">Tags</h4>
					<span class="tags"><?php the_tags( '<i class="fas fa-tags"></i> ', ', ' ); ?></span> -->
				<?php } ?>

				<span class="comments d-none"><a href="<?php comments_link(); ?>"><i class="fas fa-comments"></i> <?php comments_number( 'No comments', 'One Comment', '% Comments' ); ?></a></span>
			</div>			
		</div>

			<div class="col post-wrap">
			<?php if (has_post_thumbnail() && !get_field('show_banner', 'options')) { ?>
				<div class="single-thumb float clear">
				<?php the_post_thumbnail('large-cropped');?>
			</div>
			<?php } ?>

				<?php the_content();?>
			</div>
		</div>
		
	</div>
</article>

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

				<h4 class="categories">Date(s)</h4>
				<p class="date">
				<?php if( get_field('start_date') && get_field('end_date') ) { ?>
						<?php if (get_field('start_date') == get_field('end_date')) { ?>
							<?php the_field('start_date'); ?>
						<?php } else { ?>
						<?php the_field('start_date'); ?> - <?php the_field('end_date'); ?>
						<?php } ?>
					<?php } ?>
				</p>
							
				<?php if( get_field('location') ) { ?>
				<h4 class="location">Location</h4>
				<p class="categories-list"><?php the_field( 'location' ); ?></p>
				<?php } ?>

 
 

			</div>			
		</div>

			<div class="col post-wrap">
			<?php if (get_field('photo')) { ?>
				<div class="single-thumb float clear">
				<?php echo wp_get_attachment_image( get_field('photo'), 'large' ); ?>
			</div>
			<?php } ?>
				<?php if( get_field('description') ) { ?>
				<?php the_field('description'); ?>
				<?php } else { ?>
					<h3>Event details coming soon</h3>
				<?php } ?>


				<?php
				$link = get_field('button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		
	</div>
</article>

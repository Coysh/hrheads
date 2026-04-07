<div class="t-slide float d-flex">
	<div class="inner float d-flex flex-column">
		<div class="float">
			<p><i class="fa fa-quote-left"></i> <?php the_field('testimonial'); ?> <i class="fa fa-quote-right"></i></p>
		</div>
		<div class="float bottom">
			<div class="row narrow align-items-center">
			<?php if( get_field('image') ) { ?>
			<div class="col-auto">
				<?php echo wp_get_attachment_image( get_field('image'), 'thumbnail', false, array( 'loading' => false ) );?>
			</div>
			<?php } ?>
			<?php if( get_field('name') || get_field('company') ): ?>
				<div class="col author">
					<?php if( get_field('name') ) { ?>
						<?php the_field('name'); ?>
					<?php } ?>
					<?php if( get_field('name') ) { ?>
					<br>
					<span class="company">
						<?php the_field('company'); ?>
					</span>
					<?php } ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
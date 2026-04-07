<article id="post-<?php the_ID(); ?>" <?php post_class('float search-result'); ?> >
	<div class="container np">
		<div class="row no-gutters align-items-center">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="image-wrap col">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnail');?>
					</a>
				</div>
			<?php } ?>
			<div class="col text">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php if ('post' === get_post_type()) { ?>
					<?php echo mb_strimwidth(get_the_excerpt(), 0, 140, "..."); ?>
				<?php } else { ?>
					<?php $yoast = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>

					<?php if ($yoast) { ?>
						<p><?php echo $yoast; ?></p>
					<?php }  ?>
				<?php } ?>
			</div>
		</div>
	</div>

</article>

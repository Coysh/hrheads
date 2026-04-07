<?php
/*
	The Page Sidebar
*/

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	// return;
}
?>

<aside id="sidebar" class="widget-area col d-lg-flex page-sidebar">
	<div class="inner float">


		<?php dynamic_sidebar( 'sidebar-2' ); ?>

		<?php
		global $post;
		if ($post->post_parent)	{
				$ancestors=get_post_ancestors($post->ID);
				$root=count($ancestors)-1;
				$parent = $ancestors[$root];
			//	echo $parent;
			} else {
				$parent = $post->ID;
			}
		?>

		<?php $parent = wp_get_post_parent_id( get_the_id() ); if ($parent != 0) { ?>

			<?php
				$currentId = get_the_ID();
				$args = array(
					'post_type'              => array( 'page' ),
					'posts_per_page'         => '-1',
					'post_status' 					 => 'publish',
					'post_parent'            => wp_get_post_parent_id(get_the_ID()),
					'order'                  => 'ASC',
					'orderby'                => 'menu_order',
				);

				// The Query
				$query = new WP_Query( $args );

				// The Loop
				if ( $query->have_posts()) {  $i = 1; ?>
					<section class="sibling-pages np">

								<ul class="pages">
									<div class="float parent-page">
										<a href="<?php echo get_the_permalink(wp_get_post_parent_id(get_the_id())); ?>"><i class="fas fa-chevron-left"></i> <?php echo get_the_title(wp_get_post_parent_id(get_the_ID())); ?></a>
									</div>
								<?php while ( $query->have_posts() ) { $query->the_post(); ?>
								<li class="page<?php if ($currentId == get_the_ID()) {echo " current";} ?>">

									<?php $children = get_pages( array( 'child_of' => get_the_ID() ) ); ?>

									<?php if ($children) { ?>
										<a class="parent" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<ul class="child-pages">
											<?php
									    wp_list_pages( array(
									        'child_of'    => get_the_ID(),
													'title_li' => false,
									    ) );
									    ?>
										</ul>
									<?php } else { ?>

									<a class="parent" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
								</li>
								<?php $i++;  }  ?>

							</ul>

						<?php } ?>
				</section>
				<?php wp_reset_postdata(); ?>


		<?php } else { ?>
			<div class="float">
				<div class="container no-block">
				<h3>No parent or child pages to display</h3>
				</div>
            </div>
		<?php } ?>


	</div>
</aside>

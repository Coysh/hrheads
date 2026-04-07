<?php
/*
 * The template for displaying the footer
*/
?> 

	<?php include( get_template_directory() . '/inc/footer-logos.php'); ?>  
  
	<footer id="footer" class="is-dark">
		<div class="container">
			
		  <div class="row justify-content-between">
			

		    <div class="co col-12 col-md-auto fm">
				<p class="foot-title"><?php echo wp_get_nav_menu_name('menu-2'); ?></p>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-2',
						'menu_class'        => 'footer-menu fa-ul',
						'container' => false,
					) );
				?>
		    </div>
		    <div class="co col-12 col-md-auto fm">
				<p class="foot-title"><?php echo wp_get_nav_menu_name('menu-3'); ?></p>
				<?php
					wp_nav_menu( array( 
						'theme_location' => 'menu-3',
						'menu_class'        => 'footer-menu fa-ul',
						'container' => false,
					) );
				?>
		    </div>



				<div class="co col-12 col-md-auto">
				  <p class="foot-title">Get In Touch</p>
					<?php if( get_field('phone', 'options') ): ?>
						<p><a href="tel:<?php remove_whitespace(get_field('phone', 'options')); ?>"><i class="fa-solid fa-phone"></i> <?php the_field('phone', 'options'); ?></a></p>
					<?php endif; ?>
					<?php if( get_field('email', 'options') ): ?>
						<p><a href="mailto:<?php the_field('email', 'options'); ?>"><i class="fa-solid fa-envelope"></i> <?php the_field('email', 'options'); ?></a></p>
					<?php endif; ?>
					<?php include( get_template_directory() . '/inc/social-links.php'); ?>
				</div>
				<?php if( get_field('footer_title', 'option') ): ?>
					<div class="co col extra-column">
						<p class="foot-title"><?php the_field('footer_title', 'option'); ?></p>
						<?php if( get_field('footer_text', 'option') ): ?>
						  <p><?php the_field('footer_text', 'option'); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if( get_field('alternative_logo', 'options') ) { ?>
					<div class="co col-12 col-md-auto logo">
						<div class="float">
						<?php echo wp_get_attachment_image_no_srcset( get_field('alternative_logo', 'options'), 'small' ); ?>
						</div>
						

						<?php if( get_field('footer_text', 'options') ) { ?>
							<div class="float">
								<p class="footer-text"><?php the_field('footer_text', 'options'); ?></p>
							</div>
							
						<?php } ?>
					</div>
				<?php } ?>
		  </div>


		</div>

		<div id="copyright" class="is-dark">
		<div class="container">
			<div class="inner float">
				<div class="row wide justify-content-between align-items-center">
					<div class="col fm-legal">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-4',
							'menu_class'        => 'legal-menu',
							'container' => false,
						) );
						?>

						
					</div>

					<div class="col-auto credit">


					<p>
					&copy; <?php bloginfo( 'name' ); ?> <?php echo date("Y"); ?>.
							<?php if ( get_field('white_label', 'options') && get_field('white_label_company', 'options') && get_field('white_label_website', 'options') ) { ?>
								<?php if( get_field('white_label_text', 'options') ) { ?><?php the_field('white_label_text', 'options') . ' '; ?><?php } ?>
								<a target="_blank" href="<?php the_field('white_label_website', 'options'); ?>">
									<?php the_field('white_label_company', 'options'); ?>
								</a>
							<?php } else { ?>
								<span class="website-by">Website by <a class="text-link" target="_blank" href="https://www.eldo.co.uk/welcome?site=<?php bloginfo( 'name' ); ?>">Eldo&trade;</a>.</span>
							<?php } ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</footer>



	<div class="fab-container">
	<div class="to-top"></div>
</div>

<?php if (is_dev_user() && is_dev_mode()) { include( get_template_directory() . '/inc/dev-page-loop.php'); } ?>

<?php if( get_field('footer_code', 'options') ) { echo '<!-- Start Footer Code -->' . get_field('footer_code', 'options') . '<!-- End Footer Code -->';} ?>

<?php wp_footer(); ?>


</body>
</html>

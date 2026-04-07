

<?php if( !post_password_required()) { ?>

  <?php if( '' !== get_post()->post_content ) { ?>
  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col">
  					<?php the_content();?>
  				</div>
  			</div>
  		</div>
  	</section>
  <?php } ?>


    <?php if( have_rows('section') ) { ?>
      <div id="page-sections">
      <?php while( have_rows('section') ): the_row(); ?>
      <?php $settings = get_sub_field('bg_settings'); ?>
      <?php if ($settings['hide_from_visitors'] && !is_user_logged_in()) { ?>
        <?php } else { ?>
        <section class="page-section<?php classes(); ?>" <?php sectionId(); ?> <?php bgImage(); ?>>
          <?php if ($settings['two_columns']) { ?>
            <div class="container two-cols clear">
              <div class="two-cols-row<?php if ($settings['vertically_align']) { ?> align-items-center<?php } ?><?php if ($settings['horizontal_layout_gap']) { echo ' ' . $settings['horizontal_layout_gap']; } ?>">
              <?php } ?>
                <?php if( have_rows('flexible_content') ): ?>
                  <?php while ( have_rows('flexible_content') ) : the_row(); ?>
                    <?php get_template_part( 'template-parts/flexible/'. get_row_layout() ); ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php if ($settings['two_columns']) { ?>
              </div>
            </div>
          <?php } ?>
        </section>
        <?php } ?>
      <?php endwhile; ?>
      </div>
    <?php } else { ?>
        <section class="no-content tc">
        <div class="container no-block">
                        <h2 class="st line-after">Empty page</h2>
                        <br>
                          <p class="bigger">Nothing to see here, yet!</p>
                      </div>
                    </div>
        </section>
      <?php } ?>

<?php } else { ?>
<div class="section" id="password-protected">
  <div class="container">
    <?php echo get_the_password_form(); ?>
  </div>
</div>
<?php  }  ?>

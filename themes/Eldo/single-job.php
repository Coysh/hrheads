<?php
/**
 * The template for displaying all single jobs
 *
 * @package HRHeads
 * @since HRHeads 1.0.0
 */
?>


<?php get_header(); ?>


	<?php include( get_template_directory() . '/inc/banner.php'); ?>

	<section id="job-post" role="main" class="geo-bottom-left">
		<div class="container">

		<?php do_action( 'hrheads_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class('single__article float') ?> id="post-<?php the_ID(); ?>">
			 
				<?php do_action( 'hrheads_post_before_entry_content' ); ?>
				<div class="entry-content">
					
					<div class="row">
						<div class="col job-content">

						<div class="row">
						<div class="job__details col-sm-7">
							<!-- <h2>Job Details</h2> -->
                            <?php
                            $job_meta = hrheads_get_job_meta( get_the_ID() );
                            $salary = ( get_field('custom_salary_display') ) ? get_field('custom_salary_display') : $job_meta['salary_scale'];

                            ?>

 
							<dl class="details-list row">
								<?php if ( $job_meta['location'] ) printf('<dt class="details-list--term"><i class="fa fa-map-marker" aria-hidden="true"></i> Location:</dt><dd class="details-list--def">%s</dd>', $job_meta['location']) ?>
								<dt class="details-list--term"><i class="fa fa-calendar" aria-hidden="true"></i> Added:</dt>
								<dd class="details-list--def"><?php the_date(); ?></dd>
								<?php if ( $salary )  printf('<dt class="details-list--term"><i class="fa fa-gbp" aria-hidden="true"></i> Salary:</dt><dd class="details-list--def">%s</dd>', $salary) ?>
								<?php if ( $job_meta['level'] )  printf('<dt class="details-list--term"><i class="fa fa-users" aria-hidden="true"></i> Level:</dt><dd class="details-list--def">%s</dd>', $job_meta['level']) ?>
								<?php if ( $job_meta['contract'] )  printf('<dt class="details-list--term"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Contract:</dt><dd class="details-list--def">%s</dd>', $job_meta['contract']) ?>
							</dl>


					

						


						</div>


						<div class="job__role col-md-5 column">
                            <div class="job__role-wrapper">
								<p class="pre-heading managed-by">This role is managed by:</p>
                                <h3><?php echo get_the_author() ?></h3>
	                            <?php
	                            $author_ID = 'user_' . get_the_author_meta( 'ID' );
	                            $user_display_email = get_field('user_display_email', $author_ID);
	                            $user_contact_number = get_field('user_contact_number', $author_ID);
	                            $user_linkedin_url = get_field('user_linkedin_url', $author_ID);
	                            ?>
                                <ul class="contact-list">
		                            <?php if ($user_display_email) printf('<li><a href="mailto:%1$s"><i class="fas fa-envelope" aria-hidden="true"></i> %1$s</a></li>',$user_display_email); ?>
		                            <?php if ($user_contact_number) printf('<li><a href="tel:%1$s"><i class="fas fa-phone" aria-hidden="true"></i> %1$s</a></li>',$user_contact_number); ?>
		                            <?php if ($user_linkedin_url) printf('<li><a href="%s"><i class="fa fa-linkedin" aria-hidden="true"></i> LinkedIn</a></li>',$user_linkedin_url); ?>
                                </ul>
	                            <?php the_field('blue_box') ?>


							
                            </div>
						</div>


						</div>

						<div class="row">
					<div class="col content">
					<button class="button-primary button--apply js-form-button">APPLY NOW</button>
                    <p class="call-text d-none"><?php the_field('call_text') ?></p>
                    <div id="apply-form" class="js-form-target row column large-collapse">
                        <?php //gravity_form(1, false, false, false, '', true, 100); ?>
    					<iframe src="<?php print get_field('apply_url') ?>" width="600" height="1200" style="width:100%;border:0;"></iframe>                        
                    </div>
						<?php the_content(); ?>
						</div>



						
					</div>

						</div>
					


					

						<?php get_sidebar(); ?>
				
					</div>

					



				

				</div>
             
            </article>
		<?php endwhile;?>

		<?php do_action( 'hrheads_after_content' ); ?>


 

	 
    
        </div>
	</section>
<?php get_footer();

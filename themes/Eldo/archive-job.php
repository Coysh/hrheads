<?php
/**
 * The template for displaying job archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HRHeads
 * @since HRHeads 1.0.0
 */
$bk_image = get_field('jobs_bk_image','option');

// if( !empty($bk_image) ):


// 	$size = 'large';
// 	$src = $bk_image['sizes'][ $size ];

// 	$bk_image = sprintf(' style="background-image:url(%s);"',$src);

// endif;

get_header(); ?>


<div class="inner-section banner image-right full-width">
  <div class="container-fluid np">
    <div class="row no-gutters">
      <div class="col-lg-6 order-2 order-lg-1 col-xl-6 text d-flex flex-column justify-content-center align-items-end">
        <div class="inner float">
        <?php if ($pre_title) { ?>
                      <span class="pre-title"><?php echo $pre_title; ?></span>
                    <?php } ?>


        <h1 class="title"><?php the_field('jobs_title', 'option') ?></h1>

        <?php if( get_field('jobs_blurb', 'options') ) { ?>
            <p><?php the_field('jobs_blurb', 'option') ?></p>
        <?php } ?>
        

                    
        </div>
      </div>
      <div class="col-lg-6 col-xl-6 order-1 order-lg-2 image-wrap anim fadeInRight" data-wow-duration="2s">
        <?php if (get_sub_field('no_crop')) {
          $imageSize = 'large';
        } else {
          $imageSize = 'large-cropped';
        }
        ?>
        <?php echo wp_get_attachment_image( $bk_image, ''.$imageSize.'' ); ?>
      </div>
    </div>
  </div>
</div>

<section class="jobs geo-top-bottom">

    <div class="float content">
        <div class="container">

   
       
        <div class="row column header__instructions d-none">
		    <?php the_field('jobs_instruction', 'option') ?>
        </div>
        <div id="job-search" class="header__filters">
 
                <form name="jobs-filter" id="category-select" class="category-select js-category-select row align-items-center" action="<?php echo get_post_type_archive_link( 'jobs' ) ?>#job-search" method="get">
                    <?php
                    $field_names = hrheads_job_field_names();
                    foreach ( $field_names as $field_name ) {
                        $parent_of_field_name = sprintf('parent_of_%s_dropdown', $field_name );
                        $term_ID = get_field($parent_of_field_name, 'option', false);
                        printf('<div class="col column">%s</div>',hrheads_jobs_dropdown( $term_ID, 'js-jobs-filter select' ));
                    }
                    ?>
                    <div class="col-auto d-none">
                        <!-- <input class="js-jobs-submit" type="submit" name="job-submit" value="jobs" /> -->

                        <button class="js-jobs-submit button-primary" type="submit" name="job-submit" value="jobs">Filter</button>
                    </div>
                </form>
         
        </div>

    </div>
    </div>
    <?php if ( have_posts() ) : ?>
      <div role="main" class="jobs__main float" data-equalizer data-equalize-by-row="true" id="jobs__main">
        <div class="container">
            <div class="row">

           
        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $data_categories = hrheads_get_job_terms(get_the_ID(), ',', true); ?>
            <article id="job-<?php the_ID(); ?>" class="co col-md-4 job js-job column column-block" data-category="<?php echo $data_categories ?>">
                <div class="job--border">
                    <div class="job__main" data-equalizer-watch>
                    <?php get_template_part( 'template-parts/content', 'excerpt-job' ); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
      </div>
      </div>
      </div>

        <?php else : ?>
	        <div class="jobs__main float">
                <div class="container">
                    <?php get_template_part( 'template-parts/content', 'no-jobs' ); ?>
		        </div>
	        </div>
    <?php endif; // End have_posts() check. ?>
            <div class="float paginate-links">
                <div class="container">

        <?php /* Display navigation to next/previous pages when applicable */ ?>
        <?php
        if ( function_exists( 'hrheads_pagination' ) ) :
            hrheads_pagination();
        elseif ( is_paged() ) :
            ?>
            <nav id="post-nav">
                <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'hrheads' ) ); ?></div>
                <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'hrheads' ) ); ?></div>
            </nav>
        <?php endif; ?>
    </div>
    </div>
</section>
<?php if( get_field('job_archive_cta', 'options') ) { ?>
<section class="extra-light-blue-bg">
  <div class="container">
    <div class="row">
      <div class="col-12">
       
        <?php the_field('job_archive_cta', 'options'); ?>
       
      </div>
   </div>
  </div>
</section>
<?php } ?>

<?php get_footer();

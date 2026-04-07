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

if( !empty($bk_image) ):


	$size = 'large';
	$src = $bk_image['sizes'][ $size ];

	$bk_image = sprintf(' style="background-image:url(%s);"',$src);

endif;

get_header(); ?>
<div class="jobs">
    <header class="header">
        <div class="header--background"<?php echo $bk_image ?>>
            <div class="header__content">
                <div class="large-4 column">
                    <h1><?php the_field('jobs_title', 'option') ?></h1>
                </div>
                <div class="large-8 column">
                    <p><?php the_field('jobs_blurb', 'option') ?></p>
                </div>
            </div>
        </div>
        <div class="row column header__instructions">
		    <?php the_field('jobs_instruction', 'option') ?>
        </div>
        <div id="job-search" class="header__filters">
            <div class="row">
                <form name="jobs-filter" id="category-select" class="category-select js-category-select" action="<?php echo get_post_type_archive_link( 'jobs' ) ?>#job-search" method="get">
                    <?php
                    $field_names = hrheads_job_field_names();
                    foreach ( $field_names as $field_name ) {
                        $parent_of_field_name = sprintf('parent_of_%s_dropdown', $field_name );
                        $term_ID = get_field($parent_of_field_name, 'option', false);
                        printf('<div class="large-6 column">%s</div>',hrheads_jobs_dropdown( $term_ID, 'js-jobs-filter' ));
                    }
                    ?>
                    <div class="column">
                        <input class="js-jobs-submit" type="submit" name="job-submit" value="jobs" />
                    </div>
                </form>
            </div
        </div>

    </header>
    <?php if ( have_posts() ) : ?>
      <div role="main" class="jobs__main row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-by-row="true" id="jobs__main">

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php $data_categories = hrheads_get_job_terms(get_the_ID(), ',', true); ?>
            <article id="job-<?php the_ID(); ?>" class="job js-job column column-block" data-category="<?php echo $data_categories ?>">
                <div class="job--border">
                    <div class="job__main" data-equalizer-watch>
                    <?php get_template_part( 'template-parts/content', 'excerpt-job' ); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
      </div>

        <?php else : ?>
	        <div class="jobs__main row">
		        <div class="column">
              <?php get_template_part( 'template-parts/content', 'no-jobs' ); ?>
		        </div>
	        </div>

    <?php endif; // End have_posts() check. ?>
    <div class="row">
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

<?php get_footer();

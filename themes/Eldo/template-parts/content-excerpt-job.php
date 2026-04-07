<?php
/**
 * The default template for job content
 *
 * Used for both single and index/archive/search.
 *
 * @package HRHeads
 * @since HRHeads 1.0.0
 */

$job_meta = hrheads_get_job_meta( get_the_ID() );
$salary = ( get_field('custom_salary_display') ) ? get_field('custom_salary_display') : $job_meta['salary_scale'];

?>
<div class="inner float">
<header class="picks__job-header">
    <h3 class="picks__job-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <dl class="picks__job-list">
		<?php if ( $job_meta['location'] ) printf('<dt class="show-for-sr">Location</dt><dd class="picks__job-location"><i class="fa-solid fa-location-dot"></i> %s</dd>', $job_meta['location']) ?>
		<?php if ( $salary )  printf('<dt class="show-for-sr">Salary</dt><dd class="picks__job-salary">%s</dd>', $salary) ?>
    </dl>
</header>
<div class="picks__job-content">
	<?php the_field('stand_first'); ?>
</div>

</div>

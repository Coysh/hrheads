<div class="inner-section tabbed">
  <?php if( have_rows('tabs') ): ?>
    <div class="container">
      <ul class="tabs">
        <?php $o = 1; while( have_rows('tabs') ): the_row(); ?>
          <li class="tab-link <?php if ($o == 1) { echo "current"; } ?>" data-tab="tab-<?php echo shorten(get_sub_field('title')); ?>"> <?php the_sub_field('title'); ?></li>
        <?php $o++; endwhile; ?>
      </ul>

      <?php $i = 1; while( have_rows('tabs') ): the_row(); ?>
        <div id="tab-<?php echo shorten(get_sub_field('title')); ?>" class="tab-content <?php if ($i == 1) { echo "current"; } ?>">
          <h3 class="tab-title"><?php the_sub_field('title'); ?></h3>
          <?php the_sub_field('text'); ?>
        </div>
        <?php $i++; endwhile; ?>
      <?php endif; ?>
    </div>
</div>

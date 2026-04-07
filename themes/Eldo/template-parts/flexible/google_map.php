<div class="inner-section np map">

  <?php if( get_sub_field('section_description') ): ?>
    <div class="container">
      <?php the_sub_field('section_description'); ?>
    </div>
  <?php endif; ?>
  <?php echo get_sub_field('embed_code'); ?>
</div>

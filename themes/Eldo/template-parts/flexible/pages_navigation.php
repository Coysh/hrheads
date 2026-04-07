
<div class="inner-section pages-nav">
  <div class="container clear">
    <div class="row">
      <?php get_sidebar('page'); ?>
      <div class="col text">
        <div class="inner float">
        <?php if( get_sub_field('section_title') ): ?>
          <h2 class="section-title"><?php the_sub_field('section_title'); ?></h2>
        <?php endif; ?>


      <?php if( get_sub_field('text') ) { ?>
       <?php the_sub_field('text'); ?>
      <?php } ?> 
      </div>
      </div>
    </div>
  </div>
</div>

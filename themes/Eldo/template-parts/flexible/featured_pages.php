<div class="inner-section featured-pages">
  <div class="container">
      <?php
      $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-4');
      $posts = get_sub_field('pages');
      if( $posts ): $i = 1; ?>
             <div class="row justify-content-center">
               <?php foreach( $posts as $post): ?>
                 <?php setup_postdata($post); ?>
                 <div class="<?php echo $cols; ?> excerpt-page d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
                   <?php get_template_part( 'template-parts/content-excerpt-page' ); ?>
                 </div>
               <?php $i++; endforeach; ?>
              </div>
         <?php wp_reset_postdata(); ?>
      <?php endif; ?>
  </div>
</div>

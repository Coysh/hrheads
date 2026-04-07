<div class="inner-section features">
  <div class="container">
    <div class="row">

    <?php if( get_sub_field('introduction') ): ?>
      <div class="col-md-4 intro">
        <?php the_sub_field('introduction'); ?>
      </div>
    	
    <?php endif; ?>
      
      <div class="col">
      <?php $cols = cols('columns', 'col-sm-6 col-md-4'); ?>
      <?php if( have_rows('features') ): $i = 1; ?>
        <div class="row">
          <?php while( have_rows('features') ): the_row(); ?>
          <div class="<?php echo $cols; ?> feature anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
            <div class="row no-gutters">
              <div class="col icon">
                <?php if( get_sub_field('icon') ) { ?>
                <?php the_sub_field('icon'); ?>
                <?php } else { ?>
                  <i class="fas fa-check-circle"></i>
                <?php } ?>
              </div>
              <div class="col text">
                <?php if( get_sub_field('feature') ) { ?>
                <h4><?php the_sub_field('feature'); ?></h4>
                <?php } ?>
                <?php if( get_sub_field('text') ) { ?>
                    <p><?php the_sub_field('text'); ?></p>
                <?php } ?>

              </div>
            </div>
          </div>
        <?php $i++; endwhile; ?>
      </div>
      <?php endif; ?>
      </div>
    </div>
  

   
  </div>
</div>

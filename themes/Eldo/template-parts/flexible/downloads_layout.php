<div class="inner-section downloads">
    <div class="container">
        <div class="row">
            <?php $cols = cols('columns', 'col-sm-6 col-md-6 col-lg-3'); ?>
              <?php if( have_rows('files') ): $i = 1; ?>
                <?php while( have_rows('files') ): the_row(); ?>
                  <?php

                  $file = get_sub_field('file');

                  if( $file ): ?>

                  <div class="<?php echo $cols; ?> download d-flex anim fadeIn" data-wow-delay="<?php echo $i / 8; ?>s">
                      <div class="box d-flex flex-column">
                          <?php if( get_sub_field('image') ): ?>
                          <div class="float">
                              <a class="image-link" target="_blank" href="<?php echo $file['url']; ?>">
                                  <?php echo wp_get_attachment_image( get_sub_field('image'), 'medium' ); ?>
                              </a>
                          </div>
                          <?php endif; ?>

                          <h4 class="download-title nmt"><?php echo $file['title']; ?></h4>
                          <div class="float bottom">
                              <a class="button-link" target="_blank" href="<?php echo $file['url']; ?>">Download</a>
                          </div>
                      </div>
                  </div>
                  <?php endif; ?>
                <?php $i++; endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
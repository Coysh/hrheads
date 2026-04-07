<div class="inner-section videos">
<div class="container">
  <div class="row justify-content-center">
    <?php $cols = cols('columns', 'col-12'); ?>
    <?php if( have_rows('videos') ): $i = 1; ?>
      <?php while( have_rows('videos') ): the_row(); ?>
        <?php
        if (get_sub_field('video_url')) { ?>
          <div class="<?php echo $cols; ?> video-container">
            <div class="embed-container">
              <?php
              // get iframe HTML
              $iframe = get_sub_field('video_url');
              // use preg_match to find iframe src
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              // add extra params to iframe src
              $params = array(
                  'controls'    => 1,
                  'rel'    => 0,
                  'hd'        => 1,
                  'autohide'    => 1,
                  'modestbranding' => 1,
                  'showinfo' => 0
              );
              $new_src = add_query_arg($params, $src);
              $iframe = str_replace($src, $new_src, $iframe);
              // echo $iframe
              echo $iframe;
              ?>
            </div>
          </div>
        <?php } else { ?>
          <div class="col co video-container d-flex align-items-center justify-content-center missing-video">
            Missing Video
          </div>
        <?php } ?>

      <?php $i++; endwhile; ?>
    <?php endif; ?>
  </div>
</div>
</div>

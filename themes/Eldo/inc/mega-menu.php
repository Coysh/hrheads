<?php if( have_rows('menu', 'options') ): $count = 0; ?>
  <?php while( have_rows('menu', 'options') ): the_row(); ?>
      <?php
        $sub_menu_title = get_sub_field('sub_menu_title');
        $sub_menu_description = get_sub_field('sub_menu_description');
        $show_description = get_sub_field('add_description');
        $cols = cols('columns', 'col-auto');

        $button = get_sub_field('sub_menu_link');
        $index = get_row_index();
       ?>
      <?php if( have_rows('second_level_menu') ): ?>
      <div class="sub" id="menu-<?php echo $index; ?>">
        <div class="container">
          <div class="row justify-content-start">
            <?php if ($sub_menu_title): ?>
              <div class="col-md-5 menu-description">
                <?php if ($sub_menu_title) { ?>
                  <h3 class="nmt line-after"><?php echo $sub_menu_title; ?></h3>
                <?php } ?>

                <?php if ($sub_menu_description): ?>
                  <?php echo $sub_menu_description; ?>
                <?php endif; ?>

                <?php if( $button ): ?>
                  <a class="button" href="<?php echo $button['url']; ?>" <?php if ($button['target']) { ?>target="<?php echo $button['target']; ?>"<?php } ?>><?php echo $button['title']; ?></a>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <div class="col">
              <div class="row">

              
            <?php while( have_rows('second_level_menu') ): the_row(); ?>
        
              <div class="<?php echo $cols; ?> menu-items-wrap">
                <?php if( get_sub_field('title') ) { ?>
                  <h4 class="nmt section-title"><?php the_sub_field('title'); ?></h4>
                <?php } else { ?>
                  <h4 class="nmt blank">&nbsp;</h4>
                <?php } ?>

                <?php if( have_rows('menu_items') ): ?>

                  <ul class="menu-items">
                  <?php while( have_rows('menu_items') ): the_row(); ?>
                    <li>
                    <?php

                      $link_type = get_sub_field('link_type') ?: 'Page Link';
                      $page = get_sub_field('page');

                      if ($link_type == 'Page Link') {
                        $linkURL = get_the_permalink($page);
                        $compare = get_the_ID($page);
                      } elseif ($link_type == 'Custom Link') {
                        $linkURL = get_sub_field('link', false, false);
                        $compare = url_to_postid($linkURL['url']);
                      }

                      $link = get_sub_field('link');
                      global $wp;
                      ?>

                      <?php if ($link_type == 'Custom Link') { ?>
                        <?php if( $link ): ?>
                          <a class="<?php if ($compare == get_the_ID() || home_url( $wp->request ) . '/' == $linkURL['url'] ) {echo "current-page";}?><?php if ($link['url'] == '#') {echo " disabled"; }; ?>" href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title']; ?></a>
                        <?php endif; ?>
                      <?php } elseif ($link_type == 'Page Link') { ?>
                        <?php if ($page): ?>
                          <a class="<?php if ($page == get_the_ID() || home_url($wp->request) . '/' == get_permalink($page) ) {echo "current-page";}?>" href="<?php echo get_the_permalink($page); ?>">
                            <?php echo get_the_title($page); ?>
                          </a>
                        <?php endif; ?>
                      <?php } ?>
                  </li>
                  <?php endwhile; ?>
                </ul>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
            </div>
            </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
    <?php  endwhile; ?>
<?php endif; ?>

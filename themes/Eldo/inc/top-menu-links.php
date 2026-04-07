<?php if (get_field('enable_mega_menu', 'options')) { ?>
  <?php $i = 1; ?>
  <ul class="mega sm-clean">
  <?php while( have_rows('menu', 'options') ): the_row(); ?>
    <li>
      <?php
      $link_type = get_sub_field('link_type') ?: 'Page Link';

      $link = get_sub_field('link');
      $page = get_sub_field('page');

      if ($link_type == 'Page Link') {
        $linkURL = get_the_permalink($page);
        $compare = get_the_ID($page);
      } elseif ($link_type == 'Custom Link') {
        $linkURL = get_sub_field('link', false, false);
        $compare = url_to_postid($linkURL['url']);
      }
      global $wp;
      ?>

      <?php if ($link_type == 'Custom Link') { ?>
        <?php if( $link ): ?>
          <a class="menu-item<?php if( have_rows('second_level_menu') ) { ?> has-sub<?php } else {echo " no-sub";}?><?php if ($compare == get_the_ID() || home_url( $wp->request ) . '/' == $linkURL['url'] ) {echo " current-page";}?>" data-menu-id="<?php echo $i; ?>" href="<?php echo $link['url']; ?>" <?php if ($link['target']) { ?>target="<?php echo $link['target']; ?>"<?php } ?>><?php echo $link['title']; ?></a>
        <?php endif; ?>
      <?php } elseif ($link_type == 'Page Link') { ?>
        <a class="menu-item<?php if( have_rows('second_level_menu') ) { ?> has-sub<?php } else {echo " no-sub";}?><?php if ($page == get_the_ID() || home_url($wp->request) . '/' == get_permalink($page) ) {echo " current-page";}?>" data-menu-id="<?php echo $i; ?>" href="<?php echo get_the_permalink($page); ?>">
          <?php echo get_the_title($page); ?>
        </a>
      <?php } ?>
  </li>
  <?php $i++; endwhile; ?>
</ul>
<?php } else { ?>
<?php
  wp_nav_menu( array(
    'theme_location' => 'menu-1',
    'menu_id'        => 'header-menu-desktop',
    'container' => false,
    'menu_class' => 'sm sm-clean nav-menu'
  ) );
?>
<?php } ?>

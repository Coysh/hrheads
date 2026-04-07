<header id="full" class="float">
  <div class="inner float">
    <div class="container clear">
      <div class="row justify-content-between align-items-center">
        <div class="col-auto logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php echo wp_get_attachment_image_no_srcset( get_field('logo', 'options'), 'small' ); ?>
          </a>
        </div>
        <div class="col">
          <div class="row align-items-center narrow justify-content-end">
            <div class="col-auto col-lg head-info">
            <?php if( get_field('phone', 'options') ): ?>
              <span class="header-link"><a href="tel:<?php remove_whitespace(get_field('phone', 'options')); ?>"><i class="fas fa-phone"></i> <?php the_field('phone', 'options'); ?></a></span>
            <?php endif; ?>
            <?php if( get_field('email', 'options') ): ?>
              <span class="header-link"><a href="mailto:<?php the_field('email', 'options'); ?>"><i class="fas fa-envelope"></i> <?php the_field('email', 'options'); ?></a></span>
            <?php endif; ?>
            <div id="menu-toggle" class="col-auto fixed">
            <div class="toggle-wrap">
                <div class="toggle one"></div>
                <div class="toggle two"></div>
                <div class="toggle three"></div>
              </div>
            </div>
          </div>

          <?php
          $link = get_field('header_button', 'options');
          if( $link ): 
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
              ?>
              <div class="col-auto header-button d-none d-md-block">
                <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
              </div>
          <?php endif; ?>

          </div>
        </div>

 
       
      </div>
    </div>
  </div>

  <nav id="menu" class="float d-none d-lg-block">
    <div class="container">
      <?php include( get_template_directory() . '/inc/top-menu-links.php'); ?>
    </div>

  </nav>
  <?php include( get_template_directory() . '/inc/mega-menu.php'); ?>
</header>

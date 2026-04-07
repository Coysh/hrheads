<?php
/*
  The main WooCommerce template
*/
get_header();
$homepageId = get_option( 'page_on_front' );
?>


 <?php $parent = wp_get_post_parent_id( get_the_id() ); if ($parent != 0) { ?>
 <div id="breadcrumbs" class="section">
 	<div class="container">
 		<div class="row">
 			<div class="col-12">
 				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb();}?>
 			</div>
 		</div>
 	</div>
 </div>
<?php } ?>

<section id="shop-page">
  <div class="container">
    <div class="toggle-sidebar d-lg-none">
      Filter <i class="far fa-sliders-h"></i>
    </div>
    <div class="row">
      <?php get_sidebar(); ?>
      <div class="col shop-content">
        <?php woocommerce_content(); ?>
      </div>
    </div>

  </div>
</section>

<?php

get_footer();

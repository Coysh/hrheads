<?php

$defaultThumb = wp_get_attachment_image_src( get_field('banner_image', 'option'), 'url' )[0];
$defaultThumbPP = wp_get_attachment_url( get_post_thumbnail_id(9) );
$bannerText = false;
$banner = get_field('banner');


  if (is_page()) {
    $banner_settings = $banner['banner_settings'];
    $link = $banner['button'];
    $pre_title = $banner['pre_title'];

    $bannerTitle = $banner['page_title'] ?: get_the_title();
    $pre_title = $banner['pre_title'];
    $bannerText = $banner['introduction'];
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'url' );
  

    if ($thumb) {
    $image_url = $thumb[0];
    $banner_image_id = get_post_thumbnail_id();
  } else {
    $banner_image_id = get_field('banner_image', 'options');
    $image_url = $defaultThumb;
  }

  } elseif (is_archive()) {
    $bannerTitle = single_cat_title('', false);
    $bannerText = category_description();
    $queried_object = get_queried_object();
    $link = 0;
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;
    $thumbnail = get_field('banner', $taxonomy . '_' . $term_id);
    $image_array = wp_get_attachment_image_src($thumbnail, 'full');
    $image_url = $image_array[0] ?? $defaultThumbPP;

    if ($image_url) { $banner_settings = 'default'; } else {$banner_settings = 'no-image';}
  } elseif (is_home()) {
    $banner = get_field('banner', get_option('page_for_posts'));
    $link = $banner['button'];
    $banner_settings = $banner['banner_settings'] ?: 'default';


    $bannerTitle = $banner['page_title'] ?: get_the_title(get_option('page_for_posts'));
    $bannerText = $banner['introduction'];
    $bannerButton = $banner['button'];

 
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), 'url' );
    $image_url = $thumb[0] ?? $defaultThumb;
  } elseif (is_singular('post')) {
    if (get_field('show_banner', 'options')) {
      $banner_settings = 'default';
    } else {
      $banner_settings = 'no-image';
    }

    $bannerTitle = get_the_title();
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'url' );
    $image_url = $thumb[0] ?: $defaultThumbPP;
  } elseif (is_single()) {

      $banner_settings = 'no-image';
  
      $bannerTitle = get_the_title();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'url' );
      $image_url = $thumb[0] ?: $defaultThumbPP;
  }
?>
 

<?php if ($banner_settings == 'default') { ?>
<div id="banner-bg" class="float">
	<div id="banner" class="section vc anim fadeIn cover is-dark" <?php if ($image_url) { ?>style="background-image: url('<?php echo $image_url;?>');"<?php } ?>>
		 
			  <div class="container">
			    <div class="row">
			     <div class="col-lg-6 text">
             <div class="inner float">
             <?php if ( function_exists('yoast_breadcrumb') ) { ?>
                  <?php if (has_post_parent() || is_single()) { ?>
                    <div id="breadcrumbs">
                    <?php yoast_breadcrumb(); ?>
                  </div>
                  <?php } ?>
                <?php } ?> 
                  

                    <?php if ($pre_title) { ?>
                      <span class="pre-title"><?php echo $pre_title; ?></span>
                    <?php } ?>
			       <h1 class="title"><?php echo $bannerTitle; ?></h1>

			       <?php if( $bannerText): ?>
			         <?php echo $bannerText; ?>
			       <?php endif; ?>

             <?php
             if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
             ?>
             <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
             <?php endif; ?>

             </div>
      
			     </div>
			    </div>
			  </div>
		 
	</div>
</div>
<?php } ?>

<?php if ($banner_settings == 'image-right') { ?>
  <div class="inner-section banner image-right full-width">
  <div class="container-fluid np">
    <div class="row no-gutters">
      <div class="col-lg-6 order-2 order-lg-1 col-xl-6 text d-flex flex-column justify-content-center align-items-end">
        <div class="inner float">
        <?php if ($pre_title) { ?>
                      <span class="pre-title"><?php echo $pre_title; ?></span>
                    <?php } ?>



        <h1 class="title"><?php echo $bannerTitle; ?></h1>
			       <?php if( $bannerText): ?>
			         <?php echo $bannerText; ?>
			       <?php endif; ?>

             <?php
             if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
             ?>
             <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
             <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-6 col-xl-6 order-1 order-lg-2 image-wrap anim fadeInRight" data-wow-duration="2s">
        <?php if (get_sub_field('no_crop')) {
          $imageSize = 'large';
        } else {
          $imageSize = 'large-cropped';
        }
        ?>
        <?php echo wp_get_attachment_image( $banner_image_id, ''.$imageSize.'' ); ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<?php if ($banner_settings == 'no-image') { ?>
<div id="nobanner" class="section">
  <div class="container">
	  <div class="row">
		  <div class="col-md-8">
        <?php if ( function_exists('yoast_breadcrumb') ) { ?>
                  <?php if (has_post_parent() || is_single()) { ?>
                    <div id="breadcrumbs">
                    <?php yoast_breadcrumb(); ?>
                  </div>
                  <?php } ?>
                <?php } ?> 

          <?php if ($pre_title) { ?>
                <span class="pre-title"><?php echo $pre_title; ?></span>
              <?php } ?>


          <?php if (is_singular('case-study') && get_field('case_studies_page', 'options')) { ?>
            <a class="main-page text-link left" href="<?php the_field('case_studies_page', 'options'); ?>">Case Studies</a>
           
          <?php } ?>
		      <h1 class="title line-after"><?php echo $bannerTitle; ?></h1>


		      <?php if( $bannerText): ?>
		       <?php echo $bannerText; ?>
		     <?php endif; ?>

         <?php if (get_field('stand_first') ) : ?><div class="stand-first"><?php the_field('stand_first') ?></div><?php endif; ?>

         <?php
             if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
             ?>
             <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
             <?php endif; ?>
		  </div>

      <?php if (is_singular('case-study') && has_post_thumbnail()) { ?>
        <div class="col-md-4 image-wrap">
            <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium' ); ?>
        </div>
      <?php } ?>  
	  </div>
  </div>
</div>
<?php } ?>

 
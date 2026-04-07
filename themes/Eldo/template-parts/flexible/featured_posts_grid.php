<?php 
$posts = get_sub_field('posts');
$posts_array = get_sub_field('posts');

if ($posts_array) {
  unset($posts_array[0]);
}



?>

<div class="inner-section featured-posts-grid">
  <div class="container large">

    <div class="row title-row justify-content-between align-items-center">

    <?php if( get_sub_field('title') ): ?>
      <div class="col-12 col-lg co title-wrap">
        <h2 class="lt nm"><?php the_sub_field('title'); ?></h2>
      </div>
    <?php endif; ?>

    <?php
    $link = get_sub_field('button');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <div class="col-auto co">
          <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        </div>
        
    <?php endif; ?>

    

    <div class="col-md-5 col-lg-auto co search-wrap">
      <form role="search" method="get" class="search-form d-flex" action="<?php echo home_url( '/' ); ?>">
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search posts...', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
              <input type="hidden" name="post_type" value="post" />

        <button type="submit" class="search-submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 cat-wrap d-none">
    <?php
    $category = get_queried_object();
    $current = $category->term_id;   
    ?>

    <?php $args = array(
      'show_option_all'    => 'All Categories',
      'show_option_none'   => '',
      'option_none_value'  => '-1',
      'orderby'            => 'title',
      'order'              => 'ASC',
      'show_count'         => 0,
      'hide_empty'         => 1,
      'child_of'           => 0,
      'exclude'            => '',
      'include'            => '',
      'echo'               => 1,
      'selected'           => $current,
      'hierarchical'       => 0,
      'name'               => 'cat',
      'id'                 => '',
      'class'              => 'select',
      'depth'              => 0,
      'tab_index'          => 0,
      'taxonomy'           => 'category',
      'hide_if_empty'      => false,
      'value_field'	     => 'term_id',
    ); ?>
    <?php wp_dropdown_categories( $args ); ?>
    <script type="text/javascript">
      <!--
      var dropdown = document.getElementById("cat");
      function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
          location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
        } else {
          location.href = "<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>";
        }
      }
      dropdown.onchange = onCatChange;
      -->
    </script>

  </div>

    </div>

    <div class="row narrow align-items-centers">
      <div class="col-lg-5 col-xl-6 d-flex">

      <?php
        $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($posts[0]), 'medium');
        $image_url = $image_array[0];

        if (get_field('url', $posts[0])) {
          $permalink = get_field('url', $posts[0]);
          
          $target = '_blank';
        } else {
          $permalink = get_the_permalink($posts[0]);
          $target = '_self';
        }
      ?>

      <?php if ($posts && $posts[0]) { ?>
        <a target="<?php echo $target; ?>" href="<?php echo $permalink; ?>" class="featured-post main float cover" style="background-image: url(<?php echo $image_url; ?>);">
              <div class="inner float">
              <span class="date"><?php echo get_the_time('d/m/y', $posts[0])?></span>
                <h2 class="section-title"><?php echo get_the_title($posts[0]); ?>   <?php if (get_field('url', $posts[0])) { ?>
      <i class="external fa-solid fa-arrow-up-right-from-square"></i>
    <?php } ?></h2>
                <p><?php echo mb_strimwidth(get_the_excerpt($posts[0]), 0, 240, "..."); ?></p>
              </div>
            </a>
      <?php } ?>
       
       
     
      </div>

      <div class="col-lg-7 col-xl-6">


        
      <?php if ($posts_array) { ?>
        <div class="excerpt-short-wrap row narrow">
      <?php foreach ($posts_array as $post_id) { ?>
      
        <div class="col-md-6">

           
<?php
  $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
  $image_url = $image_array[0];

  if (!$image_url) {
    $image_url = get_template_directory_uri() .'/images/placeholder.jpg';
  }

  if (get_field('url', $post_id)) {
    $permalink = get_field('url', $post_id);
    $target = '_blank';
  } else {
    $permalink = get_the_permalink($post_id);
    
    $target = '_self';
  }
?>
<a target="<?php echo $target; ?>" href="<?php echo $permalink; ?>" class="featured-post small float cover" style="background-image: url(<?php echo $image_url; ?>);">
  <div class="inner float">
  <span class="date"><?php echo get_the_time('d/m/y', $post_id)?></span>
    <h3><?php echo get_the_title($post_id); ?>

    <?php if (get_field('url', $post_id)) { ?>
      <i class="external fa-solid fa-arrow-up-right-from-square"></i>
    <?php } ?>
    </h3>
  </div>
</a>
</div>
      
      <?php } ?>
      <?php } ?>
      </div>
          
    </div>
  </div>
</div>
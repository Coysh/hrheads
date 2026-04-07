<div class="row search-row justify-content-between align-items-center">
  <div class="col search-wrap">
    <form role="search" method="get" class="search-form d-flex" action="<?php echo home_url( '/' ); ?>">
      <input type="search" class="search-field"
          placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>"
          value="<?php echo get_search_query() ?>" name="s"
          title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
        <input type="hidden" name="post_type" value="post" />
      <button type="submit" class="search-submit">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </form>
  </div>
  <div class="col-sm-6 col-md-4 col-lg-3 cat-wrap">
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

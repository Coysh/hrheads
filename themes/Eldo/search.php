<?php
/*
  Search Results
*/

get_header();
$postsPage = get_option('page_for_posts');
$blogStyle = get_field('blog_style', 'option');
?>

<div id="nobanner" class="section">
  <div class="container">
	  <div class="row">
		  <div class="col-lg-12">
		      <h1 class="title">Search Results</h1>

          <p>
          <?php
          
        printf( esc_html__( 'You searched for: %s', 'new' ), '<span><strong>' . get_search_query() . '</strong></span>' );
        ?>
        </p>
		  </div>
	  </div>
  </div>
</div>

<?php if ( have_posts() ) : ?>
<section id="search-page">
  <div class="container small">
    <div class="search-page-form">
      <form role="search" method="get" class="search-form d-flex" action="<?php echo home_url( '/' ); ?>">
			<input type="search" class="search-field"
			    placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>"
			    value="<?php echo get_search_query() ?>" name="s"
			    title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
						<input type="hidden" name="post_type" value="post" />
			<button type="submit" class="search-submit">
				<i class="fas fa-search"></i>
			</button>
		</form>
    </div>
    <div class="row">
      <div class="col">
        <div class="row search-results-wrap">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-12 d-flex excerpt-search">
              <?php get_template_part( 'template-parts/content', 'search' ); ?>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="pagination">
          <?php echo paginate_links(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else : get_template_part( 'template-parts/content', 'none' ); endif; ?>



<?php

get_footer();

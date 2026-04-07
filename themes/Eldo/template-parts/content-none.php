<?php
/**
 * No results
*/
?>
<div class="section" id="no-results">
	<div class="container small">
			<?php if (is_search()) { ?>
				<h3>Sorry, but nothing matched your search terms.</h3>
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
			<?php } else { ?>
				<h3 class="text-center">Oops! There's no content here. Please check back again later.</h3>
			<?php } ?>
	</div>
</div>



<article id="post-<?php the_ID(); ?>" <?php post_class('float excerpt'); ?> >
  <div class="row related no-gutters align-items-center">
    <div class="col excerpt-classic-image">
      <div class="excerpt-thumb float clear">
        <a href="<?php the_permalink();?>">
        <?php if ( has_post_thumbnail() ) { ?>
            <?php the_post_thumbnail('small-cropped');?>
        <?php } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="" alt="<?php bloginfo( 'name' ); ?>">
        <?php }?>
        </a>
      </div>
    </div>
    <div class="col d-flex flex-column excerpt-classic-content">
      <div class="inner float">
        <header class="excerpt-header float clear">
          <h3 class="excerpt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
          <div class="meta float clear">
      			<span class="author">By <?php the_author(); ?></span>
      			<span class="date"> - <?php the_time('F jS, Y')?></span>
      			<span class="categories">Posted in <?php the_category( ', ' ); ?></span>
<!--
      			<?php if(has_tag()) { ?><span class="tags"><?php the_tags( '<i class="fas fa-tags"></i> ', ', ' ); ?><br></span><?php } ?>
      			<span class="comments"><a href="<?php comments_link(); ?>"><i class="fas fa-comments"></i> <?php comments_number( 'No comments', 'One Comment', '% Comments' ); ?></a></span>
-->
      		</div>
        </header>
        <?php if ( is_sticky() ) { ?>
        <div class="sticky-badge float clear">
          Featured Post
        </div>
        <?php } ?>
        <div class="excerpt-content">
          <?php echo mb_strimwidth(get_the_excerpt(), 0, 140, "..."); ?>
        </div>
      </div>
      <footer class="excerpt-footer bottom">
        <a class="button" href="<?php the_permalink();?>">Read More</a>
      </footer>
    </div>
  </div>
</article>

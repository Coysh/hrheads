
    <?php
    $args = array(
      'post_type'              => array( 'page', 'case-study' ),
      'posts_per_page'         => '-1',
      'order'                  => 'ASC',
      'orderby'                => 'title',
      'post__not_in'           => array(6461), // exclude ELDO page
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
    $layouts_used = array();
    ?>
      <div class="float">
        <div class="container">

          <h2 class="section-title">Pages</h2>
              <div class="accordionmain">
      <?php while ( $query->have_posts() ) { $query->the_post(); ?>

        <?php if( have_rows('section') ): ?>

          <div class="accordion">
            <div class="accordion-toggle">
              <?php the_title(); ?> <i class="fa fa-angle-down"></i>
            </div>
            <div class="accordion-content box">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/post.php?post=<?php echo get_the_id(); ?>&action=edit" target="_blank">Edit page</a> | <a href="<?php the_permalink(); ?>" target="_blank">View Page</a>
              <br>
              <h3>Layouts</h3>
              <?php while( have_rows('section') ): the_row(); ?>
                <ul class="page-section np">

                <?php if( have_rows('flexible_content') ): ?>
                  <?php while ( have_rows('flexible_content') ) : the_row(); ?>
                    <?php // get_template_part( 'template-parts/flexible/'. get_row_layout() ); ?>

                    <li><?php echo get_row_layout(); ?></li>
                    <?php $layouts_used[] = get_row_layout(); ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              </ul>

              <?php endwhile; ?>
            </div>
          </div>




        <?php endif; ?>
      <?php }  ?>
      </div>
      </div>
    </div>

    <?php  }  else { ?>
    <?php } wp_reset_postdata(); ?>

    <?php if ($layouts_used): ?>
      <?php $unique_layouts_used = array_unique($layouts_used); ?>
      <?php $last_element = end($unique_layouts_used) ?>
    <div class="float layouts-used">
      <div class="container">
        <h3>Total layouts used (<?php echo count(array_unique($layouts_used)); ?>)</h3>
        <!-- <ul> -->
        <div id="textarea">
        <?php foreach ($unique_layouts_used as $layout_used): ?>
        <?php if ($last_element == $layout_used) { ?>
          <li>a[data-layout="<?php echo $layout_used; ?>"] {<br>
            display: block;
          <br>}</span></li>
        <?php } else { ?>
          <li>a[data-layout="<?php echo $layout_used; ?>"]<span class="comma">,</span></li>
        <?php } ?>
        <?php endforeach; ?>
      </div>

        <script type="text/javascript">
        function CopyToClipboard(containerid) {
          if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select().createTextRange();
            document.execCommand("copy");
          } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
            document.execCommand("copy");
            var copyButton = document.getElementById("button1");
            copyButton.remove();
          }
        }
        </script>
        <br>
        <button id="button1" onclick="CopyToClipboard('textarea')">COPY CSS</button>
        <br>
        <br>
      </div>
    </div>
    <?php endif; ?>

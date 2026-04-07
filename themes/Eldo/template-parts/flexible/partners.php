<div class="inner-section partners">

        <?php if ( have_rows('partners') ) : ?>
        
            <?php while( have_rows('partners') ) : the_row(); ?>
            <div class="partner float">
            <div class="container">
              
            <div class="row align-items-center">
           
            <div class="col-md-3 logo anim zoomIn">
                <?php if( get_sub_field('logo') ) { ?>
                    <?php echo wp_get_attachment_image( get_sub_field('logo'), 'small' ); ?>
                <?php } ?>

                <?php
                        $link = get_sub_field('link');
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                </div>
                <div class="col text">
                    <div class="inner float">

                 
                <h3><?php the_sub_field('title'); ?></h3>

                        <?php if( get_sub_field('text') ) { ?>
                        <p><?php the_sub_field('text'); ?></p>
                        <?php } ?>

                      

                </div>
                </div>

            
            </div>
            
                             
            </div>
            </div>
            <?php endwhile; ?>
        
        <?php endif; ?>
        
   
</div>
<div class="inner-section pricing">
    <div class="container">
      <?php $cols = cols('columns', 'col-md-6 col-lg-4'); ?>
        <?php if( have_rows('pricing_tables') ): $i = 1; ?>
            <div class="row">
            <?php while( have_rows('pricing_tables') ): the_row(); ?>
                <div class="<?php echo $cols; ?> product d-flex">
                    <div class="inner float d-flex flex-column">

                
                    <?php if( get_sub_field('title') ) { ?>
                    <div class="header float dark-bg is-dark">
                        <h3><?php the_sub_field('title'); ?></h3>
                        
                        <?php if( get_sub_field('price') ) { ?>
                            <h4><?php the_sub_field('price'); ?></h4>
                        <?php } ?>
                    
                    </div>
                    
                    <?php } ?>

                    <?php if ( have_rows('features') ) : ?>
                        <div class="float features-wrap">

                        <?php while( have_rows('features') ) : the_row(); ?>
                        <div class="feature float">
                            <div class="container np">                   
                                <div class="row align-items-center">
                                    <div class="col">
                                        <?php the_sub_field('feature'); ?>
                                    </div>
                                    
                                    <?php if( get_sub_field('tick') ) { ?>
                                        <div class="col-auto icon">
                                            <i class="fas fa-circle-check"></i>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-auto icon cross">
                                            <i class="fas fa-circle-xmark"></i>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $link = get_sub_field('link');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <div class="float bottom">
                            <a class="button d-block" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        </div>                  
                    <?php endif; ?>
                    </div>
                </div>
            <?php $i++; endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

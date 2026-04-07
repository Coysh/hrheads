<div class="inner-section accordion-layout">
    <div class="container">
        <div class="row">
            <?php if( get_sub_field('introduction') ) { ?>
                <div class="col-md-4 co intro">
                    <?php the_sub_field('introduction'); ?>
                </div>
            
            <?php } ?>
            <div class="col accordionmain co">
                <?php if( have_rows('accordion') ): $i = 0; ?>
                <?php while( have_rows('accordion') ): the_row(); ?>
                <div class="accordion">
                    <div class="accordion-toggle">
                        <?php the_sub_field('title'); ?>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="accordion-content box">
                        <?php the_sub_field('content'); ?>
                    </div>
                </div>
                <?php $i++; endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
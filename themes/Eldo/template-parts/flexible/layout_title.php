<?php 
$button_style = get_sub_field('button_style') ?: 'default';
?>

<div class="inner-section layout-title">
    <div class="container<?php if( get_sub_field('center') ) { ?> tc<?php } ?>">
        <div class="row align-items-center justify-content-between">
            <div class="col co title-wrap">
            <?php if( get_sub_field('pre_title') ): ?>
                <h4 class="pt"><?php the_sub_field('pre_title'); ?></h4>
            <?php endif; ?>
            <?php if( get_sub_field('title') ): ?>
                <h2 class="lt line-after"><?php the_sub_field('title'); ?></h2>
            <?php endif; ?>
            <?php if( get_sub_field('subtitle') ): ?>
                <h4 class="st"><?php the_sub_field('subtitle'); ?></h4>
            <?php endif; ?>
            </div>

            <?php
            $link = get_sub_field('button');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class="col-md-auto co button-wrap">
                    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                </div>
                
            <?php endif; ?>
        </div>
      
    </div>
</div>
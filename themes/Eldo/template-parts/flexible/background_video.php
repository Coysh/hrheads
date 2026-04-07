<div class="inner-section background-video is-dark">
    <div class="float video-wrap anim zoomIn">
        <video playsinline autoplay muted loop class="anim fadeIn">
            <source src="<?php the_sub_field('video'); ?>" type="video/mp4">
        </video>

        <div class="text-wrap d-flex flex-column justify-content-center">
            <div class="container medium tc anim fadeIn" data-wow-delay="0.5s">
                <?php the_sub_field('text'); ?>
            </div>
        </div>
    </div>
</div>
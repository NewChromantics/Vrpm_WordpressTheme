<?php if ( $banner_media_type == 'parallax' ) : ?>
    <section class="jumbotron jumbotron--image js-parallax" style="background-image: url(<?php echo get_post_thumbnail_url( $post->ID ); ?>);">
        <div class="jumbotron__overlay"></div>
        <div class="jumbotron__content">
            <?php the_content(); ?>
        </div>
    </section>
<?php elseif( $banner_media_type == 'video' ) : ?>
    <section class="jumbotron jumbotron--video" style="background-image: url(<?php echo get_post_thumbnail_url( $post->ID ); ?>);">
        <div class="jumbotron__overlay"></div>
        <div class="jumbotron__video">
            <video class="jumbotron__video__player" muted autoplay loop>
                <source src="<?php echo get_field( 'video' ); ?>" type="video/mp4">
            </video>
        </div>
        <div class="jumbotron__content">
            <?php the_content(); ?>
        </div>
    </section>
<?php else : ?>
    <section class="jumbotron js-sphere" id="<?php echo uniqid( '360_' ); ?>" data-image="<?php echo get_post_thumbnail_url( $post->ID ); ?>" data-height="<?php echo get_field( 'banner_height' ); ?>"></section>
<?php endif; ?>
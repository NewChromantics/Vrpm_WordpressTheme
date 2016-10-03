<?php 

    $banner_media_type = get_field( 'banner_media_type' );
    $address  = get_field( 'address' );
    $contacts = get_field( 'contacts' );
    $socials  = get_field( 'social_networks', 'option' );
    
    $blog = get_posts([
        'posts_per_page' => 3
    ]);

    get_header(); 

?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php include( locate_template( 'partials/banner.php' ) ); ?>

    <?php foreach ( get_field( 'sections' ) as $section ) : ?>

        <?php if ( $section['type'] == 'default' ) : ?>

            <section class="section section--default">
                <div class="container container--narrow">
                    <?php echo wp_get_attachment_image( $section['image'], 'full', null, ['class' => 'section__image' . ($section['video'] ? ' has-video' : null)] ); ?>
                    <?php if ( $section['video'] ) : ?>
                        <video class="section__video" muted autoplay loop>
                            <source src="<?php echo $section['video']; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                    <?php echo $section['copy']; ?>
                </div>
            </section>

        <?php else : ?>

            <section class="section section--highlight">
                <div class="section__image section__image--<?php echo $section['size']; ?>" style="background-image: url(<?php echo wp_get_attachment_url( $section['image'] ); ?>);"></div>
                <div class="section__copy">
                    <div class="container container--narrow">
                        <?php echo $section['copy']; ?>
                    </div>
                </div>
            </section>

        <?php endif; ?>

    <?php endforeach; ?>

    <?php get_template_part( 'partials/section', 'newsletter' ); ?>

    <section class="section section--grey section--contacts">
        <div class="container">
            <div class="row row--double">
                <div class="col col--lg-6 col--md-6 col--sm-6 col--xs-12">
                    <div class="map" data-lat="<?php echo $address['lat'] ?>" data-lng="<?php echo $address['lng'] ?>" data-zoom="14"></div>
                </div>
                <div class="col col--lg-6 col--md-6 col--sm-6 col--xs-12">
                    <div class="contacts">
                        <?php echo $contacts; ?>
                        <h4>Follow us</h4>
                        <ul class="list list--socials">
                            <?php foreach ( $socials as $social ) : ?>
                                <li><a href="<?php echo $social['url']; ?>" target="_blank"><?php echo get_icon( $social['url'] ); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--blog">
        <div class="container">
            <div class="row">
                <?php foreach ( $blog as $post ) : ?>
                    <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                        <article class="post post--intro">
                            <a href="<?php echo get_the_permalink( $post->ID ); ?>">
                                <?php echo get_the_post_thumbnail( $post->ID, 'post-intro-thumb', ['class' => 'post__thumbnail'] ); ?>
                                <h3 class="post__title"><?php echo get_the_title( $post->ID ); ?></h3>
                                <p class="post__date"><time><?php echo get_the_date( get_option( 'date_format' ), $post->ID ); ?></time></p>
                            </a>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>

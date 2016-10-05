<?php 

    $banner_media_type = get_field( 'banner_media_type' );
    $team = get_field( 'team' );

    if ( $_POST['contact_email'] )
    {
        submit_contact_form();
    }

    get_header(); 

?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php include( locate_template( 'partials/banner.php' ) ); ?>

    <?php foreach ( get_field( 'sections' ) as $section ) : ?>

        <?php 
            $section['three_column_content'] = array_map( 'array_filter', $section['three_column_content'] ); 
            $section['three_column_content'] = array_filter( $section['three_column_content'] ); 
        ?>

        <?php if ( $section['type'] == 'default' ) : ?>

            <section class="section section--default">
                <div class="container container--narrow">
                    <?php if ( $section['media'] == 'image' ) : ?>
                        <?php echo wp_get_attachment_image( $section['image'], 'full', null, ['class' => 'section__image'] ); ?>
                    <?php elseif ( $section['media'] == '360' ) : ?>
                        <?php echo $section['width'] == 'full_width' ? '</div>' : null; ?>
                        <div class="section__panorama<?php echo $section['width'] == ' section__panorama--wide' ? '</div>' : null; ?> js-sphere" id="<?php echo uniqid( '360_' ); ?>" data-image="<?php echo wp_get_attachment_url( $section['image'] ); ?>" data-height="<?php echo $section['height']; ?>"></div>
                        <?php echo $section['width'] == 'full_width' ? '<div class="container container--narrow">' : null; ?>
                    <?php elseif ( $section['media'] == 'video' ) : ?>
                        <video class="section__video" muted autoplay loop>
                            <source src="<?php echo $section['video']; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>

                    <?php if ( $section['copy'] ) : ?>
                        <?php echo $section['copy']; ?>
                    <?php endif; ?>
                </div>
                <?php if ( $section['three_column_content'] ) : ?>
                    <div class="container">
                        <div class="row row--double">
                            <?php foreach ( $section['three_column_content'] as $column ) : ?>
                                <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                                    <?php echo $column['copy']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </section>

        <?php else : ?>

            <section class="section section--highlight">
                <div class="section__image section__image--<?php echo $section['size']; ?><?php echo $section['parallax'] == 1 ? ' js-parallax' : null; ?>" style="background-image: url(<?php echo wp_get_attachment_url( $section['image'] ); ?>);"></div>
                <?php if ( $section['copy'] || $section['three_column_content'] ) : ?>
                    <div class="section__copy">
                        <?php if ( $section['copy'] ) : ?>
                            <div class="container container--narrow">
                                <?php echo $section['copy']; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $section['three_column_content'] ) : ?>
                            <div class="container">
                                <div class="row row--double">
                                    <?php foreach ( $section['three_column_content'] as $column ) : ?>
                                        <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                                            <?php echo $column['copy']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>

        <?php endif; ?>

    <?php endforeach; ?>  

    <?php if ( $team ) : ?>

        <section class="section section--default">
            <div class="container">
                <h2 class="push-bottom-2x">Meet the team</h2>
                <div class="row row--double">
                    <?php foreach ( $team as $member ) : ?>
                        <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                            <div class="team">
                                <?php echo wp_get_attachment_image( $member['image'], 'team', null, ['class' => 'team__image'] ); ?>
                                <?php echo $member['bio']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endif; ?>

    <?php if ( is_page( 'contact' ) ) : ?>
        <section class="section section--default">
            <div class="container">
                <?php if ( isset( $_GET ) && $_GET['message'] == 'success' ) : ?>
                    <p>Your message has been sent. We will get back to you as soon as possible. Thanks!</p>
                <?php else : ?>
                    <form action="<?php echo get_the_permalink( $post->ID ); ?>" method="POST" class="form form--contact">
                        <div class="form__group">
                            <label for="contact_name" class="form__label form__label--required">Name</label>
                            <input type="text" name="contact_name" id="contact_name" class="form__input" required>
                        </div>
                        <div class="form__group">
                            <label for="contact_email" class="form__label form__label--required">Email</label>
                            <input type="email" name="contact_email" id="contact_email" class="form__input" required>
                        </div>
                        <div class="form__group">
                            <label for="contact_telephone" class="form__label">Telephone</label>
                            <input type="text" name="contact_telephone" id="contact_telephone" class="form__input">
                        </div>
                        <div class="form__group">
                            <label for="contact_message" class="form__label form__label--required">Message</label>
                            <textarea name="contact_message" id="contact_message" class="form__input" required></textarea>
                        </div>
                        <div class="form__actions">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part( 'partials/section', 'newsletter' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<main class="main" role="main">
    <div class="container">

        <div class="row">
            <div class="col col--lg-8 col--md-8 col--sm-8 col--xs-12">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article <?php post_class( 'post--full'); ?>>

                        <header class="post__header" role="heading">
                            <h2 class="post__title"><?php the_title(); ?></h2>
                            <p class="post__date"><time><?php the_date( get_option( 'date_format' ) ); ?></time></p>
                        </header>

                        <?php the_post_thumbnail( 'post-excerpt-thumb', ['class' => 'post__thumbnail'] ); ?>

                        <?php the_content(); ?>

                    </article>

                <?php endwhile; ?>

            </div>

            <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                <?php get_template_part( 'partials/sidebar', 'posts' ); ?>
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
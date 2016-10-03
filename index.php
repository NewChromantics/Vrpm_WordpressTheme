<?php get_header(); ?>

<main class="main" role="main">
    <div class="container">

        <div class="row">
            <div class="col col--lg-8 col--md-8 col--sm-8 col--xs-12">
                <div class="posts">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article <?php post_class( 'post--excerpt' ); ?>>

                            <header class="post__header" role="heading">
                                <a href="<?php the_permalink(); ?>">
                                    <h2 class="post__title"><?php echo get_the_title( $post->ID ); ?></h2>
                                </a>
                                <p class="post__date"><time><?php echo get_the_date( get_option( 'date_format' ), $post->ID ); ?></time></p>
                            </header>

                            <a href="<?php the_permalink(); ?>">
                                <?php echo get_the_post_thumbnail( $post->ID, 'post-excerpt-thumb', ['class' => 'post__thumbnail'] ); ?>
                            </a>

                            <?php the_excerpt(); ?>

                            <a href="<?php the_permalink(); ?>" class="btn">Read more</a>

                        </article>

                    <?php endwhile; ?>

                    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                        <nav class="nav nav--pagination">
                            <?php 
                                echo paginate_links([
                                    'base'    => str_replace( 99999999, '%#%', esc_url( get_pagenum_link( 99999999 ) ) ),
                                    'format'  => '?paged=%#%',
                                    'current' => max( 1, get_query_var('paged') ),
                                    'total'   => $wp_query->max_num_pages
                                ]); 
                            ?>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col col--lg-4 col--md-4 col--sm-4 col--xs-12">
                <?php get_template_part( 'partials/sidebar', 'posts' ); ?>
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
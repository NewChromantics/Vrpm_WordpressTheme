        <footer class="footer" role="contentinfo">
            <div class="container">
                <div class="row">
                    <div class="col col--lg-3 col--md-3 col--sm-3 col--xs-12">
                        <a href="<?php echo get_bloginfo( 'url' ); ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/vrpm-white.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" class="footer__logo">
                        </a>
                    </div>
                    <div class="col col--lg-3 col--md-3 col--sm-3 col--xs-12">
                        <?php dynamic_sidebar( 'footer' ) ?>
                    </div>
                    <div class="col col--lg-3 col--md-3 col--sm-3 col--xs-12">
                        <nav class="footer__navigation" role="navigation">
                            <?php wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'nav nav--footer']); ?>
                        </nav>
                    </div>
                    <div class="col col--lg-3 col--md-3 col--sm-3 col--xs-12">
                        <p class="footer__copyright">
                            &copy; <?php echo date( 'Y' ); ?> by <?php bloginfo( 'name' ); ?>
                            <br> 
                            All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>

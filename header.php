<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if lte IE 9]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="theme-directory" content="<?php echo get_stylesheet_directory_uri(); ?>">
        <link rel="dns-prefetch" href="//google-analytics.com">
        <link rel="stylesheet" href="<?php echo get_bloginfo( 'stylesheet_url' ) . '?' . time(); ?>">
        <?php wp_head(); ?>
        <!--[if lt IE 10]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
        <![endif]-->
    </head>
    <body <?php body_class(); ?>>
        <header class="header" role="banner">
            <div class="container">
                <a href="<?php echo get_bloginfo( 'url' ); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/vrpm.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" class="header__logo">
                </a>
                <a href="#" class="header__burger js-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <nav class="header__navigation" role="navigation">
                    <?php wp_nav_menu(['theme_location' => 'header', 'menu_class' => 'nav nav--header']); ?>
                </nav>
            </div>
        </header>

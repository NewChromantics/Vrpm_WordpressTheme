<?php

/**
 * Add support for useful stuff
 */

if ( function_exists( 'add_theme_support' ) )
{
    // Add support for document title tag
    add_theme_support( 'title-tag' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-intro-thumb', 290, 200, true );
    add_image_size( 'post-excerpt-thumb', null, 400, true );
    add_image_size( 'team', 300, 300, true );

    // Add Support for post formats
    // add_theme_support( 'post-formats', ['post'] );
    // add_post_type_support( 'page', 'excerpt' );

    // Localisation Support
    load_theme_textdomain( 'barebones', get_template_directory() . '/languages' );
}



/**
 * Remove junk
 */

define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );

add_filter('show_admin_bar', '__return_false');

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function barebones_remove_comments_rss( $for_comments )
{
    return;
}

add_filter( 'post_comments_feed_link', 'barebones_remove_comments_rss' );



/**
 * jQuery the right way
 */

function barebones_scripts()
{
    wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
    wp_enqueue_style( 'icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBcZ5P7luteXzhuSrRIh4Qr3g7Oz2AwPNY', ['jquery'], null, true );
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.min.js?' . time(), ['jquery'], null, true );
}

add_action( 'wp_enqueue_scripts', 'barebones_scripts' );



/**
 * Nav menus
 */

if ( function_exists( 'register_nav_menus' ) )
{
    register_nav_menus([
        'header' => 'Header',
        'footer' => 'Footer'
    ]);
}

function barebones_nav_menu_args( $args = '' )
{
    $args['container']       = false;
    $args['container_class'] = false;
    $args['menu_id']         = false;
    $args['items_wrap']      = '<ul class="%2$s">%3$s</ul>';

    return $args;
}

add_filter( 'wp_nav_menu_args', 'barebones_nav_menu_args' );


/**
 * Shortcodes ([button] shortcode included)
 */

function button_shortcode( $atts, $content = null )
{
    $atts['class']  = isset($atts['class']) ? $atts['class'] : 'btn';

    return '<a class="' . $atts['class'] . '" href="' . $atts['link'] . '">' . $content . '</a>';
}

add_shortcode( 'button', 'button_shortcode' );


function panorama_shortcode( $atts )
{
    return '<div class="js-sphere" id="' . uniqid( '360_' ) . '" data-image="' . $atts['image'] . '" data-height="' . $atts['height'] . '"></div>';
}

add_shortcode( 'panorama', 'panorama_shortcode' );



/**
 * TinyMCE
 */

function barebones_mce_buttons_2( $buttons )
{
    array_unshift( $buttons, 'styleselect' );
    $buttons[] = 'hr';

    return $buttons;
}

add_filter( 'mce_buttons_2', 'barebones_mce_buttons_2' );


function barebones_tiny_mce_before_init( $settings )
{
    $style_formats = [
        [
            'title'    => 'Button',
            'selector' => 'a',
            'classes'  => 'btn'
        ]
    ];

    $settings['style_formats'] = json_encode( $style_formats );
    $settings['style_formats_merge'] = true;

    return $settings;
}

add_filter( 'tiny_mce_before_init', 'barebones_tiny_mce_before_init' );



/**
 * Get post thumbnail url
 * 
 * @param  int $post_id
 * @return string
 */

function get_post_thumbnail_url( $post_id )
{
    return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
}


/**
 * Google Maps API key
 * 
 * @param  string $api
 * @return array
 */

function my_acf_google_map_api( $api )
{    
    $api['key'] = 'AIzaSyBcZ5P7luteXzhuSrRIh4Qr3g7Oz2AwPNY';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/**
 * Get fontawesome icon from url
 * 
 * @param  string $url
 * @return string
 */

function get_icon( $url )
{
    if ( strpos( $url, 'facebook' ) )
    {
        $icon = 'fa fa-facebook';
    }
    elseif ( strpos( $url, 'twitter' ) )
    {
        $icon = 'fa fa-twitter';
    }
    elseif ( strpos( $url, 'youtube' ) ) 
    {
        $icon = 'fa fa-youtube';
    }
    elseif ( strpos( $url, 'vimeo' ) )
    {
        $icon = 'fa fa-vimeo';
    }
    elseif ( strpos( $url, 'instagram' ) )
    {
        $icon = 'fa fa-instagram';
    }
    elseif ( strpos( $url, 'linkedin' ) )
    {
        $icon = 'fa fa-linkedin';
    }

    return '<i class="' . $icon .  '"></i>';
}


/**
 * Add social links to header
 * 
 * @param  array $items
 * @param  array $args
 * @return string
 */

function add_socials_to_header( $items, $args ) 
{
    if ( $args->theme_location == 'header' )
    {
        foreach ( get_field( 'social_networks', 'option' ) as $social )
        {
            $items .= '<li class="menu-item menu-item--social"><a href="' . $social['url'] . '" target="_blank">' . get_icon( $social['url'] ) . '</a></li>';
        }
    }

    return $items;
}

add_filter( 'wp_nav_menu_items','add_socials_to_header', 10, 2 );



/**
 * Add Competition form shortcode button to TinyMCE editor
 */

function add_my_shortcode_tooltip_button() 
{
    global $typenow;

    if ( ! current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;

    if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) return;

    if ( get_user_option( 'rich_editing' ) == 'true' ) 
    {
        add_filter('mce_external_plugins', 'my_theme_tooltip_add_tinymce_plugin');
        add_filter('mce_buttons', 'my_theme_tooltip_register_tinymce_plugin');
    }
}

add_action( 'admin_head', 'add_my_shortcode_tooltip_button' );


/**
 * 
 */

function my_theme_tooltip_add_tinymce_plugin( $plugin_array ) 
{
    $plugin_array['ttip_shortcode_button'] = get_stylesheet_directory_uri() . '/js/editor-tooltip-button.js'; 
    return $plugin_array;
}


/**
 * 
 */

function my_theme_tooltip_register_tinymce_plugin( $buttons ) 
{
    array_push( $buttons, 'ttip_shortcode_button' );
    return $buttons;
}


/**
 * Contact form
 */

function submit_contact_form()
{
    $name = sanitize_text_field( $_POST['contact_name'] );
    $email = sanitize_text_field( $_POST['contact_email'] );
    $telephone = sanitize_text_field( $_POST['contact_telephone'] );
    $message = sanitize_text_field( $_POST['contact_message'] );

    $to      = 'info@vrpm.co.uk';
    $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
    $subject = 'Website message - ' . $name;
    $message = '<strong>Name</strong> ' . $name . '<br />' .
               '<strong>Email</strong> ' . $email . '<br />' .
               '<strong>Telephone</strong> ' . $telephone . '<br />' .
               '<strong>Message</strong> ' . $message;

    //
    wp_mail( $to, $subject, $message, $headers );

    //
    wp_redirect( get_permalink( $post->ID ) . '?message=success' );
    exit;
}


/**
 * Widgets
 */

register_sidebar([
    'id'            => 'footer',
    'name'          => 'Footer',
    'description'   => '',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => ''
]);
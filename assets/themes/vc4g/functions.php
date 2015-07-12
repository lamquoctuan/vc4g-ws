<?php
if (!function_exists('vc4g_setup')) :
    function vc4g_setup()
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'vc4g'),
            'social' => __('Social Links Menu', 'vc4g'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', vc4g_fonts_url()));
    }
endif; // vc4g_setup
add_action('after_setup_theme', 'vc4g_setup');

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function vc4g_widgets_init()
{
    register_sidebar(array(
        'name' => __('Widget Area', 'vc4g'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'vc4g'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'vc4g_widgets_init');

if (!function_exists('vc4g_fonts_url')) :
    /**
     * Register Google fonts.
     *
     * @since VC4G 2.0
     *
     * @return string Google fonts URL for the theme.
     */
    function vc4g_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Roboto font: on or off', 'vc4g')) {
            $fonts[] = 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Roboto+Condensed font: on or off', 'vc4g')) {
            $fonts[] = 'Roboto+Condensed:300italic,400italic,700italic,400,300,700';
        }

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'vc4g');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
            ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 *
 */
function vc4g_scripts()
{

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('vc4g-font-awesome', WP_CONTENT_URL . '/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('vc4g-fonts', vc4g_fonts_url());

    wp_enqueue_style('vc4g-bootstrap', WP_CONTENT_URL . '/css/bootstrap.min.css');
    // Load our main stylesheet.
    wp_enqueue_style('vc4g-style', WP_CONTENT_URL . '/css/styles.css');
    if (!is_front_page() && !is_home()) {
        wp_enqueue_style('vc4g-akordeon', WP_CONTENT_URL . '/css/jquery.akordeon.css');
    }
//    wp_enqueue_style('vc4g-vancouver', WP_CONTENT_URL . '/css/vancouver.css');

//    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//        wp_enqueue_script( 'comment-reply' );
//    }

//    if ( is_singular() && wp_attachment_is_image() ) {
//        wp_enqueue_script( 'vc4g-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
//    }

//    jQuery
    wp_enqueue_script('vc4g-jquery', WP_CONTENT_URL . '/js/jquery.js', array(), '20150630');
//    Bootstrap Core JavaScript
    wp_enqueue_script('vc4g-bootstrap', WP_CONTENT_URL . '/js/bootstrap.min.js', array(), '20150630');
//    Plugin JavaScript
    wp_enqueue_script('vc4g-jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array(), '20150630');
    wp_enqueue_script('vc4g-classie', WP_CONTENT_URL . '/js/classie.js', array(), '20150630');
    if (is_front_page() || is_home()) {
        wp_enqueue_script('vc4g-cbpAnimatedHeader', WP_CONTENT_URL . '/js/cbpAnimatedHeader.js', array(), '20150630');
    }
    wp_enqueue_script('vc4g-responsive-tabs', WP_CONTENT_URL . '/js/responsive-tabs.js', array(), '20150630');
//    Contact Form JavaScript
//    wp_enqueue_script('vc4g-bootstrap-validation', WP_CONTENT_URL . '/js/jqBootstrapValidation.js', array(), '20150630');
//    wp_enqueue_script('vc4g-contact-form', WP_CONTENT_URL . '/js/contact_me.js', array(), '20150630');
//    Custom Theme JavaScript
    wp_enqueue_script('vc4g-vancouver', WP_CONTENT_URL . '/js/vancouver.js', array(), '20150630');
    if (is_front_page() || is_home()) {
        wp_enqueue_script('vc4g-roundabout', WP_CONTENT_URL . '/js/jquery.roundabout.js', array(), '20150630');
    } else {
        wp_enqueue_script('vc4g-akordeon', WP_CONTENT_URL . '/js/jquery.akordeon.js', array(), '20150702');
    }

}

add_action('wp_enqueue_scripts', 'vc4g_scripts');

//http://www.labnol.org/internet/wordpress-optimization-guide/3931/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
add_filter('pre_comment_content', 'esc_html');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
function no_wordpress_errors()
{
    return 'GET OFF MY LAWN !! RIGHT NOW !!';
}

add_filter('login_errors', 'no_wordpress_errors');
define('DISALLOW_FILE_EDIT', true);

include_once 'inc/post_types.php';
include_once 'inc/functions.php';

<?php
if (! defined('CUR_THEME_DIR')) {
    define('CUR_THEME_DIR', get_template_directory());
}
$theme = wp_get_theme( );
if (! defined('CUR_THEME_NAME')) {
    define('CUR_THEME_NAME', $theme->get( 'Name' ));
}
if (! defined('CUR_THEME_VER')) {
    define('CUR_THEME_VER', $theme->get( 'Version' ));
}

// Url filter callback function
function filteredUrlCallback( $uri, $scheme = 'https' ) {
    $filteredUrl = '';
    if (isset($_SERVER['APP_CDN'])) {
        $filteredUrl = $scheme . '://' . $_SERVER['APP_CDN'] . $uri;
    }
    else {
        $filteredUrl = site_url($uri);
    }
    return $filteredUrl;
}
add_filter( 'url_filter', 'filteredUrlCallback', 10, 3 );

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
 * Register widget area Blog Sidebar.
 *
 */
function vc4g_blog_widgets_init()
{
    register_sidebar(array(
        'name' => __('Blog Sidebar', 'vc4g'),
        'id' => 'sidebar-blog',
        'description' => __('Add widgets here to appear in your blog sidebar.', 'vc4g'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'vc4g_blog_widgets_init');

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
        if ('off' !== _x('on', 'Roboto Condensed font: on or off', 'vc4g')) {
            $fonts[] = 'Roboto Condensed:300italic,400italic,700italic,400,300,700';
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
    wp_enqueue_style('vc4g-font-awesome', apply_filters( 'url_filter', '/assets/font-awesome/css/font-awesome.min.css' ), '4.2.0');
    wp_enqueue_style('vc4g-weather-icons', apply_filters( 'url_filter', '/assets/weather-icons/css/weather-icons.css' ), '1.3.2');
//    wp_enqueue_style('vc4g-weather-icons', '//cdnjs.cloudflare.com/ajax/libs/weather-icons/1.3.2/css/weather-icons.css');

    wp_enqueue_style('vc4g-fonts', vc4g_fonts_url());

    wp_enqueue_style('vc4g-bootstrap', apply_filters( 'url_filter', '/assets/css/bootstrap.min.css' ), '3.3.4');

    // Load our main stylesheet.
    wp_enqueue_style('vc4g-style', apply_filters( 'url_filter', '/assets/css/styles.css' ), CUR_THEME_VER);
    if (!is_front_page() && !is_home()) {
        wp_enqueue_style('vc4g-akordeon', apply_filters( 'url_filter', '/assets/css/jquery.akordeon.css' ), CUR_THEME_VER);
    }
//    wp_enqueue_style('vc4g-vancouver', WP_CONTENT_URL . '/css/vancouver.css');

//    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//        wp_enqueue_script( 'comment-reply' );
//    }

//    if ( is_singular() && wp_attachment_is_image() ) {
//        wp_enqueue_script( 'vc4g-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
//    }

//    jQuery
    wp_enqueue_script('vc4g-jquery', apply_filters( 'url_filter', '/assets/js/jquery.js' ), array(), '1.11.1');
//    Bootstrap Core JavaScript
    wp_enqueue_script('vc4g-bootstrap', apply_filters( 'url_filter', '/assets/js/bootstrap.min.js' ), array(), '3.3.4');
//    Plugin JavaScript
    wp_enqueue_script('vc4g-jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array(), '1.3');
    wp_enqueue_script('vc4g-classie', apply_filters( 'url_filter', '/assets/js/classie.js' ), array(), CUR_THEME_VER);
    // if (is_front_page() || is_home()) {
    //     load home page header script
    // }
    wp_enqueue_script('vc4g-responsive-tabs', apply_filters( 'url_filter', '/assets/js/responsive-tabs.js' ), array(), CUR_THEME_VER);
//    Contact Form JavaScript
    wp_enqueue_script('vc4g-bootstrap-validation', apply_filters( 'url_filter', '/assets/js/jqBootstrapValidation.js' ), array(), '1.3.6');
    wp_enqueue_script('vc4g-form', apply_filters( 'url_filter', '/assets/js/form.js' ), array(), CUR_THEME_VER);
    
//    wp_enqueue_script('vc4g-contact-form', WP_CONTENT_URL . '/js/contact_me.js', array(), '20160307');
//    Custom Theme JavaScript
    wp_enqueue_script('vc4g-vancouver',  apply_filters( 'url_filter', '/assets/js/vancouver.js' ), array(), CUR_THEME_VER);
    if (is_front_page() || is_home()) {
        wp_enqueue_script('vc4g-roundabout', apply_filters( 'url_filter', '/assets/js/jquery.roundabout.js' ), array(), CUR_THEME_VER);
    } else {
        wp_enqueue_script('vc4g-akordeon', apply_filters( 'url_filter', '/assets/js/jquery.akordeon.js' ), array(), CUR_THEME_VER);
    }

    wp_localize_script( 'vc4g-form', 'vc4g', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
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

include_once CUR_THEME_DIR . '/inc/post_types.php';
include_once CUR_THEME_DIR . '/inc/functions.php';
include_once CUR_THEME_DIR . '/inc/ajax.php';
include_once CUR_THEME_DIR . '/inc/admin-area.php';
include_once CUR_THEME_DIR . '/inc/dompdf.php';
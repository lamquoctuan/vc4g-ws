<?php
$currThemeData = wp_get_theme();
if (! defined('CUR_THEME_VER')) {
    define('CUR_THEME_VER', $currThemeData->get( 'Version' ));
}
if (! defined('CUR_THEME_NAME')) {
    define('CUR_THEME_NAME', $currThemeData->get( 'Name' ));
}
if (! defined('CUR_THEME_DIR')) {
    define('CUR_THEME_DIR', get_template_directory());
}
/*
echo '<pre>';
print_r( WP_CONTENT_URL . '/font-awesome/css/font-awesome.min.css');
print_r(CUR_THEME_VER);
language_attributes();
$siteUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
var_dump($siteUrl,$_SERVER);
echo '</pre>';

die();
*/
if (!function_exists('vc4g_m_fonts_url')) :
    /**
     * Register Google fonts.
     *
     * @since VC4G 2.0
     *
     * @return string Google fonts URL for the theme.
     */
    function vc4g_m_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Roboto font: on or off', 'vc4g-m')) {
            $fonts[] = 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Roboto Condensed font: on or off', 'vc4g-m')) {
            $fonts[] = 'Roboto Condensed:300italic,400italic,700italic,400,300,700';
        }

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'vc4g-m');

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
 **/
function vc4g_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('vc4g-m-font-awesome', WP_CONTENT_URL . '/font-awesome/css/font-awesome.min.css', '4.2.0');
    wp_enqueue_style('vc4g-m-bootstrap', WP_CONTENT_URL . '/css/bootstrap.min.css', '3.3.4');
    
    wp_enqueue_style('vc4g-m-fonts', vc4g_m_fonts_url());
    // Load our main stylesheet.
    wp_enqueue_style('vc4g-m-style', WP_CONTENT_URL . '/themes/vc4g-m/css/styles.css');
    
    // jQuery
    wp_enqueue_script('vc4g-m-jquery', WP_CONTENT_URL . '/js/jquery.js', array());
    // Bootstrap Core JavaScript
    wp_enqueue_script('vc4g-m-bootstrap', WP_CONTENT_URL . '/js/bootstrap.min.js', array());
    // Plugin JavaScript
    wp_enqueue_script('vc4g-m-jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array());
    wp_enqueue_script('vc4g-m-responsive-tabs', WP_CONTENT_URL . '/js/responsive-tabs.js', array(), CUR_THEME_VER);
    
    // Contact Form JavaScript
    wp_enqueue_script('vc4g-m-bootstrap-validation', WP_CONTENT_URL . '/js/jqBootstrapValidation.js', array(), CUR_THEME_VER);
    wp_enqueue_script('vc4g-m-form', WP_CONTENT_URL . '/js/form.js', array(), CUR_THEME_VER);
    
    // Custom Theme JavaScript
    wp_enqueue_script('vc4g-m-vancouver', WP_CONTENT_URL . '/js/vancouver.js', array(), CUR_THEME_VER);
    
    wp_localize_script( 'vc4g-m-form', 'vc4g', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('wp_enqueue_scripts', 'vc4g_scripts');

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
?>
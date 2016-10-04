<?php
$currThemeData = wp_get_theme();
if (! defined(CUR_THEME_VER)) {
    define(CUR_THEME_VER, $currThemeData->get( 'Version' ));
}
/*
echo '<pre>';
print_r( WP_CONTENT_URL . '/font-awesome/css/font-awesome.min.css');
print_r(CUR_THEME_VER);
language_attributes();
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
    wp_enqueue_style('vc4g-m-style', WP_CONTENT_URL . '/css/styles.css');
    
    // jQuery
    wp_enqueue_script('vc4g-m-jquery', WP_CONTENT_URL . '/js/jquery.js', array());
    // Bootstrap Core JavaScript
    wp_enqueue_script('vc4g-m-bootstrap', WP_CONTENT_URL . '/js/bootstrap.min.js', array());
    // Plugin JavaScript
    wp_enqueue_script('vc4g-m-jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array());
    wp_enqueue_script('vc4g-m-responsive-tabs', WP_CONTENT_URL . '/js/responsive-tabs.js', array(), CUR_THEME_VER);
}

add_action('wp_enqueue_scripts', 'vc4g_scripts');

?>
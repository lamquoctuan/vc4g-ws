<?php
$appMode = false;
if (isset($_SERVER['APP_MODE']) && $_SERVER['APP_MODE'] == 'debug') {
    $appMode = true;
}
// Enable WP_DEBUG mode
define('WP_DEBUG', $appMode);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

define( 'WP_CONTENT_FOLDERNAME', 'assets' );
define( 'WP_CONTENT_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/' . WP_CONTENT_FOLDERNAME );
define( 'WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME );
define( 'UPLOADS', WP_CONTENT_FOLDERNAME . '/images');
?>
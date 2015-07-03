<?php
define('WP_HOME','http://staging.vancouvercashforgold.com');
define('WP_SITEURL','http://staging.vancouvercashforgold.com');
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vc4g');

/** MySQL database username */
define('DB_USER', 'vc4g');

/** MySQL database password */
define('DB_PASSWORD', 'vc4g');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~`)-x#Q=Lxy/ZfUVZ#mF/w&F2l+Im7>i~8t<%cCbOBNh!JQ@{Mx/SrWUwv.%QE_2');
define('SECURE_AUTH_KEY',  'DsV|CB:T[F0G+,erY2wb];dUEhnq^lVU6Ktw&&%YG1EW 96t4*Sr|  Ti=er2AAZ');
define('LOGGED_IN_KEY',    'rl5b]P3]H5Eu,@qz6y;7hj`AR</H`>)qsSyc+=Rw>K>V!VWW]O=,.l`%k!CY*.pE');
define('NONCE_KEY',        '@osY`/keM9{ G}.202T|z7Av tBNMj;1[^2`!O+kk>v8y#aW>qN+pUESVD:k<3k+');
define('AUTH_SALT',        ' l*YiF}XfW&euUUA(-Jo(i@EP-e+G&?Ue/,1t3TrB?GT_$D/EHp/|oS[bT],A&H@');
define('SECURE_AUTH_SALT', 'ryQ/Zf+5N89^=ow*9f)WHR*Ff2Nl.fBd|7dN gb<XYw#p.-y8U,`&hamP[m5wQX$');
define('LOGGED_IN_SALT',   'f=udS5U+&jVc)`aJL8Mf8dKW]hv7)L6Q-t~UaXF}pW,NLTn15!rm|~yO&P];knim');
define('NONCE_SALT',       '[^+-d,T;^`CcQ|:|[3BD^f5#XrYm,Qc>r6M,pJ<VNsWQ#.7|e(e+NOPvx8!;!Z}|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define( 'WP_CONTENT_FOLDERNAME', 'assets' );
define( 'WP_CONTENT_URL', '//' . $_SERVER['HTTP_HOST'] . '/' . WP_CONTENT_FOLDERNAME );
define( 'WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME );
define( 'UPLOADS', WP_CONTENT_FOLDERNAME . '/images');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

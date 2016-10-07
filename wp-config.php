<?php


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

/*Protocol define*/
if (($_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] == 'https') || ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
    $_SERVER['HTTPS']='on';
}

// ** MySQL settings - You can get this info from your web host ** //
if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == 'eb') {
    include_once('config/db-rds.php');
}
else {
    include_once('config/db-local.php');
}



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


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/*Customization*/
if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == 'eb') {
    include_once('config/main.php');
}
else {
    include_once('config/main-local.php');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

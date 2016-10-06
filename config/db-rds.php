<?php
/** The name of the database for WordPress */
define('DB_NAME', $_SERVER['RDS_DB_NAME']);

/** MySQL database username */
define('DB_USER', $_SERVER['RDS_USERNAME']);

/** MySQL database password */
define('DB_PASSWORD', $_SERVER['RDS_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_SERVER['RDS_HOSTNAME']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

?>
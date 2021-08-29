<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'WjQzHTFSqyWLyHrMT6gMk9H8Sgyz/ibnfn4LwjzFoTmPZgGaIDcg2dRHixavKUehMjOj4O2X7m1PDg8dCqc+qA==');
define('SECURE_AUTH_KEY',  'UR/dGpB6LHYjrSC261kL9gu1WHGgj8Li2sZ8xUGyCAFA0LHEKDqD7M49raLziqDTyMzQ24G+cDg4aMkT9+gl+Q==');
define('LOGGED_IN_KEY',    'GA+I9q5sOyxn27ac9STET7kf570waZ5M5BpRK3DsI9nvR1SwvyHl0ASOzIVdQlY57PfsPkkoWuVvdzMZlSEHFQ==');
define('NONCE_KEY',        'g/vB3tNt2KGwhx17zJS6Ra2gWyA6WEivB2o6/ESbwBjteLFfvCmT5nNkK7hvAUdBlkRRSZn8mOkHwKaiSig8vw==');
define('AUTH_SALT',        'M06uddvyHHxAv5z9oFm7jZgRIN/f73d1BrbEZc1u0KtMRbUqy0X4ejcKdSzIx3b8Dj3CkfTbg1/oDkvKu/WBqQ==');
define('SECURE_AUTH_SALT', '/8RJDcajNnNUgA4SaDs1VsPmHFpiuVIP9nztILZ7NyJlB2VHjHJ5mHDsLjlXydza+VxR6XexTXyzP0Hm+6tfaA==');
define('LOGGED_IN_SALT',   'd25mCitw5CtG00rlUfwNLW2QZ9EGAPx8NaiGWfvCmiWhN5NvDCDiHdBO46tYLA+gJLb7bKZso+7YqAWnqL4vhg==');
define('NONCE_SALT',       'AI7r1+vmuCYqqYE7/sTWrqobNIvhuJH8fHhdD9Dg6crKrAvkpTpMkvf5yFHZ0fuoPUBKAwS/oFC5XzH+xXzdIg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

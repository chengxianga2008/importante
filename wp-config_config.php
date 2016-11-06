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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'importante');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/                                                                                                                                                 1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies.                                                                                                                                                  This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'QMRqvza1uiF0rTNb7DubMyJZFDjEoL3ImywdXOzS2fgQo9EXqKjP                                                                                                                                                 6SQpYSUIXR0E');
define('SECURE_AUTH_KEY',  'Uu87IwSGjLeqmneb3Kq6hKYz0Drvi1zo9cIDIJZxlmkFuqVUdgEf                                                                                                                                                 x3ntZA5JSVld');
define('LOGGED_IN_KEY',    'l6EsguiNzUKKchFIVUHHrIM3wRuX0W7IYstIJWiu7VNzF1Puk2KL                                                                                                                                                 hfQwbUWeLsHj');
define('NONCE_KEY',        'LUdHBLon9Gb26zx67YOuMCXvEGjSiOKenwiUFguykQnj1TKgqGmB                                                                                                                                                 tAvYQkUfTnhl');
define('AUTH_SALT',        'e96YMeLux5diy4m5aMp6Q1PbvQdK6Fe9RBSWNdqQpmIgqUG5pNqE                                                                                                                                                 7yy9FQvWUj8g');
define('SECURE_AUTH_SALT', '5OmisKnUcCctLPENR6KhdSYE1ZmtKRgLZEbJbiseZbWrcKeGyWQf                                                                                                                                                 e5tQqJzturex');
define('LOGGED_IN_SALT',   'bUymdvTJ0dEIWvLDh4IfGDNV9tjpHv2TagKri1Inp7Fv2lfH7Yrn                                                                                                                                                 MUy1mPnSLke5');
define('NONCE_SALT',       'GAnbHqXbxm0tpSuErk5A8DoVJGehLu5ahVfIm4NtYciwOfGKSyiV                                                                                                                                                 Rxa0Er2MCf0T');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',                                                                                                                                                 0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

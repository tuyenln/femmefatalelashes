<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ebluesto_fem');

/** MySQL database username */
define('DB_USER', 'ebluesto_fem');

/** MySQL database password */
define('DB_PASSWORD', '123@123a');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('WP_HOME','femmefatalelashes.ebluestore.com');
define('WP_SITEURL','femmefatalelashes.ebluestore.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cXXodcmlFgPq2yU9TAv7yB4Ra7qAmy30Ksgg3R2hPalI1m8aWgiccNYUyaptN65I');
define('SECURE_AUTH_KEY',  '4NW1Cas0DGV9bZGm1v55M1tfxmlPj7vHaSq8dVeOjKqVrA651JC3svRBWVHzlDcT');
define('LOGGED_IN_KEY',    'VRe2okO98T3yWZf0wien2vn7wG4jn7uhGeGAmbQ969pk8ToDMeiA8UmtNLvzh0zG');
define('NONCE_KEY',        'ugjNhima5olSMzpfhhoxFfhRof5uvERt7YQTWwG7I8s12owAKsxx9tgisL2tXbIy');
define('AUTH_SALT',        '15ZPK3sLCNx1vdPektPxhUH0fyJf6ZnE6KNIa0ISIsTALwKVKvDUEfGzfaqEwuuA');
define('SECURE_AUTH_SALT', 'p5JrmiWQoT3LMScZ5YH4UFRh4djsxkrbpJBdqTV6IHKyQkaVosGPO7fDrZ2TogiN');
define('LOGGED_IN_SALT',   'abFQZLysVvHlzAoloLyt9A8gBtsrzUl6i4kjLD2LHRBlywdkD0xbUYQy69Wrevya');
define('NONCE_SALT',       'fcXJEmpY2B4VtozyY0cLD5rHVuAZQtOifMWmVrYq4rPa7aS8IcWTwmeWcZfETQFB');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

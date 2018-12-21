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
define('DB_NAME', 'laptri_blog');

/** MySQL database username */
define('DB_USER', 'lapak_trip_blog');

/** MySQL database password */
define('DB_PASSWORD', 'blog123');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '{KU8cCYF)0h#mur(f>;@,dow4b%2]V4%dYFxbA])_1H6|nxQRWbn6tse_p,QA76!');
define('SECURE_AUTH_KEY',  'gO>nT|;XbZ4z.z%d4::jrT4g#{&apY&qJYz7vp<&&/f)JF&$T; ie:hZw#tIl+O3');
define('LOGGED_IN_KEY',    '+%JV$KlO1mtaKC:UZ{wWrNNh/9v9RC~1&mr#b _[JguN@? >#T_My^>NTY~T$~.L');
define('NONCE_KEY',        'WY`=_9q}:9IH)K$<h.-O3cDHR;^gvL+;%_w/:G#9TLpcDURg~^:i&jQ@mqM:&PP`');
define('AUTH_SALT',        'uHj<y OH(/2m-h@  +Gc-XMDv/.3A#iwZT&9/XX<P[~+Ct>a3$~k)A}9./{~gl*j');
define('SECURE_AUTH_SALT', ' u<3[0+Smmj[dAdbIwU>tHI-Q-o~i{}8QkLu8 t=)m_zZHrS@Rc0>:1IPk_aR98u');
define('LOGGED_IN_SALT',   'CXN]kOLu`Sw 4X!1t_v(_Zu>v=kJxJOWILB%/t/FQO|$JDUW| 5>Q@6}8asXkI%=');
define('NONCE_SALT',       ',ped|MS.v,6HN):Z)zm@;b,:V2Fcf#HsMBn@3>zm:|Cz!bL%Pi2XJ2QBtmdr?eM6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'laptri_';

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

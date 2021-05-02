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
define( 'DB_NAME', 'arsenal.dv' );

/** MySQL database username */
define( 'DB_USER', 'roti' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '![9 {KoN.!svI0XDs0KSaXtbvNUgw}&7v|B:Y:+6,+Q88pTl!%L,hQku=CTI/X9x' );
define( 'SECURE_AUTH_KEY',  'chcD(,2xH[6d;D}ek%.O&/si eLqPRzz?fO1q:W+m4dAdT~9y/oXIJaI2+_<5_hz' );
define( 'LOGGED_IN_KEY',    'zWNo pA!63Oj2L)nR|98Y0oGP+S#Y{ky`byP$GU@KH5]fq(XmzlOsvO+E2n- wuX' );
define( 'NONCE_KEY',        '[L)(.[!G*&KLt8QhwN5pYcMR ;l|:zli>,/xd_&.v$)RagV~/Ge^xm.oBp.zU%c!' );
define( 'AUTH_SALT',        '*Wlq.Lr5B#oZ=C=XmZ?}{NBSHn}E)aIF+d&ev;/kj34|QT27{Aq79K]PG,#z&t1F' );
define( 'SECURE_AUTH_SALT', 'Z,4sF;Q)*Z4J_MYQ!S&b2!hMlJ[md_)* rl}Su*kt>]nyL?=a|;?i`bkI!t*-RHd' );
define( 'LOGGED_IN_SALT',   'v.z^2u_*L7B|bJLD:qW> Q6jx%QK0J AJ}MnT)PICC_|8TnAiyeXUabz qs!Wcr|' );
define( 'NONCE_SALT',       'I5Mv!mN!JmCCv*@>@8q7X:*W)A>WbSE;[2zv*tx~o7=B{y[+1rd3GkR9kq];j46J' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

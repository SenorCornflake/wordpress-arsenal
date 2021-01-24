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
define( 'AUTH_KEY',         'tkm+% DJ-<pYy<I,/p-XboLJdow13t`xeNfRz3I:`cX#-B`+&{5o7pE_A4%+~n(#' );
define( 'SECURE_AUTH_KEY',  '[M|WS/T>yD`K:{Jg&#kg(IROn;&p}<y:B[Tz*]r0`wD&WGd&BS_Hp!wm|TX(~giB' );
define( 'LOGGED_IN_KEY',    '.Mg}k5egSQT//v5Ejj=rEAf|i.ll3V;m([=o=U!cDl8#VVh`J`wh)$#~T{]7PL}7' );
define( 'NONCE_KEY',        '65t^-%lz8IWm>.x06A,aK$i6Gg)E&to[$v3DuG|[Lwg3H2>HZzW_PH/Qty7~Cskv' );
define( 'AUTH_SALT',        '^LYzdlm*n}{7VI<1,s%Q&vAFllL%Ph]%r utU<qKgtnA8R)d$)cg?1Jlh(S[I>&r' );
define( 'SECURE_AUTH_SALT', 'yUX`K1apa|$H.h f9~&AEMa<W,wh]|$jX:uZXnHY>K$?ImGA;eRFp3G^S9QM_M#=' );
define( 'LOGGED_IN_SALT',   'lI0U us;-gT/0oV(g#&}Fv4x`7#SFW8,NKmiw;CoHteSg]#maDhJacg;81|~H&Yg' );
define( 'NONCE_SALT',       '0eQ*:YgM;>iSe8SY&G`mMBb(X?drHI}d9o[QRXh <,`gLR{lJ=J4+dW0qF@hW|?!' );

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

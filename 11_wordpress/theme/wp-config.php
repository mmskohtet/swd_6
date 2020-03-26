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
define( 'DB_NAME', 'swd6_wp_theme' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '6g_f* _C!:b1|?9C9q.I^T/To4s]`*nw$ikB|~^3Lw6%(cDB<yf-omg3%X_eyW0?' );
define( 'SECURE_AUTH_KEY',  'K,dtL?q^OLeWXl:A=H8TbJ5~-wq<bR#Vd#KQLMaVKH V+H5}j*dUqEay~w%w?EQE' );
define( 'LOGGED_IN_KEY',    'XXr]fR+1s((dIAgb)!4tvs^H8V0<hE@rOzne0l^gAs!1@rF?Dc`V5j[Vf-f{SpLn' );
define( 'NONCE_KEY',        'x86T<I?n4~d!lSe[^ .B2m=u9!WA>nni4PV*XZG7=u6e{>n7-bQ!FLw|d&KZM_xj' );
define( 'AUTH_SALT',        ' }Y@Am8m7bHN.N{OjTWH/[5y|kXQ$ArbG~UaYk8wf{}|7Oql <VA:*_0-_*tuSY=' );
define( 'SECURE_AUTH_SALT', '*{fJOq$gE8#;k@&gl&;k8vtAELCi0PN;rl>i1ET[Z{6,#F6O0XT]8<]3Vtu8;1 3' );
define( 'LOGGED_IN_SALT',   'Bi=K?p{u@=sN?W4>[3Z(h[Bat_X0n5AKihg.-gEKYa=aO%9la;nbzqE`}$@cBLH<' );
define( 'NONCE_SALT',       '/g);&d#:zsn/T6S1i+=$Vq[zxLvLzOd>^qWsvlv|QDNk.<!G~Noau9#_69q2/%}S' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

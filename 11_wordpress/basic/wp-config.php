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
define( 'DB_NAME', 'swd6_wp_basic' );

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
define( 'AUTH_KEY',         'wmT-U!jY5`mZ.27#1*k(zGYb`gtdQwYd[4g%aowVM*4PnA>V#U3Tv3Jto1]IBr}5' );
define( 'SECURE_AUTH_KEY',  'OiO.a,?X_Vc3)egaoN3uN12Q[ty[ap,+G|td^JKD2U/:oW]&_$?&*AF;F7)FYr9t' );
define( 'LOGGED_IN_KEY',    'XrdEMS$VVw#Y&6aAFVsgESw`xe(:EDfM2WOE6X_JdKU7+&pSfFTR#<k_%$pB&^o<' );
define( 'NONCE_KEY',        '9;n@/O A4U4QlK6]=LFFJ8k=$7{PAV2-HI,*@6L;Gvju?=)!op&F.KCC21MfWQt3' );
define( 'AUTH_SALT',        '&Ph/]u.U7Vw:@BNS3EW6U:eL)M&&1@-($/Yx*s<qA)]i,hcaOKk#X5ia[/Sz/xX#' );
define( 'SECURE_AUTH_SALT', 'PTA{l ,1(rz3:E[4=nBL8Y7eS8TpSI]MR<]f04d-3u2IUcV+DuB8my}Cs-|Y+=*V' );
define( 'LOGGED_IN_SALT',   '>!Bl#a-W7chMC>)Ck7wVbBXZ%OL!4}s&SfG.DXm>8l)}c5_C!*AVX:%}kEE<6cU(' );
define( 'NONCE_SALT',       't%zJVaNC(?cpC({e/p|fFda)= @>EofBz?VZ~u>$.5vgb}ZMk$J AbezR1!0IiV?' );

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

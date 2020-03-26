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
define( 'DB_NAME', 'swd6_wp_plugin' );

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
define( 'AUTH_KEY',         'PD6+so3#-myJvB4m*aTGP=A0!^-&V-M![}J.q{9lef%f<rq-8-MyEP*$#;9V.5,j' );
define( 'SECURE_AUTH_KEY',  '08hk+0pfy!><.wieE6_w&jIs)_Tx3b,0<}t6@3+AU~Vyc@/ZN7Fz|W@7L*=!@fc5' );
define( 'LOGGED_IN_KEY',    '4Q}+KG_qb%;ui&ov(;({#LD}<Y-QwZp&($-IiXBO*`Id);wrra[`3+XkK[r}aWS*' );
define( 'NONCE_KEY',        '4^0VQ/Bz1amridh#!MOT5y3.Xm1#lDJG]^!Qs?g/Ib@dtc+#Umrw7BDd3k*tXUd5' );
define( 'AUTH_SALT',        ')csOFm(%kp&q6RCbjbz`(iM0K7twUb)r9H!fO3f a+C!Mx45_PF5WP621x#jrso-' );
define( 'SECURE_AUTH_SALT', 'MkB3Mfx|i1{Hz0X*:TN/=`p|akYzWB+I#R8/E>d3kj2,l=4&H{7g1/1R>Nf=lhnH' );
define( 'LOGGED_IN_SALT',   'A7 ^sIwV=gD]sQu?;+M.*aG*H c; ||+;m]N{FE9TE$O9c27 tH^7NmJ(QR+V?qG' );
define( 'NONCE_SALT',       'qPt7D[|<6R/Sb/*yc<x^;k%%3_-@(V#=o3K!DNeQNT$*R?dM3Ud{6&43sr$-oA35' );

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

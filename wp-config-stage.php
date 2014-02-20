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
define('DB_NAME', 'wordpress_portfolio_stage');

/** MySQL database username */
define('DB_USER', 'thibautdelille');

/** MySQL database password */
define('DB_PASSWORD', '4g3ou2ld');

/** MySQL hostname */
define('DB_HOST', 'mysql.thibautdelille.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         ';G#bA;+%MNkmphKj[KB>iA8|OX$A&v+8rFQp[9Onkq]e7W63.ob@vu+e+e<gPE&%');
define('SECURE_AUTH_KEY',  '|VwqGED{47 26SkkzhwmgZ%X%.[d1D?Q%xeW,>cTh..Ru-MuLX.NETCM/s8M^ZwF');
define('LOGGED_IN_KEY',    'u6xorx} 0XtM &$sHi:}dS0N-(OU AM5ULB-IPnm`gxWMfT+^orq!hEAEKR58;}q');
define('NONCE_KEY',        'S6-e.06w>4KD;Ni%5kH0D8?{3`-*%U#IKk-tBT?5$VA:gB0;n#+8LYCkXSqguzOz');
define('AUTH_SALT',        'F#[1dRtwkTpt,=.izZP `uM^^anzq*d^gmK6&9|hK$0Ri{B# !(.GE|<y,54nq1X');
define('SECURE_AUTH_SALT', 'Z_Fq:3:%TKgSk0WA65+@m,fDzVXd,G1Lc)$)2fZyZ*C&RWX[nd*;H{kI93yHp^r1');
define('LOGGED_IN_SALT',   'XF|-A{%+Tn|;F/c~eAL,i-|1~(,O%F<Ev+F7h3)`=^50uj]0Z +tB-D^Pfn|B&oO');
define('NONCE_SALT',       'q$+uYF(4Bq{mPH;E++_s0,f-$u7rYa;1%YE-d4qb_+Oulun$}/_lMWLe*?->iI&)');

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

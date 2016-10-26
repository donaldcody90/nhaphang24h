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
define('DB_NAME', 'db_nhaphang24h');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ',0!k6=?>PJA~/!;v:n},JtEDR8kTYS<[DMB-?KQ2:9wsAdHi.V!w 5KA[{iX0)FS');
define('SECURE_AUTH_KEY',  '9*=n)`H]Y4aQWbJG9gDFDn#RC6rohMvZB!f[C#?ZI`ESzt:;EYaKD>096k)7io#-');
define('LOGGED_IN_KEY',    'K6xm~|}qftlCFY9&rfuOKl.:[x(4I90pUubk6+U6L34bLCy3JA4LOCl_.kZJy7<9');
define('NONCE_KEY',        'NhAc8-Y:o{+<C93dn3ID;1L3(_)]dAf.:W@5Az(.po|vELe[840I@4&2r4d4H4h/');
define('AUTH_SALT',        'h[#Dao5`b!$vC}f16&tv5F+?rnsC2+kCu(zV&n#oqS%^=mXry]3_Hha0;_ZQB^dv');
define('SECURE_AUTH_SALT', 'Os[FGwD$_Lwyxhdr6ABEw,iz`VU^F~!j}mS*.tEg22qV9p<i=<4.?bJ@Je/oe(!d');
define('LOGGED_IN_SALT',   'W6xVIHPc|{ukRHfkUTP~i8mqH[{Gdub+!nsrY:&V1~|wJcC]1,l23:-MjlL8Y^cI');
define('NONCE_SALT',       't@&.0sLBR:mv?ah<([pDOY_^3b*mY_ELA9|[9L#qB<LtnYsbRA^5D<~0g#2s)s`s');

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

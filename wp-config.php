<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'radiosamDBk196z');

/** MySQL database username */
define('DB_USER', 'radiosamDBk196z');

/** MySQL database password */
define('DB_PASSWORD', 'K6HEp2VMo2');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '8t{.<uMQ7^,niiP65~XbE{;+11-hkN#]wadGBB,rvc04@kNR{uXEE@jnQ772+*mX');
define('SECURE_AUTH_KEY',  '3XIIgMQ3$^aHH;+*XbE{uxt-dKO1lpWpW>vYcJ}|sZZG[B,uybI7^nnUB2+iiL2<');
define('LOGGED_IN_KEY',    '9SDH]wosYBF,dhK00zuubII^nnU7^2+iiP2<uXbE<~lOS5_xaH];-e@koV8[wZdG');
define('NONCE_KEY',        'EfQH]xxeL6*imP6:1~hkO_#taZDYYF>}zN00@gkfIMubM3$^jQJ}z@gN0|oVV8!3');
define('AUTH_SALT',        'BXI*_pSW9yxeHH;psVCC|ehO1-~vccJ}0oRV8N0MQ3$*iB,>vybWAD_ptLuxeD5');
define('SECURE_AUTH_SALT', 'Lqb:-dhO1_pSW9_8!knR4^sZGG}vnQ37^mBF>vvcTXA##tMM2+fi-hhO55pWW9_p!');
define('LOGGED_IN_SALT',   'RUfMujQ77,neL;2.#fMM2+f~llS58taiO15N44!ovKN4@!kjnQ77.cgN33^bbH;b');
define('NONCE_SALT',       'NgRV8!wdG[:w}nUJ0z$jMeH;2+eTMMyfS9_#tWL;++iOdK:0@gV9_ooVnrUBB,c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

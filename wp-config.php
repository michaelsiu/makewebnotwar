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

//Database=mwnwAqZIyBGzqseD;Data Source=us-cdbr-azure-east-c.cloudapp.net;User Id=b295931b7fdac6;Password=60368fcb
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
/*define('DB_NAME', 'mwnwAqZIyBGzqseD');
define('DB_USER', 'b295931b7fdac6');
define('DB_PASSWORD', '60368fcb');
define('DB_HOST', 'us-cdbr-azure-east-c.cloudapp.net');*/
//new db
/*define('DB_NAME', 'mwnwAqZIyBGzqseD');
define('DB_USER', 'b295931b7fdac6');
define('DB_PASSWORD', '60368fcb');
define('DB_HOST', 'us-cdbr-azure-east-c.cloudapp.net');*/
define('DB_NAME', 'mwnwaqziybgzqsed');
define('DB_USER', 'root');
define('DB_PASSWORD', 'iloveweb');
define('DB_HOST', 'localhost');/*define('DB_USER', 'dbadmin');
define('DB_PASSWORD', 'Crossbone$8');
define('DB_HOST', 'pagemii.com');*/
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_SITEURL', 'http://mwnw.cloudapp.net');
define('WP_HOME', 'http://mwnw.cloudapp.net');
//define('WP_SITEURL', 'http://www.webnotwar.ca');
//define('WP_HOME', 'http://www.webnotwar.ca');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'h8LfSzF-gGhr76y9[dyqGIK*qO(j12Z>q%/U4V->#LUIVD%{u]v${{-q]}hVw_{5');
define('SECURE_AUTH_KEY',  '<nnsnB*XkkCcwAl%SvULA>o[fAwrjC]&OR9UPpCvBShKJj,?)k.0H2HE@Ol?eGXO');
define('LOGGED_IN_KEY',    'c)G0tj3V+N6u7A+)K5N<Dc%pNXql!f6fuX(.Y,8r#|mF|czOR*oE34H9Q>DCSYUb');
define('NONCE_KEY',        '6AJOU=^d6w|!>y@d3^}3Pd8hAM|[CI?EsAQUM ]$1u`Nj|uV(CD0[}p{<E77:&eB');
define('AUTH_SALT',        'hJsBD=AQNzGtC%)Llr9%GZ!,3|UClv?:a%_<EH*tJQWEOo~%}+2Y|T+!=[u|z/{<');
define('SECURE_AUTH_SALT', 'kSdXY_m>B3+6BE&w{|H*(A-WTi=>:Yhj!vY+H!D~~WUaJ63- +W?fJ&/6Ui`ckzX');
define('LOGGED_IN_SALT',   'eycI,OMM-^+QOll6|>2,bNO?l%:6BD 3P1Vb^BR$Cm|F%+hn-BMhwp/g/gp#p^OL');
define('NONCE_SALT',       'HK|CBE!{RftZo9O|HNMm-iFYN,qp+-R:|]0sjv?c)A!8 Qe,km{jpMlz-O5!K*dZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wnw_2011_';

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
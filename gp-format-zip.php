<?php
/**
 * Plugin Name:       GP Format ZIP
 * Plugin URI:        https://blog.meloniq.net/gp-format-zip/
 *
 * Description:       GlotPress support for ZIP format download files.
 * Tags:              glotpress, download, format, zip, archive
 *
 * Requires at least: 4.9
 * Requires PHP:      7.4
 * Version:           1.1
 *
 * Author:            MELONIQ.NET
 * Author URI:        https://meloniq.net/
 *
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain:       gp-format-zip
 *
 * Requires Plugins:  glotpress
 *
 * @package Meloniq\GpFormatZip
 */

namespace Meloniq\GpFormatZip;

use GP;

// If this file is accessed directly, then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'GPZIP_TD', 'gp-format-zip' );


/**
 * GP Init Setup.
 *
 * @return void
 */
function gp_init() {
	global $gpzip_translate;

	require_once __DIR__ . '/src/class-format-zip.php';

	// Register the format with GlotPress.
	GP::$formats['zip'] = new Format_Zip();

	$gpzip_translate['format-zip'] = GP::$formats['zip'];
}
add_action( 'gp_init', 'Meloniq\GpFormatZip\gp_init' );

/**
 * Error logging.
 *
 * @param mixed $message The message to log.
 *
 * @return void
 */
function gp_error_log( $message ) {
	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
		return;
	}

	if ( is_array( $message ) || is_object( $message ) ) {
		error_log( print_r( $message, true ) ); // phpcs:ignore
	} else {
		error_log( $message ); // phpcs:ignore
	}
}

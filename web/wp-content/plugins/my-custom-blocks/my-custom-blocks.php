<?php
/**
 * Plugin Name:       My Custom Blocks
 * Description:       A collection of custom Gutenberg blocks.
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Author:            Your Name
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-custom-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register all custom blocks
 */
function my_custom_blocks_register_blocks() {
	register_block_type( __DIR__ . '/build/copyright-date' );
	register_block_type( __DIR__ . '/build/call-to-action' );
}
add_action( 'init', 'my_custom_blocks_register_blocks' );

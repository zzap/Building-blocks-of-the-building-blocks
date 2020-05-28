<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package wpcli-block
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function wpcli_plugin_block_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'wpcli-plugin-block/index.js';
	wp_register_script(
		'wpcli-plugin-block-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'wpcli-plugin-block/editor.css';
	wp_register_style(
		'wpcli-plugin-block-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'wpcli-plugin-block/style.css';
	wp_register_style(
		'wpcli-plugin-block-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'wpcli-block/wpcli-plugin-block', array(
		'editor_script' => 'wpcli-plugin-block-block-editor',
		'editor_style'  => 'wpcli-plugin-block-block-editor',
		'style'         => 'wpcli-plugin-block-block',
	) );
}
add_action( 'init', 'wpcli_plugin_block_block_init' );

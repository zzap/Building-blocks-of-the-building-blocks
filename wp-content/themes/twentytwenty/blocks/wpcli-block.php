<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package twentytwenty
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function wpcli_block_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = get_template_directory() . '/blocks';

	$index_js = 'wpcli-block/index.js';
	wp_register_script(
		'wpcli-block-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'wpcli-block/editor.css';
	wp_register_style(
		'wpcli-block-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'wpcli-block/style.css';
	wp_register_style(
		'wpcli-block-block',
		get_template_directory_uri() . "/blocks/$style_css",
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'twentytwenty/wpcli-block', array(
		'editor_script' => 'wpcli-block-block-editor',
		'editor_style'  => 'wpcli-block-block-editor',
		'style'         => 'wpcli-block-block',
	) );
}
add_action( 'init', 'wpcli_block_block_init' );

<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function biscuit_lite_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'biscuit_lite_jetpack_setup' );

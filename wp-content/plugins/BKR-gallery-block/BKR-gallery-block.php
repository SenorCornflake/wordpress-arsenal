<?php
/*
 * Plugin Name: BKR Gallery Block
 * Author: Baker
 * Description: Adds a better gallery block to gutenberg
 */

defined("ABSPATH") || die();

add_action("enqueue_block_editor_assets", function() {
	wp_enqueue_script(
		"bkr-gallery-block-editor-script",
		plugins_url("build/index.js", __FILE__),
		[],
		false,
		true
	);
});

add_action("wp_enqueue_scripts", function() {
	wp_enqueue_style(
		"bkr-gallery-block-block-styles",
		plugins_url("assets/css/block-styles.css", __FILE__),
		[],
		false,
		"all"
	);
	wp_enqueue_script(
		"bkr-gallery-block-block-scripts",
		plugins_url("assets/js/block-functionality.js", __FILE__),
		[],
		false,
		true
	);
});

// Register block
// add_action("init", function() {
// 	register_block_type(
// 		"bkr-gallery-block/gallery-block",
// 		[
// 			"script" => "bkr-gallery-block-editor-script"
// 		]
// 	);
// });

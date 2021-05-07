<?php
/*
 * Plugin Name: BKR Gallery Block
 * Description: Adds an image slider block to gutenberg
 * Author: Baker
 */

defined( "ABSPATH" ) || die;

// Keep this commented just in case I want to use it in the future
// function bkr_gallery_block_editor_assets() {
// }
// add_action( "enqueue_block_editor_assets", "bkr_gallery_block_editor_assets" );

function bkr_gallery_block_assets() {
	wp_enqueue_style(
		"bkr_gallery_block_styles",
		plugins_url( "src/css/block.css", __FILE__ ),
		[],
		false,
		"all"
	);
	wp_enqueue_script(
		"bkr_gallery_block_scripts",
		plugins_url( "src/js/block.js", __FILE__ ),
		[],
		false,
		"all"
	);
}
add_action( "enqueue_block_assets", "bkr_gallery_block_assets" );


function bkr_gallery_block_register() {
	$asset_file = include( plugin_dir_path( __FILE__ ) . "build/index.asset.php");
 
    wp_register_script(
        "bkr-gallery-block-editor-script",
        plugins_url( "build/index.js", __FILE__ ),
        $asset_file["dependencies"],
        $asset_file["version"]
    );

    wp_register_style(
        "bkr-gallery-block-editor-style",
        plugins_url( "src/css/editor.css", __FILE__ ),
		[],
        $asset_file["version"]
    );

 	register_block_type( "bkr-blocks/gallery-block", [
        "apiVersion" => 2,
        "editor_script" => "bkr-gallery-block-editor-script",
        "editor_style" => "bkr-gallery-block-editor-style",
		"render_callback" => "bkr_gallery_block_render_callback"
	] );
}

function bkr_gallery_block_render_callback( $attrs ) {
	// Gutenberg does not provide the default value of an attribute to the PHP callback for dynamic blocks.
	// Because of this, for example, I have to test if indicators are disabled instead checking if they are enabled.
	// Just for future reference.


	// Keep this here for future debugging
	// ob_start();
	// echo "<pre>";
	// var_dump( $attrs );
	// echo "</pre>";
	// return ob_get_clean();
	
	// Default attribute values
	$images          = ( isset( $attrs["images"] ) )          ? $attrs["images"]          : [];
	$button_location = ( isset( $attrs["button_location"] ) ) ? $attrs["button_location"] : "image";
	$thumbnails      = ( isset( $attrs["thumbnails"] ) )      ? $attrs["thumbnails"]      : "none";
	$indicators      = ( isset( $attrs["indicators"] ) )      ? $attrs["indicators"]      : "bullet";
	$fullscreen      = ( isset( $attrs["fullscreen"] ) )      ? $attrs["fullscreen"]      : false;
	$interval        = ( isset( $attrs["interval"] ) )        ? $attrs["interval"]        : 0;
	
	// Even though I set the default background in "index.js", I prefer having one here also, just in case.
	$default_overlay_background   = "rgba(0, 0, 0, 0.20)";
	$default_overlay_text_color   = "rgba(255,255,255,1)";

	$default_overlay_text_position     = "bottom_left";

	$prev_button = '<button class="bkr-gallery-block-prev-btn">&larr;</button>';
	$next_button = '<button class="bkr-gallery-block-next-btn">&rarr;</button>';

	$html  = '<div class="bkr-gallery-block" data-fullscreen="' . (( $fullscreen ) ? "true" : "false") . '" data-amount="' . sizeof( $images ) . '" data-interval="' . $interval . '">';
	$html .= '<div class="bkr-gallery-block-container">';
	$html .= '	<div class="bkr-gallery-block-images">';

	foreach ( $images as $image ) {
		$html .= '<div class="bkr-gallery-block-image-container">';
		$html .= '<img src=' . $image["object"]["url"] . '>';

		// Only if overlay text was provided
		if ( strlen( $image["overlay_text"] ) > 0 ) {
			if ( !empty( $image["overlay_background"] ) ) {
				$overlay_background = 'rgba(';
				$overlay_background .= $image["overlay_background"]["rgb"]["r"] . ",";
				$overlay_background .= $image["overlay_background"]["rgb"]["g"] . ",";
				$overlay_background .= $image["overlay_background"]["rgb"]["b"] . ",";
				$overlay_background .= $image["overlay_background"]["rgb"]["a"] . ")";
			} else {
				$overlay_background = $default_overlay_background;
			}
			if ( !empty( $image["overlay_text_color"] ) ) {
				$overlay_text_color = 'rgba(';
				$overlay_text_color .= $image["overlay_text_color"]["rgb"]["r"] . ",";
				$overlay_text_color .= $image["overlay_text_color"]["rgb"]["g"] . ",";
				$overlay_text_color .= $image["overlay_text_color"]["rgb"]["b"] . ",";
				$overlay_text_color .= $image["overlay_text_color"]["rgb"]["a"] . ")";
			} else {
				$overlay_text_color = $default_overlay_text_color;
			}
			$overlay_text_position = ( strlen( $image["overlay_text_position"] ) > 0 ) ? $image["overlay_text_position"] : $default_overlay_text_position;

			$overlay_styles = 'style="';
			$overlay_styles .= 'background: ' . $overlay_background . ";";
			switch ($overlay_text_position) {
				case "top_left":
					$overlay_styles .= "justify-content: flex-start;align-items:flex-start;";
				break;
				case "top_center":
					$overlay_styles .= "justify-content: center;align-items:flex-start;";
				break;
				case "top_right":
					$overlay_styles .= "justify-content: flex-end;align-items:flex-start;";
				break;
				case "bottom_left":
					$overlay_styles .= "justify-content: flex-start;align-items:flex-end;";
				break;
				case "bottom_center":
					$overlay_styles .= "justify-content: center;align-items:flex-end;";
				break;
				case "bottom_right":
					$overlay_styles .= "justify-content: flex-end;align-items:flex-end;";
				break;
				case "middle_left":
					$overlay_styles .= "justify-content: flex-start;align-items:center;";
				break;
				case "middle_center":
					$overlay_styles .= "justify-content: center;align-items:center;";
				break;
				case "middle_right":
					$overlay_styles .= "justify-content: flex-end;align-items:center;";
				break;
			}
			$overlay_styles .= '"';
			
			$overlay_text_styles = 'style="';
			$overlay_text_styles .= "color: " . $overlay_text_color . ";";
			$overlay_text_styles .= '"';

			$html .= '<div class="bkr-gallery-block-image-overlay" ' . $overlay_styles . '><span ' . $overlay_text_styles . '>' . $image["overlay_text"] . '</span></div>';
		}

		$html .= '</div>'; // .bkr-gallery-block-image-container
	}

	if ( $button_location == "image" ) {
		$html .= $prev_button;
		$html .= $next_button;
	}
	$html .= '</div>'; // .bkr-gallery-block-images

	// Thumbnails
	if ( $thumbnails != "none" ) {
		$html .= '<div class="bkr-gallery-block-thumbnails ' . $thumbnails . '">';

		foreach ( $images as $image ) {
			$image = $image["object"]["sizes"]["thumbnail"];
			$html .= '<img src="' . $image['url'] . '">';
		}

		$html .= '</div>'; // .bkr-gallery-block-thumbnails
	}

	// Indicators
	if ( $indicators != "none" ) {
		$html .= '<div class="bkr-gallery-block-indicators">';

		if ( $indicators == "bullet" ) {
			if ( $button_location == "indicators" ) {
				$html .= $prev_button;
			}
			for ( $i = 0; $i < sizeof( $images ); $i++ ) {
				$html .= '<span class="bullet">•</span>';
			}
			if ( $button_location == "indicators" ) {
				$html .= $next_button;
			}
		} elseif ( $indicators == "number" ) {
			if ( $button_location == "indicators" ) {
				$html .= $prev_button;
			}
			for ( $i = 1; $i <= sizeof( $images ); $i++ ) {
				$html .= '<span class="number">' . $i . "</span>";
			}
			if ( $button_location == "indicators" ) {
				$html .= $next_button;
			}

		}
		
		$html .= "</div>"; // .bkr-gallery-block-indicators
	}

	$html .= '</div>'; // .bkr-gallery-block-container

	if ( $fullscreen ) {
		$html .= '<button class="bkr-gallery-block-close-btn">x</button>';
	}

	$html .= '</div>'; // .bkr-gallery-block
	return $html;
}

add_action( "init", "bkr_gallery_block_register" );

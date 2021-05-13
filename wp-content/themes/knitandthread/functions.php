<?php

class KAT_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth > 0 ) {
			$output .= '<ul>';
		} else {
			$output .= '<ul>';
		}
	}
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$tabindex = "";

		if ( $args->walker->has_children ) {
			$output .= '<li class="dropdown">';
			$tabindex = ' tabindex="0" ';
		} else {
			$output .= "<li>";
		}

		$href = "";

		if ( strlen( $item->url ) > 0 && ! $args->walker->has_children ) {
			$href = ' href="' . $item->url . '"';
		}

		$output .= "<a". $tabindex . $href . ">" . $item->title . "</a>";

		// echo "<pre>";
		// ob_start();
		// var_dump($args);
		// echo htmlspecialchars(ob_get_clean());
		// echo "</pre>";
	}
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= "</li>";
	}
    public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= "</ul>";
	}
}

// Use a class to prevent polluting the public namespace
class KAT_Theme {
	public function __construct() {
		add_action( "wp_enqueue_scripts", [ $this, "enqueue" ] );
		add_action( "after_setup_theme", [ $this, "register_nav_menus" ] );
		add_action( "after_setup_theme", [ $this, "register_contacts_zones" ] );
	}

	public function register_nav_menus() {
		register_nav_menus( [
			"primary" => "Primary menu located in the header"
		] );
	}

	public function register_contacts_zones() {
		BKR_Contacts::register_zone("header", "Header");
	}

	public function enqueue() {
		wp_enqueue_style(
			"kat-styles",
			get_template_directory_uri() . "/style.css",
			[],
			false,
			"all"
		);
		wp_enqueue_script(
			"kat-menu-toggle",
			get_template_directory_uri() . "/js/menu-toggle.js",
			[],
			false,
			true
		);
	}
}

new KAT_Theme();

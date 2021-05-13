<?php

// Use a class to prevent excessive pollution of the public namespace
class KAT_Theme {
	public function __construct() {
		$this->enqueue();
	}

	public function enqueue() {
		wp_enqueue_style(
			"kat-styles",
			get_template_directory_uri() . "/style.css",
			[],
			false,
			"all"
		);
	}
}

new KAT_Theme();

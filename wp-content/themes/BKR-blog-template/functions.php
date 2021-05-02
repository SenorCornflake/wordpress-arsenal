<?php

class BKR_Blog {
	public function __construct() {
		add_action("wp_enqueue_scripts", function() {
			wp_enqueue_style(
				"bkr_blog_main",
				get_template_directory_uri() . "/assets/css/main.css",
				[],
				false,
				"all"
			);
			wp_enqueue_script(
				"bkr_blog_main",
				get_template_directory_uri() . "/assets/js/main.js",
				[],
				false,
				true
			);
		});
	}
}
new BKR_Blog();

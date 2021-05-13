<?php
/*
 * Plugin Name: BKR Post Series
 * Author: Baker
 * Description: Adds a series taxonomy which is helpful for splitting long posts
 */

class BKR_Post_Series {
	public function __construct() {
		add_action( 'init', [$this, 'create_taxonomy'] );
	}

	public function create_taxonomy() {
		$labels = array(
			'name'              => 'Series',
			'singular_name'     => 'Series',
			'search_items'      => 'Search Series',
			'all_items'         => 'All Series',
			'parent_item'       => 'Parent Series',
			'parent_item_colon' => 'Parent Series:',
			'edit_item'         => 'Edit Series',
			'update_item'       => 'Update Series',
			'add_new_item'      => 'Add New Series',
			'new_item_name'     => 'New Series Name',
			'menu_name'         => 'Series',
		);
		
		$args = [
			"labels" =>             $labels,
			"description" =>        "Group posts as a series",
			"public" =>             true,
			"publicly_querable" =>  true,
			"hierarchichal" =>      false,
			"show_ui" =>            true,
			"show_in_menu" =>       true,
			"show_in_nav_menus" =>  true,
			"show_in_rest" =>       true,
			"rest_base" =>          "series",
			"show_tagcloud" =>      false,
			"show_in_quick_edit" => true,
			"show_admin_column" =>  true,
			"capabilities" =>       ['manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'],
			'rewrite' =>            array( 'slug' => 'series' ),
			"query_var" =>          "series",
		];

		register_taxonomy( 'series', 'post', $args );
	}
}

new BKR_Post_Series();

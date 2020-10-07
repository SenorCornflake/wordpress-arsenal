<?php
/*
 * Plugin Name: bkr Hook Snippets
 * Author: Baker
 * Description: Allows you to hook snippets of text to whatever hook you desire.
 */

class BKR_Hook_Snippets {
	private $snippets;

	public function __construct() {
		add_action( 'init', [$this, 'create_snippet_post_type'] );
        add_action( 'add_meta_boxes', [$this, 'create_snippet_post_type_metabox'] );
        add_action( 'save_post', [$this, 'save_snippet_post_type_metabox_data'] );
		add_action( 'manage_bkr_hook_snippet_posts_columns', [$this, 'snippet_manage_columns'] );
		add_action( 'manage_bkr_hook_snippet_posts_custom_column', [$this, 'snippet_manage_custom_column'], 10, 2 );

		$this->snippets = [];
		$this->get_snippets();
		$this->register_snippets_hooks();
	}

	public function snippet_manage_columns( $columns ) {
		unset( $columns['title'] );
		unset( $columns['date'] );

		$columns['text'] = 'Text';
		$columns['hook'] = 'Hook';
		return $columns;
	}

	public function snippet_manage_custom_column( $column, $post_id ) {
		if ( $column == 'text' ) {
			echo get_the_content( $post_id );
		} elseif ( $column == 'hook' ) {
			echo get_post_meta( $post_id, 'bkr_hook_snippets_hook_name', true );
		}
	}

	// Create snippet post type
	public function create_snippet_post_type() {
        $labels = [
            'name'                     => 'Snippets',
            'singular_name'            => 'Snippet',
            'add_new'                  => 'Add New Snippet',
            'add_new_item'             => 'Add New Snippet',
            'edit_item'                => 'Edit Snippet',
            'new_item'                 => 'New Snippet',
            'view_item'                => 'View Snippet',
            'view_items'               => 'View Snippets',
            'search_items'             => 'Search Snippets',
            'not_found'                => 'No Snippets found.',
            'not_found_in_trash'       => 'No Snippets found in trash.',
            'parent_item_colon'        => 'Parent Snippet',
            'all_items'                => 'All Snippets',
            'archives'                 => 'Snippet Archives',
            'attributes'               => 'Snippet attributes',
            'insert_into_item'         => 'Insert into Snippet',
            'uploaded_to_this_item'    => 'Uploaded to this Snippet',
            'featured_image'           => 'Featured Image',
            'set_featured_image'       => 'Set featured image',
            'remove_featured_image'    => 'Remove featured image',
            'use_featured_image'       => 'Use as featured image',
            'filter_items_list'        => 'Filter Snippet list',
            'items_list_navigation'    => 'Snippets list navigation',
            'items_list'               => 'Snippets list',
            'item_published'           => 'Snippet published',
            'item_published_privately' => 'Snippet published privately',
            'item_reverted_to_draft'   => 'Snippet reverted to draft',
            'item_scheduled'           => 'Snippet scheduled',
            'item_updated'             => 'Snippet Updated',
        ];

        register_post_type( 'bkr_hook_snippet', [
            'labels'               => $labels,
            'description'          => 'Text that will be displayed at the given hook',
            'public'               => false,
            'hierarchical'         => false,
            'exclude_from_search'  => true,
            'publicly_querable'    => false,
            'show_ui'              => true,
            'show_in_menu'         => true,
            'show_in_nav_menus'    => false,
            'show_in_admin_bar'    => true,
            'show_in_rest'         => false,
            'menu_position'        => 20,
            'menu_icon'            => 'dashicons-book',
            'capabilities'         => ['create_posts' => true],
            'capability_type'      => 'post',
            'map_meta_cap'         => true,
            'supports'             => ['editor'],
            'register_meta_box_cb' => null,
            'taxonomies'           => [],
            'has_archive'          => false,
            'can_export'           => true,
        ] );
	}


	// Meta box for snippet post type, user uses this to specifiy the hook name
	public function create_snippet_post_type_metabox() {
		add_meta_box(
			'bkr_hook_snippets_hook_name',
			'Hook name',
			[$this, 'snippet_post_type_metabox_cb'],
			'bkr_hook_snippet'
		);
	}

	public function snippet_post_type_metabox_cb( $post ) {
		echo '<input type="text" name="bkr_hook_snippets_hook_name" value="' . get_post_meta( $post->ID, 'bkr_hook_snippets_hook_name', true ) . '" placeholder="Hook Name" autocomplete="off">';
	}

	public function save_snippet_post_type_metabox_data( $post_id ) {
		if ( isset( $_POST['bkr_hook_snippets_hook_name'] ) ) {
			update_post_meta( $post_id, 'bkr_hook_snippets_hook_name', $_POST['bkr_hook_snippets_hook_name'] );
		}
	}

	// Get all snippets
	private function get_snippets() {
		$snippets = get_posts([
			'post_type' => 'bkr_hook_snippet',
			'post_status' => 'publish',
			'numberposts' => -1
		]);

		foreach ( $snippets as $snippet ) {
			$hook_name = get_post_meta( $snippet->ID, 'bkr_hook_snippets_hook_name', true );

			if ( $hook_name == '' || $hook_name == false ) {
				continue;
			}
			
			array_push( $this->snippets, [
				"hook" => $hook_name,
				"content" => $snippet->post_content
			] );
		}
	}

	private function register_snippets_hooks() {
		foreach( $this->snippets as $snippet ) {
			add_action( $snippet['hook'], function () use ( $snippet ) {
				echo $snippet['content'];
			} );
		}
	}
}
new BKR_Hook_Snippets();

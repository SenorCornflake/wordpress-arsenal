<?php
/*
 * Plugin Name: BKR Taxonomy Images
 * Author: Baker
 * Description: Adds image support to all taxonomies
 */


class BKR_Taxonomy_Images {
	public function __construct() {
		$this->setup_all_taxonomies();

		add_action( 'edit_term', [$this, 'save_image'] );
		add_action( 'create_term', [$this, 'save_image'] );
	}

	// Add fields and columns to all taxonomies
	public function setup_all_taxonomies() {
		$taxonomies = get_taxonomies();

		if ( is_array( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {
                // Add taxonomy image field to the page where taxonomies are created
                add_action( $taxonomy . '_add_form_fields', [$this, 'display_add_field'] );

                // Add taxonomy image field to the page where taxonomies are edited
                add_action( $taxonomy . '_edit_form_fields', [$this, 'display_edit_field'] );

                // Add taxonomy image column
                add_filter( 'manage_edit-' . $taxonomy . '_columns', [$this, 'add_image_column'] );

                // Manage custom column
                add_filter( 'manage_' . $taxonomy . '_custom_column', [$this, 'manage_image_column'], 10, 3 );

                // Remove option if taxonomy is deleted
                add_action( 'delete' . $taxonomy, function ( $term_id ) {
                    delete_option( 'bkr_taxonomy_images_taxonomy_image_' . $term_id );
                } );

                // Only enqueue scripts and styles in "edit-tags.php" and "term.php"
                if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 || strpos( $_SERVER['SCRIPT_NAME'], 'term.php' ) > 0 ) {
					add_action( 'admin_enqueue_scripts', function () {
						wp_enqueue_media();
						wp_enqueue_script( 'bkr_taxonomy_images_media_upload', plugin_dir_url( __FILE__ ) . 'js/media_upload.js', [], false, true );
					} );
                }
			}
		}
	}

	// Save image
	public function save_image( $term_id ) {
		if ( isset( $_POST['bkr_taxonomy_images_selected_image'] ) ) {
            update_option( 'bkr_taxonomy_images_taxonomy_image_' . $term_id, $_POST['bkr_taxonomy_images_selected_image'] );
		}
	}

	// Change or edit image
	public function edit_image() {

	}

	// Get taxonomy image
    public function get_image( $term_id, $size = 'medium', $return_id = false ) {
        $attachment_id = get_option( 'bkr_taxonomy_images_taxonomy_image_' . $term_id );

        if ( $return_id ) {
            return $attachment_id;
        }

        if ( $attachment_id ) {
        	return wp_get_attachment_image_src( $attachment_id, $size )[0];
        }

		return false;
    }

	// Add image column
	public function add_image_column( $columns ) {
		$columns['image'] = 'Image';
		return $columns;
	}

	// Manage Image column
	public function manage_image_column(  $column_content, $column_name, $term_id ) {
		if ( $column_name == 'image' ) {
			$image_url = $this->get_image( $term_id, 'small', false );

			if ( $image_url != false ) {
				echo '<img style="max-width: 100%;" src="' . $image_url . '">';
			} else {
				echo '';
			}
		}
	}

	// Display add field in create taxonomy page
	public function display_add_field() {
		echo '<div class="bkr_taxonomy_images" style="margin-bottom: 10px;">
			<label>BKR Taxonomy Image</label>
			<div id="bkr_taxonomy_images_image_preview"></div>
				<input id="bkr_taxonomy_images_selected_image" type="hidden" name="bkr_taxonomy_images_selected_image">
				<button type="button" id="bkr_taxonomy_images_add_image" class="button button-primary">Add/Change</button>
				<button type="button" id="bkr_taxonomy_images_remove_image" class="button">Remove</button>
		</div>';
	}

	// Display edit field in edit taxonomy page
	public function display_edit_field( $taxonomy ) {
		$image = $this->get_image( $taxonomy->term_id, 'full', false );
		$id = $this->get_image( $taxonomy->term_id, 'full', false );

		if ( $image != false ) {
			$image = '<img style="max-width: 100%;" src="' . $image . '">';
		} else {
			$image = '';
		}

		echo '<tr>
			<th>BKR Taxonomy Image</th>
			<td>
				<div id="bkr_taxonomy_images_image_preview">' . $image . '</div>
				<input id="bkr_taxonomy_images_selected_image" type="hidden" name="bkr_taxonomy_images_selected_image" value="' . $id . '">
				<button type="button" id="bkr_taxonomy_images_remove_image" class="button">Remove</button>
				<button type="button" id="bkr_taxonomy_images_add_image" class="button button-primary">Add/Change</button>
			</td>
		</tr>';
	}
}
new BKR_Taxonomy_Images();

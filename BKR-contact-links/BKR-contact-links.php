<?php
/*
 * Plugin Name: BKR Contact Links
 * Author: Baker
 * Description: This plugin displays social media and contact links
 */


class BKR_Contact_Links {
	public function __construct() {
		add_action( 'admin_menu', [$this, 'settings_page'] );
		add_action( 'admin_init', [$this, 'register_settings'] );
		add_action( 'bkr_contact_links_display', [$this, 'display_links'], 10, 2 );
		
		// Load dashicons and default csson the frontend
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_style( 'bkr-contact-links-default', plugin_dir_url( __FILE__ ) . 'css/default.css', [], false, 'all' );
		} );
	}

	// Add submenu page to the settings section in admin
	public function settings_page() {
		add_submenu_page(
			'options-general.php',
			'BKR Contact Links settings',
			'BKR Contact Links settings',
			'manage_options',
			'bkr-contact-links-settings',
			function () {
				require plugin_dir_path( __FILE__ ) . 'partials/settings-page.php';
			}
		);
	}

	// Use wp settings api to manage settings
	public function register_settings() {
		// Labels
		register_setting( 'bkr_contact_links', 'bkr_contact_links_email_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_contact_number_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_whatsapp_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_twitter_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_facebook_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_instagram_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_youtube_label' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_linkedin_label' );
		
		// Urls
		register_setting( 'bkr_contact_links', 'bkr_contact_links_email_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_contact_number_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_whatsapp_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_twitter_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_facebook_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_instagram_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_youtube_link' );
		register_setting( 'bkr_contact_links', 'bkr_contact_links_linkedin_link' );

		add_settings_section(
			'bkr_contact_links_labels',
			'Labels',
			function () {
				echo 'The text displayed on screen.';
			},
			'bkr-contact-links-settings'
		);
		add_settings_section(
			'bkr_contact_links_links',
			'Links',
			function () {
				echo 'The URL which the user will visit if the label is clicked.';
			},
			'bkr-contact-links-settings'
		);


		// Labels
		add_settings_field(
			'bkr_contact_labels_email_label',
			'Email Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_email_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_email_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_contact_number_label',
			'Contact Number Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_contact_number_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_contact_number_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_whatsapp_label',
			'Whatsapp Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_whatsapp_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_whatsapp_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_twitter_label',
			'Twitter Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_twitter_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_twitter_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_facebook_label',
			'Facebook Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_facebook_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_facebook_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_instagram_label',
			'Instagram Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_instagram_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_instagram_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_youtube_label',
			'Youtube Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_youtube_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_youtube_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);
		add_settings_field(
			'bkr_contact_links_linkedin_label',
			'LabeledIn Label',
			function () {
				echo '<input type="text" name="bkr_contact_links_linkedin_label" autocomplete="off" value="' . get_option( 'bkr_contact_links_linkedin_label' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_labels'
		);


		// Links
		add_settings_field(
			'bkr_contact_links_email_link',
			'Email Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_email_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_email_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_contact_number_link',
			'Contact Number Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_contact_number_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_contact_number_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_whatsapp_link',
			'Whatsapp Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_whatsapp_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_whatsapp_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_twitter_link',
			'Twitter Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_twitter_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_twitter_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_facebook_link',
			'Facebook Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_facebook_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_facebook_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_instagram_link',
			'Instagram Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_instagram_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_instagram_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_youtube_link',
			'Youtube Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_youtube_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_youtube_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
		add_settings_field(
			'bkr_contact_links_linkedin_link',
			'LinkedIn Link',
			function () {
				echo '<input type="text" name="bkr_contact_links_linkedin_link" autocomplete="off" value="' . get_option( 'bkr_contact_links_linkedin_link' ) . '">';
			},
			'bkr-contact-links-settings',
			'bkr_contact_links_links'
		);
	}
	
	// Diplay links
	public function display_links($exclude = [], $exclude_labels = []) {
		$types = [
			'email',
			'contact_number',
			'whatsapp',
			'youtube',
			'instagram',
			'twitter',
			'facebook',
		];
		
		$html = '<div class="bkr_contact_links"><ul>';

		foreach ( $types as $type ) {
			if ( ! in_array( $type, $exclude ) ) {
				$label = get_option( 'bkr_contact_links_' . $type . '_label' );
				$link = get_option( 'bkr_contact_links_' . $type . '_link' );

				if ( $type == 'contact_number' ) {
					$icon = '<span class="dashicons dashicons-phone icon"></span>';
				} else {
					$icon = '<span class="dashicons dashicons-' . $type . ' icon"></span>';
				}

				if ( $label == false || in_array( $type, $exclude_labels ) ) {
					if ( $link == false ) {
						$html .= '<li>' . $icon . '</li>';
					} else {
						$html .= '<li><a href="' . $link .  '">' . $icon . '</a></li>';
					}
				} else {
					if ( $link == false ) {
						$html .= '<li>' . $icon . $label . '</li>';
					} else {
						$html .= '<li><a href="' . $link .  '">' . $icon . $label . '</a></li>';
					}
				}
			}
		}

		$html .= '</ul></div>';
		echo $html;
	}
}
new BKR_Contact_Links();

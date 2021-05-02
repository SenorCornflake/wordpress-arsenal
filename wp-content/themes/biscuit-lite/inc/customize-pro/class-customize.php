<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @package Biscuit Lite
 */
final class Biscuit_Lite_Customize {

	/**
	 * Returns the instance.
	 *
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		get_template_part( '/inc/customize-pro/section', 'pro' );

		// Register custom section types.
		$manager->register_section_type( 'Biscuit_Lite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new biscuit_lite_Customize_Section_Pro(
				$manager,
				'biscuit',
				array(
					'title'    => esc_html__( 'Biscuit Pro', 'biscuit-lite' ),
					'pro_text' => esc_html__( 'View Biscuit', 'biscuit-lite' ),
					'pro_url'  => 'https://www.pankogut.com/wordpress-themes/biscuit/?utm_source=customizer_button&utm_medium=wordpress_dashboard&utm_campaign=biscuit',
					'priority' => 1
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'biscuit-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customize-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'biscuit-lite-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customize-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Biscuit_Lite_Customize::get_instance();

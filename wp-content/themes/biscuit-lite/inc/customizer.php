<?php
/**
 * Biscuit Theme Customizer
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function biscuit_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'biscuit_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function biscuit_lite_customize_preview_js() {
	wp_enqueue_script( 'biscuit_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'biscuit_lite_customize_preview_js' );

/*
 * Customize Sanitization
 */
// Sanitize Select
function biscuit_lite_sanitize_select( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}

/**
 * Customizer
 *
 * @since biscuit-lite 1.0.0
 */
function biscuit_lite_theme_customizer( $wp_customize ) {

    /*--------------------------------------------------------------
        # PANELS
    --------------------------------------------------------------*/
    // START HERE
    $wp_customize->add_panel( 'biscuit_lite_start_here_panel', array(
        'title' => __('Start Here (PanKogut)', 'biscuit-lite'),
        'description' => __('Set your container width, colors and Google Analytics.', 'biscuit-lite'),
        'priority' => 10,
    ) );

    // BACKGROUND
    $wp_customize->add_panel( 'biscuit_lite_background_panel', array(
        'title' => __('Background (PanKogut)', 'biscuit-lite'),
        'description' => __('Background Color and Image.', 'biscuit-lite'),
        'priority' => 20,
    ) );

    // HEADER
    $wp_customize->add_panel( 'biscuit_lite_header_panel', array(
        'title' => __('Header (PanKogut)', 'biscuit-lite'),
        'description' => __('You can customize the header style.', 'biscuit-lite'),
        'priority' => 40,
    ) );

    // HOME PAGE
    $wp_customize->add_panel( 'biscuit_lite_home_panel', array(
        'title' => __('Home Page (PanKogut)', 'biscuit-lite'),
        'description' => __('Custom Meta Slider, Promo Box and Static Front Page', 'biscuit-lite'),
        'priority' => 50,
    ) );

    // FOOTER
    $wp_customize->add_panel( 'biscuit_lite_footer_panel', array(
        'title' => __('Footer (PanKogut)', 'biscuit-lite'),
        'description' => __('You can customize the Footer.', 'biscuit-lite'),
        'priority' => 80,
    ) );

    /*--------------------------------------------------------------
        # SECTIONS
    --------------------------------------------------------------*/
	// START HERE: Social icons style
	$wp_customize->add_section( 'biscuit_lite_social_icons_section' , array(
	    'title' => __( 'Social Icons Style (PanKogut)', 'biscuit-lite' ),
	    'description' => __('It changes the color of the social icons widget', 'biscuit-lite'),
	    'priority' => 20,
	    'panel' => 'biscuit_lite_start_here_panel',
	) );

	// START HERE: Colors
    $wp_customize->add_section( 'biscuit_lite_colors' , array(
        'title'     => __('Colors', 'biscuit-lite'),
        'priority'  => 30,
        'panel' => 'biscuit_lite_start_here_panel',
    ));
    
    // BACKGROUND: Background Color
    $wp_customize->add_section( 'colors' , array(
        'title' => __('Background Color', 'biscuit-lite'),
        'priority'  => 10,
        'panel' => 'biscuit_lite_background_panel',
    ));

    // BACKGROUND: Background Image
    $wp_customize->add_section( 'background_image' , array(
        'title' => __('Background Image', 'biscuit-lite'),
        'priority'  => 20,
        'panel' => 'biscuit_lite_background_panel',
    ));

    // HEADER: Move Site Identity to Header Panel
    $wp_customize->add_section( 'title_tagline' , array(
        'title'     => __('Site Identity', 'biscuit-lite'),
        'priority'  => 10,
        'panel' => 'biscuit_lite_header_panel',
    ));
    
    // HEADER: Move Header Image to Header Panel
    $wp_customize->add_section( 'header_image' , array(
        'title'     => __('Header Image', 'biscuit-lite'),
        'priority'  => 30,
        'panel' => 'biscuit_lite_header_panel',
    ));

    // HOME PAGE: Move Static Front Page to Home Panel
    $wp_customize->add_section( 'static_front_page' , array(
        'title'     => __('Static Front Page', 'biscuit-lite'),
        'priority'  => 30,
        'panel' => 'biscuit_lite_home_panel',
    ));

    /*--------------------------------------------------------------
        # OPTIONS
    --------------------------------------------------------------*/
	// START HERE > SOCIAL ICONS STYLE: bg color
    $wp_customize->add_setting( 'biscuit_lite_social_icons_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_social_icons_bg_color', array(
		'label' => __( 'Background Color', 'biscuit-lite' ),
		'priority' => 10,
		'section' => 'biscuit_lite_social_icons_section',
		'settings' => 'biscuit_lite_social_icons_bg_color',
	) ) );

	// START HERE > SOCIAL ICONS STYLE: color
    $wp_customize->add_setting( 'biscuit_lite_social_icons_color', array(
        'default' => '#ffffff',
       	'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_social_icons_color', array(
		'label' => __( 'Icon Color', 'biscuit-lite' ),
		'priority' => 20,
		'section' => 'biscuit_lite_social_icons_section',
		'settings' => 'biscuit_lite_social_icons_color',
	) ) );

	// START HERE > SOCIAL ICONS STYLE: circle or square
	$wp_customize->add_setting('biscuit_lite_social_icons_border_radius', array(
		'default' => '50%',
		'sanitize_callback' => 'biscuit_lite_sanitize_select',
	));

	$wp_customize->add_control('biscuit_lite_social_icons_border_radius', array(
		'label' => __('Circle or Square', 'biscuit-lite'),
		'priority' => 30,
		'section' => 'biscuit_lite_social_icons_section',
		'settings' => 'biscuit_lite_social_icons_border_radius',
		'type' => 'select',
		'choices' => array(
			'0' => 'Square',
			'50%' => 'Circle',
		),
	));

	// START HERE > COLORS: Header Title Color
    $wp_customize->add_setting( 'biscuit_lite_header_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_header_title_color', array(
		'label' => __( 'Header Title', 'biscuit-lite' ),
		'priority' => 20,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_header_title_color',
	) ) );

	// START HERE > COLORS: Top Menu Background Color
    $wp_customize->add_setting( 'biscuit_lite_top_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_top_menu_bg_color', array(
		'label' => __( 'Top Menu Background', 'biscuit-lite' ),
		'priority' => 40,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_top_menu_bg_color',
	) ) );

	// START HERE > COLORS: Top Menu Link Color
    $wp_customize->add_setting( 'biscuit_lite_top_menu_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_top_menu_link_color', array(
		'label' => __( 'Top Menu Link', 'biscuit-lite' ),
		'priority' => 50,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_top_menu_link_color',
	) ) );

	// START HERE > COLORS: Top Menu Link Hover Color
    $wp_customize->add_setting( 'biscuit_lite_top_menu_link_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_top_menu_link_hover_color', array(
		'label' => __( 'Top Menu Link Hover', 'biscuit-lite' ),
		'priority' => 60,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_top_menu_link_hover_color',
	) ) );

	// START HERE > COLORS: Sub Top Menu Background Color
    $wp_customize->add_setting( 'biscuit_lite_sub_top_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_sub_top_menu_bg_color', array(
		'label' => __( 'Sub Top Menu Background', 'biscuit-lite' ),
		'priority' => 70,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_sub_top_menu_bg_color',
	) ) );

	// START HERE > COLORS: Main Menu Background Color
    $wp_customize->add_setting( 'biscuit_lite_main_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_main_menu_bg_color', array(
		'label' => __( 'Main Menu Background', 'biscuit-lite' ),
		'priority' => 80,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_main_menu_bg_color',
	) ) );

	// START HERE > COLORS: Main Menu Link Color
    $wp_customize->add_setting( 'biscuit_lite_main_menu_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_main_menu_link_color', array(
		'label' => __( 'Main Menu Link', 'biscuit-lite' ),
		'priority' => 90,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_main_menu_link_color',
	) ) );

	// START HERE > COLORS: Main Menu Link Hover Color
    $wp_customize->add_setting( 'biscuit_lite_main_menu_link_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_main_menu_link_hover_color', array(
		'label' => __( 'Main Menu Link Hover', 'biscuit-lite' ),
		'priority' => 100,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_main_menu_link_hover_color',
	) ) );

	// START HERE > COLORS: Sub Main Menu Background Color
    $wp_customize->add_setting( 'biscuit_lite_sub_main_menu_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_sub_main_menu_bg_color', array(
		'label' => __( 'Sub Main Menu Background', 'biscuit-lite' ),
		'priority' => 110,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_sub_main_menu_bg_color',
	) ) );

	// START HERE > COLORS: Body Font Color
    $wp_customize->add_setting( 'biscuit_lite_body_color', array(
        'default' => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_body_color', array(
		'label' => __( 'Body Font', 'biscuit-lite' ),
		'priority' => 120,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_body_color',
	) ) );

	// START HERE > COLORS: Headings Font Color
    $wp_customize->add_setting( 'biscuit_lite_heading_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_heading_color', array(
		'label' => __( 'Headings Font', 'biscuit-lite' ),
		'priority' => 130,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_heading_color',
	) ) );

	// START HERE > COLORS: Link Color
    $wp_customize->add_setting( 'biscuit_lite_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_link_color', array(
		'label' => __( 'Link', 'biscuit-lite' ),
		'priority' => 140,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_link_color',
	) ) );

	// START HERE > COLORS: Link Hover Color
    $wp_customize->add_setting( 'biscuit_lite_hover_color', array(
        'default' => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_hover_color', array(
		'label' => __( 'Link Hover', 'biscuit-lite' ),
		'priority' => 150,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_hover_color',
	) ) );

	// START HERE > COLORS: Post Title Link Color
    $wp_customize->add_setting( 'biscuit_lite_post_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_post_color', array(
		'label' => __( 'Post Title', 'biscuit-lite' ),
		'priority' => 160,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_post_color',
	) ) );

	// START HERE > COLORS: Post Title Link Hover Color
    $wp_customize->add_setting( 'biscuit_lite_post_hover_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_post_hover_color', array(
		'label' => __( 'Post Title Hover', 'biscuit-lite' ),
		'priority' => 170,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_post_hover_color',
	) ) );

	// START HERE > COLORS: Widget Background Color
    $wp_customize->add_setting( 'biscuit_lite_widget_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_widget_bg_color', array(
		'label' => __( 'Widget Background', 'biscuit-lite' ),
		'priority' => 180,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_widget_bg_color',
	) ) );

	// START HERE > COLORS: Widget Title Color
    $wp_customize->add_setting( 'biscuit_lite_widget_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_widget_title_color', array(
		'label' => __( 'Widget Title', 'biscuit-lite' ),
		'priority' => 190,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_widget_title_color',
	) ) );

	// START HERE > COLORS: Blockquote Color
    $wp_customize->add_setting( 'biscuit_lite_blockquote_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_blockquote_color', array(
		'label' => __( 'Blockquote', 'biscuit-lite' ),
		'priority' => 210,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_blockquote_color',
	) ) );

	// START HERE > COLORS: Button Color
    $wp_customize->add_setting( 'biscuit_lite_button_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_button_color', array(
		'label' => __( 'Button', 'biscuit-lite' ),
		'priority' => 220,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_button_color',
	) ) );

	// START HERE > COLORS: Button Text Color
    $wp_customize->add_setting( 'biscuit_lite_button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_button_text_color', array(
		'label' => __( 'Button Text', 'biscuit-lite' ),
		'priority' => 230,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_button_text_color',
	) ) );

	// START HERE > COLORS: Pagination Current Color
    $wp_customize->add_setting( 'biscuit_lite_pagination_current_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_pagination_current_color', array(
		'label' => __( 'Pagination Current', 'biscuit-lite' ),
		'priority' => 240,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_pagination_current_color',
	) ) );

	// START HERE > COLORS: Pagination Next Color
    $wp_customize->add_setting( 'biscuit_lite_pagination_next_color', array(
        'default' => '#cccccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_pagination_next_color', array(
		'label' => __( 'Pagination Next', 'biscuit-lite' ),
		'priority' => 250,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_pagination_next_color',
	) ) );

	// START HERE > COLORS: Pagination Text Color
    $wp_customize->add_setting( 'biscuit_lite_pagination_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_pagination_text_color', array(
		'label' => __( 'Pagination Text', 'biscuit-lite' ),
		'priority' => 260,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_pagination_text_color',
	) ) );

	// START HERE > COLORS: Footer Background Color
    $wp_customize->add_setting( 'biscuit_lite_footer_bg_color', array(
        'default' => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_footer_bg_color', array(
		'label' => __( 'Footer Background', 'biscuit-lite' ),
		'priority' => 290,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_footer_bg_color',
	) ) );

	// START HERE > COLORS: Footer Text Color
    $wp_customize->add_setting( 'biscuit_lite_footer_text_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_footer_text_color', array(
		'label' => __( 'Footer Text', 'biscuit-lite' ),
		'priority' => 300,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_footer_text_color',
	) ) );

	// START HERE > COLORS: Footer Link Color
    $wp_customize->add_setting( 'biscuit_lite_footer_link_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_footer_link_color', array(
		'label' => __( 'Footer Link', 'biscuit-lite' ),
		'priority' => 310,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_footer_link_color',
	) ) );

	// START HERE > COLORS: Footer Widget Background Color
    $wp_customize->add_setting( 'biscuit_lite_footer_widget_bg_color', array(
        'default' => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_footer_widget_bg_color', array(
		'label' => __( 'Footer Widget Background', 'biscuit-lite' ),
		'priority' => 320,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_footer_widget_bg_color',
	) ) );

	// START HERE > COLORS: Footer Widget Title Color
    $wp_customize->add_setting( 'biscuit_lite_footer_widget_title_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_footer_widget_title_color', array(
		'label' => __( 'Footer Widget Title', 'biscuit-lite' ),
		'priority' => 330,
		'section' => 'biscuit_lite_colors',
		'settings' => 'biscuit_lite_footer_widget_title_color',
	) ) );

	// BACKGROUND > BACKGROUND COLOR: Header bg
    $wp_customize->add_setting( 'biscuit_lite_header_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control ( $wp_customize, 'biscuit_lite_header_bg_color', array(
		'label' => __( 'Header Background', 'biscuit-lite' ),
		'priority' => 10,
		'section' => 'colors',
		'settings' => 'biscuit_lite_header_bg_color',
	) ) );

	// BACKGROUND > BACKGROUND COLOR: Box Color
    $wp_customize->add_setting( 'biscuit_lite_box_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biscuit_lite_box_color', array(
		'label' => __( 'Box Color', 'biscuit-lite' ),
		'section' => 'colors',
		'settings' => 'biscuit_lite_box_color',
	) ) );
}
add_action('customize_register', 'biscuit_lite_theme_customizer');

/**
 * Customizer Apply Style
 *
 * @since biscuit-lite 1.0.0
 */
if ( ! function_exists( 'biscuit_lite_apply_style' ) ) :
  	
  	function biscuit_lite_apply_style() {
		if ( get_theme_mod('biscuit_lite_header_bg_color') || 
			 get_theme_mod('biscuit_lite_box_color') || 
			 get_theme_mod('biscuit_lite_header_title_color') || 
			 get_theme_mod('biscuit_lite_top_menu_bg_color') || 
			 get_theme_mod('biscuit_lite_top_menu_link_color') || 
			 get_theme_mod('biscuit_lite_top_menu_link_hover_color') || 
			 get_theme_mod('biscuit_lite_sub_top_menu_bg_color') || 
			 get_theme_mod('biscuit_lite_main_menu_bg_color') || 
			 get_theme_mod('biscuit_lite_main_menu_link_color') || 
			 get_theme_mod('biscuit_lite_main_menu_link_hover_color') || 
			 get_theme_mod('biscuit_lite_sub_main_menu_bg_color') || 
			 get_theme_mod('biscuit_lite_body_color') || 
			 get_theme_mod('biscuit_lite_heading_color') || 
			 get_theme_mod('biscuit_lite_link_color') || 
			 get_theme_mod('biscuit_lite_hover_color') || 
			 get_theme_mod('biscuit_lite_post_color') || 
			 get_theme_mod('biscuit_lite_post_hover_color') || 
			 get_theme_mod('biscuit_lite_widget_bg_color') || 
			 get_theme_mod('biscuit_lite_widget_title_color') || 
			 get_theme_mod('biscuit_lite_social_icons_bg_color') || 
			 get_theme_mod('biscuit_lite_social_icons_color') || 
			 get_theme_mod('biscuit_lite_social_icons_border_radius') || 
			 get_theme_mod('biscuit_lite_blockquote_color') ||
			 get_theme_mod('biscuit_lite_button_color') || 
			 get_theme_mod('biscuit_lite_button_text_color') || 
			 get_theme_mod('biscuit_lite_pagination_current_color') || 
			 get_theme_mod('biscuit_lite_pagination_next_color') || 
			 get_theme_mod('biscuit_lite_pagination_text_color') || 
			 get_theme_mod('biscuit_lite_footer_bg_color') || 
			 get_theme_mod('biscuit_lite_footer_text_color') || 
			 get_theme_mod('biscuit_lite_footer_link_color') || 
			 get_theme_mod('biscuit_lite_footer_widget_bg_color') || 
			 get_theme_mod('biscuit_lite_footer_widget_title_color')
		) { 
		?>
			<style id="biscuit-style-settings">
				<?php if ( get_theme_mod('biscuit_lite_header_bg_color') ) : ?>
					.site-header {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_header_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_box_color') ) : ?>
					.site-content { background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_box_color', '#ffffff' ) ); ?>; }
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_header_title_color') ) : ?>
					.site-title a {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_header_title_color' ) );  ?> !important;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_top_menu_bg_color') ) : ?>
					#top-navigation {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_top_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_top_menu_link_color') ) : ?>
					#top-navigation a,
					#top-navigation a:visited,
					#top-navigation .menu-toggle {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_top_menu_link_color' ) );  ?>;
						text-decoration: none;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_top_menu_link_hover_color') ) : ?>
					#top-navigation a:hover,
					#top-navigation button.menu-toggle a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_top_menu_link_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_sub_top_menu_bg_color') ) : ?>
					#top-navigation ul ul {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_sub_top_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_main_menu_bg_color') ) : ?>
					#site-navigation {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_main_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_main_menu_link_color') ) : ?>
					#site-navigation a,
					#site-navigation a:visited,
					#site-navigation .menu-toggle {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_main_menu_link_color' ) );  ?>;
						text-decoration: none;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_main_menu_link_hover_color') ) : ?>
					#site-navigation a:hover,
					#site-navigation button.menu-toggle a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_main_menu_link_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_sub_main_menu_bg_color') ) : ?>
					#site-navigation ul ul {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_sub_main_menu_bg_color' ) );  ?>;
					}
				<?php endif; ?>
				
				<?php if ( get_theme_mod('biscuit_lite_body_color') ) : ?>
					body,
					button,
					input,
					select,
					textarea {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_body_color' ) );  ?>;
					}
				<?php endif; ?>
				
				<?php if ( get_theme_mod('biscuit_lite_heading_color') ) : ?>
					h1, h2, h3, h4, h5, h6 {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_heading_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_link_color') ) : ?>
					a,
					a:visited {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_link_color' ) );  ?>;
					}
				<?php endif; ?>
			
				<?php if ( get_theme_mod('biscuit_lite_hover_color') ) : ?>
					a:hover,
					a:focus,
					a:active {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_hover_color' ) );  ?>;
					}
				<?php endif; ?>
				
				<?php if ( get_theme_mod('biscuit_lite_post_color') ) : ?>
					.entry-title,
					.entry-title a {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_post_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_post_hover_color') ) : ?>
					.entry-title a:hover {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_post_hover_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_widget_bg_color') ) : ?>
					.widget-title {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_widget_bg_color' ) );  ?>;
					}
				<?php endif; ?>
				
				<?php if ( get_theme_mod('biscuit_lite_widget_title_color') ) : ?>
					.widget-title {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_widget_title_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_social_icons_bg_color') ) : ?>
					.social,
					.social-icomoon {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_social_icons_bg_color', '#000000' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_social_icons_color') ) : ?>
					.social:before,
					.social-icomoon:before {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_social_icons_color', '#ffffff' ) ); ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_social_icons_border_radius') ) : ?>
				.social,
				.social-icomoon {
					border-radius: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_social_icons_border_radius', '0' ) ); ?>;
				}
				<?php endif; ?>
				
				<?php if ( get_theme_mod('biscuit_lite_blockquote_color') ) : ?>
					blockquote {
						border-left: 5px solid <?php echo esc_attr( get_theme_mod( 'biscuit_lite_blockquote_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_button_color') || get_theme_mod('biscuit_lite_button_text_color') ) : ?>
					button, 
					input[type="button"], 
					input[type="reset"], 
					input[type="submit"] {
						border: 1px solid <?php echo esc_attr( get_theme_mod( 'biscuit_lite_button_color' ) );  ?>;
						background: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_button_color' ) );  ?>;
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_button_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_pagination_current_color') ) : ?>
					.pagination a:hover, 
					.pagination .current {
						background: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_pagination_current_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_pagination_next_color') ) : ?>
					.pagination a {
						background: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_pagination_next_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_pagination_text_color') ) : ?>
					.pagination a:hover, 
					.pagination .current,
					.pagination a {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_pagination_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_footer_bg_color') ) : ?>
					.site-footer {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_footer_text_color') ) : ?>
					.site-info {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer_text_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_footer_link_color') ) : ?>
					.site-info a {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer_link_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_footer_widget_bg_color') ) : ?>
					.site-footer .widget-title {
						background-color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer_widget_bg_color' ) );  ?>;
					}
				<?php endif; ?>

				<?php if ( get_theme_mod('biscuit_lite_footer_widget_title_color') ) : ?>
					.site-footer .widget-title {
						color: <?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer_widget_title_color' ) );  ?>;
					}
				<?php endif; ?>
			</style>
		<?php
    }
}
endif;
add_action( 'wp_head', 'biscuit_lite_apply_style' );
<?php
/**
 * AwesomePress Theme Customizer.
 *
 * @package AwesomePress
 */

/**
 * Set default options
 */
if (! function_exists('awesomepress_get_defaults') ) :

    /**
     * Set default options
     */
    function awesomepress_get_defaults() 
    {

        $awesomepress_defaults = array(

        /**
         * Container
         */
         'container-width-page'    => 1300,
         'container-width-single'  => 1300,
         'container-width-archive' => 1300,

        /**
         * Sidebar
         */
         'sidebar-page'    => 'layout-content-sidebar',
         'sidebar-single'  => 'layout-content-sidebar',
         'sidebar-archive' => 'layout-content-sidebar',
        );

        return apply_filters('awesomepress_theme_defaults', $awesomepress_defaults);
    }

endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
if (! function_exists('awesomepress_customize_register') ) :

    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param object $wp_customize Theme Customizer object.
     */
    function awesomepress_customize_register( $wp_customize ) 
    {

        /**
         * Override defaults
         */
        $wp_customize->get_setting('blogname')->transport         = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
        $wp_customize->get_control('header_textcolor')->label     = __('Site Title & Tagline Color', 'awesomepress');
        $wp_customize->get_control('background_color')->label     = __('Body Background Color', 'awesomepress');

        /**
         * Get default's
         */
        $defaults = awesomepress_get_defaults();

        /**
         * Load customizer helper files
         */
        include_once AWESOMEPRESS_DIR . '/inc/customizer/customizer-callbacks.php';
        include_once AWESOMEPRESS_DIR . '/inc/customizer/customizer-sanitize.php';
        include_once AWESOMEPRESS_DIR . '/inc/customizer/customizer-controls.php';

        /**
         * Added custom customizer controls
         */
        if (method_exists($wp_customize, 'register_control_type') ) {
            $wp_customize->register_control_type('AwesomePress_Customize_Width_Slider_Control');
        }

        /**
         * Register Panel & Sections
         */
        if (class_exists('WP_Customize_Panel') ) :
            if (! $wp_customize->get_panel('awesomepress_panel_layout') ) {
                $wp_customize->add_panel(
                    'awesomepress_panel_layout', array(
                    'capability' => 'edit_theme_options',
                    'title'      => _x('Layout', 'Website Layout', 'awesomepress'),
                    'priority'   => 40,
                ) );
            }
        endif;

        $wp_customize->add_section(
            'awesomepress_section_container', array(
                'title'      => _x('Container', 'Website Container', 'awesomepress'),
                'capability' => 'edit_theme_options',
                'panel'      => 'awesomepress_panel_layout',
            )
        );

        $wp_customize->add_section(
            'awesomepress_sidebars', array(
                'title'      => __('Sidebars', 'awesomepress'),
                'capability' => 'edit_theme_options',
                'panel'      => 'awesomepress_panel_layout',
            )
        );

        /**
         * Register options
         */

        /**
         * Container Width - Archive
         */
        $wp_customize->add_setting(
            'awesomepress[container-width-archive]', array(
                'default'           => $defaults['container-width-archive'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_integer' ),
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new AwesomePress_Customize_Width_Slider_Control(
                $wp_customize, 'awesomepress[container-width-archive]', array(
                    'label'           => __('Archive', 'awesomepress'),
                    'description'     => __('Container width for archive pages.', 'awesomepress'),
                    'tooltip'         => __('Container width is applied for the blog, category, tag and custom post type archive pages.', 'awesomepress'),
                    'section'         => 'awesomepress_section_container',
                    'priority'        => 0,
                    'type'            => 'awesomepress-range-slider',
                    'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_archive' ),
                    'default'         => $defaults['container-width-archive'],
                    'unit'            => 'px',
                    'min'             => 700,
                    'max'             => 2000,
                    'step'            => 5,
                    'settings'        => 'awesomepress[container-width-archive]',
                )
            )
        );

        /**
         * Container Width - Single Post
         */
        $wp_customize->add_setting(
            'awesomepress[container-width-single]', array(
                'default'           => $defaults['container-width-single'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_integer' ),
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new AwesomePress_Customize_Width_Slider_Control(
                $wp_customize, 'awesomepress[container-width-single]', array(
                    'label'           => __('Single Post', 'awesomepress'),
                    'description'     => __('Container width for the single post.', 'awesomepress'),
                    'tooltip'         => __('Container width is applied for the single post.', 'awesomepress'),
                    'section'         => 'awesomepress_section_container',
                    'priority'        => 0,
                    'type'            => 'awesomepress-range-slider',
                    'default'         => $defaults['container-width-single'],
                    'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_single' ),
                    'unit'            => 'px',
                    'min'             => 700,
                    'max'             => 2000,
                    'step'            => 5,
                    'settings'        => 'awesomepress[container-width-single]',
                )
            )
        );

        /**
         * Container Width - Page
         */
        $wp_customize->add_setting(
            'awesomepress[container-width-page]', array(
                'default'           => $defaults['container-width-page'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_integer' ),
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new AwesomePress_Customize_Width_Slider_Control(
                $wp_customize, 'awesomepress[container-width-page]', array(
                    'label'           => __('Page', 'awesomepress'),
                    'description'     => __('Container width for the page.', 'awesomepress'),
                    'tooltip'         => __('Container width is applied for the pages.', 'awesomepress'),
                    'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_page' ),
                    'section'         => 'awesomepress_section_container',
                    'priority'        => 0,
                    'type'            => 'awesomepress-range-slider',
                    'default'         => $defaults['container-width-page'],
                    'unit'            => 'px',
                    'min'             => 700,
                    'max'             => 2000,
                    'step'            => 5,
                    'settings'        => 'awesomepress[container-width-page]',
                )
            )
        );

        /**
         * Sidebar - Archive
         */
        $wp_customize->add_setting(
            'awesomepress[sidebar-archive]', array(
                'default'           => $defaults['sidebar-archive'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'awesomepress[sidebar-archive]', array(
                'type'            => 'select',
                'label'           => __('Archive', 'awesomepress'),
                'description'     => __('Add sidebar layout for blog, archive, category tag pages.', 'awesomepress'),
                'section'         => 'awesomepress_sidebars',
                'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_archive' ),
                'choices'         => array(
                'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'awesomepress'),
                'layout-sidebar-content'         => __('Left Sidebar / Content', 'awesomepress'),
                'layout-content-sidebar'         => __('Content / Right Sidebar', 'awesomepress'),
                'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'awesomepress'),
                'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'awesomepress'),
                'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'awesomepress'),
            ),
        ) );

        /**
         * Sidebar - Single Post
         */
        $wp_customize->add_setting(
            'awesomepress[sidebar-single]', array(
                'default'           => $defaults['sidebar-single'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'awesomepress[sidebar-single]', array(
                'type'            => 'select',
                'label'           => __('Single Post', 'awesomepress'),
                'description'     => __('Add sidebar layout for single post only.', 'awesomepress'),
                'section'         => 'awesomepress_sidebars',
                'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_single' ),
                'choices'         => array(
                'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'awesomepress'),
                'layout-sidebar-content'         => __('Left Sidebar / Content', 'awesomepress'),
                'layout-content-sidebar'         => __('Content / Right Sidebar', 'awesomepress'),
                'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'awesomepress'),
                'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'awesomepress'),
                'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'awesomepress'),
            ),
        ) );

        /**
         * Sidebar - Page
         */
        $wp_customize->add_setting(
            'awesomepress[sidebar-page]', array(
                'default'           => $defaults['sidebar-page'],
                'type'              => 'option',
                'sanitize_callback' => array( 'AwesomePress_Customize_Sanitize', '_sanitize_choices' ),
            )
        );
        $wp_customize->add_control(
            'awesomepress[sidebar-page]', array(
                'type'            => 'select',
                'label'           => __('Page', 'awesomepress'),
                'description'     => __('Add sidebar layout for pages only.', 'awesomepress'),
                'section'         => 'awesomepress_sidebars',
                'active_callback' => array( 'AwesomePress_Customize_Callback', '_sidebar_page' ),
                'choices'         => array(
                'layout-no-sidebar'              => __('Full Width ( No Sidebar )', 'awesomepress'),
                'layout-sidebar-content'         => __('Left Sidebar / Content', 'awesomepress'),
                'layout-content-sidebar'         => __('Content / Right Sidebar', 'awesomepress'),
                'layout-content-sidebar-sidebar' => __('Content / Left Sidebar / Right Sidebar', 'awesomepress'),
                'layout-sidebar-content-sidebar' => __('Left Sidebar / Content / Right Sidebar', 'awesomepress'),
                'layout-sidebar-sidebar-content' => __('Left Sidebar / Right Sidebar / Content', 'awesomepress'),
            ),
        ) );

    }
    add_action('customize_register', 'awesomepress_customize_register');
endif;

/**
 * Customizer Preview JS
 */
if (! function_exists('awesomepress_customize_preview_js') ) :

    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    function awesomepress_customize_preview_js() 
    {
        wp_enqueue_script('awesomepress-customizer-js', awesomepress_asset_url('customizer', 'js', '', 'admin'), array( 'customize-preview' ), '20151215', true);
    }
    add_action('customize_preview_init', 'awesomepress_customize_preview_js');

endif;

/**
 * Add CSS for our controls
 */
if (! function_exists('awesomepress_customizer_controls_css') ) :

    /**
     * Add CSS for our controls
     *
     * @since 1.0.0
     */
    function awesomepress_customizer_controls_css() 
    {
        wp_enqueue_style('awesomepress-customizer-controls-css', awesomepress_asset_url('customizer', 'css', '', 'admin'));
    }
    add_action('customize_controls_enqueue_scripts', 'awesomepress_customizer_controls_css');

endif;

/**
 * Generate Dynamic CSS
 */
if (! function_exists('awesomepress_dynamic_css') ) :

    /**
     * Generate Dynamic CSS from customizer option's
     */
    function awesomepress_dynamic_css() 
    {

        $space = ' ';

        // Generate CSS.
        $parse_css = array(

            '.error404 .site-content > .inner,
            .page .site-content > .inner,
            .error404 .custom-headers,
            .page .custom-headers' => array(
                'max-width' => absint( awesomepress_get_option('container-width-page') ) . 'px',
            ),

            '.archive .site-content > .inner,
            .search .site-content > .inner,
            .blog .site-content > .inner,
            .archive .custom-headers,
            .search .custom-headers,
            .blog .custom-headers' => array(
                'max-width' => absint( awesomepress_get_option('container-width-archive') ) . 'px',
            ),

            '.single .site-content > .inner,
            .single .custom-headers' => array(
                'max-width' => absint( awesomepress_get_option('container-width-single') ) . 'px',
            ),
            '.page-header' => array(
                'background-image' => 'url('.get_header_image().')',
            ),
        );

        /**
         * Single Page, Post etc.
         */
        if( is_singular( ) && has_post_thumbnail( get_the_ID() ) ) {
            $parse_css['.page-header-has-bg-image .page-header'] = array(
                'background-image' => 'url("'.get_the_post_thumbnail_url( get_the_id(), 'large' ).'");',
            );
        }

        // Output the above CSS.
        $output = '';

        foreach ( $parse_css as $selector => $properties ) {

            if (! count($properties) ) {
                continue;
            }

            $temporary_output = $selector . ' {';
            $elements_added   = 0;

            foreach ( $properties as $property => $css_value ) {
                if (empty($css_value) ) {
                    continue;
                }

                $elements_added++;
                $temporary_output .= $property . ': ' . $css_value . '; ';
            }

            $temporary_output .= '}';

            if (0 < $elements_added ) {
                $output .= $temporary_output;
            }
        }

        $output = str_replace(array( "\r", "\n", "\t" ), '', $output);

        wp_add_inline_style('awesomepress-core-css', $output );
    }
    add_action('wp_enqueue_scripts', 'awesomepress_dynamic_css');

endif;

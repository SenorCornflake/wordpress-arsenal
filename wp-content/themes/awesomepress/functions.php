<?php
/**
 * AwesomePress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AwesomePress
 */

/**
 * Define constants
 */
define( 'AWESOMEPRESS_VERSION', '1.0.4' );
define( 'AWESOMEPRESS_URI', get_template_directory_uri() );
define( 'AWESOMEPRESS_DIR', get_template_directory() );
define( 'AWESOMEPRESS_SUPPORT_FONTAWESOME', true );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'awesomepress_setup' ) ) :

	/**
	 * AwesomePress setup
	 */
	function awesomepress_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on AwesomePress, use a find and replace
		 * to change 'awesomepress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'awesomepress' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Indicate widget sidebars can use selective refresh in the Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'awesomepress' ),
			)
		);

		/*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters( 'awesomepress_custom_background_args', array(
				'default-color' => 'f1f4f9',
				'default-image' => '',
			) )
		);

		// Added editor style support.
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		$GLOBALS['content_width'] = apply_filters( 'awesomepress_content_width', 640 );

		/**
		 * Added starter content
		 */
		add_theme_support(
			'starter-content', array(
				'widgets' => array(
					'sidebar-1' => array(
						'search',
						'recent-posts',
						'recent-comments',
						'archives',
						'categories',
						'meta',
					),
					'sidebar-2' => array(
						'text_about',
						'calendar',
						'text_business_info',
					),
				),
			)
		);

		/**
		 * Enable support for custom logo.
		 *
		 * @since 1.0.4.8
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-height' => true,
		) );
	}

	add_action( 'after_setup_theme', 'awesomepress_setup' );

endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'awesomepress_widgets_init' ) ) :

	/**
	 * AwesomePress Widgets
	 */
	function awesomepress_widgets_init() {
		register_sidebar(
			array(
			'name'          => esc_html__( 'Right Sidebar', 'awesomepress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'awesomepress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
			'name'          => esc_html__( 'Left Sidebar', 'awesomepress' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'awesomepress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			)
		);
	}
	add_action( 'widgets_init', 'awesomepress_widgets_init' );
endif;

/**
 * Generate asset URL depend on RTL & SCRIPT_DEBUG.
 *
 * E.g. For request awesomepress_asset_url( 'editor-style', 'css' );
 * Load one of the below file depends on RTL & SCRIPTS_DEBUG check.
 *
 * NOTE: RTL support is now just for ONLY theme style.css file.
 *
 *    style.min.css         Load normally.
 *    style.min-rtl.css     Load if RTL is on.
 *
 *    style.css             Load if SCRIPT_DEBUG is true.
 *    style-rtl.css         Load if SCRIPT_DEBUG & RTL are true.
 */

if ( ! function_exists( 'awesomepress_asset_url' ) ) :

	/**
	 * Generate asset URL depend on RTL & SCRIPT_DEBUG.
	 *
	 * How to use?
	 *
	 * @param  string  $file_name       Asset ( CSS / JS ) file name.
	 * @param  string  $type            Asset type either CSS or JS.
	 * @param  boolean $has_rtl_support Use argument for RTL support.
	 * @param  boolean $dir_path        Use argument for loading admin assets.
	 * @return string            URL of asset depend on RTL & SCRIPT_DEBUG.
	 */
	function awesomepress_asset_url( $file_name = '', $type = '', $has_rtl_support = false, $dir_path = '' ) {

		/**
		 * Load admin assets
		 */
		switch ( $dir_path ) {
			case 'vendor':
				$unmin_url     = '/assets/vendor/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/assets/vendor/' . $type . '/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/assets/vendor/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/assets/vendor/' . $type . '/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
			case 'admin':
				$unmin_url     = '/inc/assets/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/inc/assets/' . $type . '/min/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/inc/assets/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/inc/assets/' . $type . '/min/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
			default:
				$unmin_url     = '/assets/' . $type . '/' . $file_name . '.' . $type;
				$min_url       = '/assets/' . $type . '/min/' . $file_name . '.min.' . $type;
				$unmin_url_rtl = '/assets/' . $type . '/rtl/' . $file_name . '-rtl.' . $type;
				$min_url_rtl   = '/assets/' . $type . '/min/rtl/' . $file_name . '-rtl.min.' . $type;
			break;
		}

		// Load unminified assets.
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {

			$asset_url = $unmin_url; // Load unminified assets.

			if ( $has_rtl_support && is_rtl() ) {
				$asset_url = $unmin_url_rtl; // Load unminified RTL assets.
			}

			// Load minified assets.
		} else {

			$asset_url = $min_url; // Load minified assets.

			if ( $has_rtl_support && is_rtl() ) {
				$asset_url = $min_url_rtl; // Load minified RTL assets.
			}
		}

		return AWESOMEPRESS_URI . $asset_url;
	}
endif;

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'awesomepress_scripts' ) ) :

	/**
	 * AwesomePress Scripts
	 */
	function awesomepress_scripts() {

		/**
		 * Theme Assets
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Unminified & Individual files.
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {

			// CSS.
			wp_enqueue_style( 'awesomepress-core-css', get_stylesheet_uri() );
			wp_style_add_data( 'awesomepress-core-css', 'rtl', 'replace' );

			// JS.
			wp_enqueue_script( 'awesomepress-navigation', AWESOMEPRESS_URI . '/assets/js/navigation.js', array( 'jquery' ), AWESOMEPRESS_VERSION, true );
			wp_enqueue_script( 'awesomepress-skip-link-focus-fix', AWESOMEPRESS_URI . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), AWESOMEPRESS_VERSION, true );

			// Minified & Combined single files.
		} else {

			// CSS.
			if ( is_rtl() ) {
				wp_enqueue_style( 'awesomepress-core-css', AWESOMEPRESS_URI . '/assets/css/min/rtl/style.min-rtl.css' );
			} else {
				wp_enqueue_style( 'awesomepress-core-css', AWESOMEPRESS_URI . '/assets/css/min/style.min.css' );
			}

			// JS.
			wp_enqueue_script( 'awesomepress-core-js', AWESOMEPRESS_URI . '/assets/js/min/style.min.js', array( 'jquery' ), array( 'jquery' ), AWESOMEPRESS_VERSION, true );
		}

		/**
		 * External assets.
		 */
		if ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) {
			wp_enqueue_style( 'font-awesome', awesomepress_asset_url( 'font-awesome', 'css', '', 'vendor' ) );
		}
	}
	add_action( 'wp_enqueue_scripts', 'awesomepress_scripts' );

endif;

/**
 * Theme Hook Alliance hook stub list.
 */
require AWESOMEPRESS_DIR . '/inc/hooks.php';

/**
 * Implement the Custom Header feature.
 */
require AWESOMEPRESS_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require AWESOMEPRESS_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require AWESOMEPRESS_DIR . '/inc/extras.php';

/**
 * Customizer additions.
 */
require AWESOMEPRESS_DIR . '/inc/customizer/customizer.php';

/**
 * Load compatibility files for 3rd party plugins.
 */
require AWESOMEPRESS_DIR . '/inc/compatibility/jetpack.php';

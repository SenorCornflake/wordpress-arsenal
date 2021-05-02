<?php
/**
 * biscuit functions and definitions
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */

if ( ! function_exists( 'biscuit_lite_setup' ) ) :
	
	function biscuit_lite_setup() {
	
	// Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'biscuit-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'biscuit-lite' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'audio' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'biscuit_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// enable feature custom header
	add_theme_support( 'custom-header' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Gutenberg
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-units' );
	add_theme_support( 'responsive-embeds' );
}
endif; // biscuit_lite_setup
add_action( 'after_setup_theme', 'biscuit_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function biscuit_lite_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'biscuit_lite_content_width', 780 );
}
add_action( 'after_setup_theme', 'biscuit_lite_content_width', 0 );

/**
 * Custom Editor Style
 *
 * @since biscuit-lite 1.0.0
 */
function biscuit_lite_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'biscuit_lite_add_editor_styles' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function biscuit_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'biscuit-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'biscuit-lite' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'biscuit-lite' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'biscuit-lite' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'biscuit_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function biscuit_lite_scripts() {
	wp_enqueue_style( 'biscuit-style', get_stylesheet_uri() );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );

	wp_enqueue_script( 'jquary-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1' );
	wp_enqueue_script( 'jquery-retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'biscuit-plugins', get_template_directory_uri() . '/js/plugins.js', array(), '20120206', true );
	wp_enqueue_script( 'biscuit-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'biscuit_lite_scripts' );

/**
 * Add Google Fonts
 */
function biscuit_lite_add_google_fonts() {
 
wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,700,300|Amatic+SC:400,700', false ); 
}
 
add_action( 'wp_enqueue_scripts', 'biscuit_lite_add_google_fonts' );

/**
 * Add "pro" link to the customizer
 *
 */
require get_template_directory() . '/inc/customize-pro/class-customize.php';

/**
 * Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function biscuit_lite_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'WP Recipe Maker',
			'slug'      => 'wp-recipe-maker',
			'required'  => false,
		),

		array(
			'name'      => 'Smash Balloon Social Photo Feed',
			'slug'      => 'instagram-feed',
			'required'  => false,
		),
		
		array(
			'name'      => 'Contact Form by WPForms',
			'slug'      => 'wpforms-lite',
			'required'  => false,
		),
		
		array(
			'name'      => 'Jetpack',
			'slug'      => 'jetpack',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'biscuit-lite',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'biscuit_lite_register_required_plugins' );

/**
 * Returns a "Read more" link for excerpts
 *
 * @since biscuit-lite 1.0.0
 */
function biscuit_lite_excerpt_more( $more ) {
	if (is_admin()) return $more;
	return '<a class="more-link" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read more', 'biscuit-lite' ) . '</a>';
}
add_filter( 'excerpt_more', 'biscuit_lite_excerpt_more' );

/**
 * Add to scroll top
 */
function biscuit_lite_scroll_to_top() {
	?>
		<a href="#top" class="smoothup" title="<?php echo esc_attr( __( 'Back to top', 'biscuit-lite' ) ); ?>"><i class="fa fa-angle-up fa-2x" aria-hidden="true"></i>
		</a>
	<?php
}
add_action('wp_footer', 'biscuit_lite_scroll_to_top');
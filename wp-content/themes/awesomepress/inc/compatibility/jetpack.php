<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package AwesomePress
 */

/**
 * Jetpack setup function.
 *
 * @see https://jetpack.com/support/infinite-scroll/
 * @see https://jetpack.com/support/responsive-videos/
 */
if (! function_exists('awesomepress_jetpack_setup') ) :

    /**
     * Jetpack setup function.
     */
    function awesomepress_jetpack_setup() 
    {

        // Add theme support for Infinite Scroll.
        add_theme_support(
            'infinite-scroll', array(
            'container' => 'main',
            'render'    => 'awesomepress_infinite_scroll_render',
            'footer'    => 'page',
            )
        );

        // Add theme support for Responsive Videos.
        add_theme_support('jetpack-responsive-videos');
    }
    add_action('after_setup_theme', 'awesomepress_jetpack_setup');

endif;

/**
 * Infinite Scroll.
 */
if (! function_exists('awesomepress_infinite_scroll_render') ) :

    /**
     * Custom render function for Infinite Scroll.
     */
    function awesomepress_infinite_scroll_render() 
    {
        /* Start the Loop */
        while ( have_posts() ) {

            the_post();
            if (is_search() ) :
                get_template_part('template-parts/content', 'search');
            else :
                get_template_part('template-parts/content', get_post_format());
            endif;

        }
    }

endif;

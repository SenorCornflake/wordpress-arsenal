<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AwesomePress
 */

get_header(); ?>

    <?php awesomepress_page_header_before(); ?>
    <header class="page-header">
        <?php if ( get_header_image() ) : ?>
            <span class="bg-overlay"></span>
        <?php endif; ?>
        <?php awesomepress_page_header_top(); ?>
        <h1 class="page-title">
            <?php if (AWESOMEPRESS_SUPPORT_FONTAWESOME ) : ?>
                <i class="fa fa-window-close-o" aria-hidden="true"></i>
            <?php endif; ?>
            <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'awesomepress'); ?>
        </h1>
        <?php awesomepress_page_header_bottom(); ?>
    </header><!-- .page-header -->
    <?php awesomepress_page_header_after(); ?>

    <div class="inner">

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <section class="error-404 not-found">

                    <div class="page-content">
                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'awesomepress'); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .page-content -->

                </section><!-- .error-404 -->

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php awesomepress_get_sidebar_page(); ?>

    </div><!-- .inner -->

<?php

get_footer();
<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
        <?php if ( have_posts() ) :  ?>
            <?php if (AWESOMEPRESS_SUPPORT_FONTAWESOME ) : ?>
                <i class="fa fa-search" aria-hidden="true"></i>
            <?php endif; ?>
            <?php printf(__('Search Results for: %s', 'awesomepress'), '<span>' . get_search_query() . '</span>'); ?>
        <?php else: ?>
            <?php if (AWESOMEPRESS_SUPPORT_FONTAWESOME ) : ?>
                <i class="fa fa-warning" aria-hidden="true"></i>
            <?php endif; ?>
            <?php esc_html_e('Nothing Found', 'awesomepress'); ?>
        <?php endif; ?>        
        </h1>

    <?php awesomepress_page_header_bottom(); ?>
    </header><!-- .page-header -->
    <?php awesomepress_page_header_after(); ?>

    <div class="inner">
        <section id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php if (have_posts() ) : ?>

                    <?php awesomepress_content_while_before(); ?>

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');

                    endwhile;
                    
                    awesomepress_content_while_after();

                    /**
                     * Pagination
                     */
                    awesomepress_pagination_before();

                    the_posts_pagination(
                        array(
                                'mid_size'  => 4,
                                'prev_text' => ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' : '' ) . __(' Previous', 'awesomepress'),
                                'next_text' => __('Next', 'awesomepress') . ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-double-right" aria-hidden="true"></i>' : '' ),
                        )
                    );

                    awesomepress_pagination_after();

                else :

                    get_template_part('template-parts/content', 'none');

                endif; ?>

            </main><!-- #main -->
        </section><!-- #primary -->
        <?php awesomepress_get_sidebar_archive(); ?>
    </div><!-- .inner -->

<?php

get_footer();

<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AwesomePress
 */

get_header(); ?>
    
    <?php awesomepress_page_header_before(); ?>
    <header class="page-header">
        <?php if ( get_header_image() || has_post_thumbnail( get_the_ID() ) ) : ?>
            <span class="bg-overlay"></span>
        <?php endif; ?>
        <?php awesomepress_page_header_top(); ?>

        <?php the_title('<h1 class="page-title">', '</h1>'); ?>
        <div class="entry-meta">
            <?php the_awesomepress_meta_author(); ?>
            <?php the_awesomepress_meta_date(); ?>
        </div><!-- .entry-meta -->

    <?php awesomepress_page_header_bottom(); ?>
    </header><!-- .page-header -->
    <?php awesomepress_page_header_after(); ?>

    <div class="inner">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php awesomepress_content_while_before(); ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part('template-parts/content', get_post_format());

                    /**
                     * Pagination
                     */
                    awesomepress_pagination_before();

                    the_post_navigation(
                        array(
                            'prev_text' => ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<span class="link-icon"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>' : '' ) . '<span class="link-wrap"><span class="link-caption">' . sprintf( __('Previous Article %s', 'awesomepress'), '</span><span class="link-title">%title</span></span>' ),
                            'next_text' => '<span class="link-wrap"><span class="link-caption">' . sprintf( __('Next Article %s', 'awesomepress'), '</span><span class="link-title">%title</span></span>' ) . ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<span class="link-icon"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>' : '' ),
                        )
                    );

                    awesomepress_pagination_after();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number() ) :
                        awesomepress_comments_template_before();
                        comments_template();
                        awesomepress_comments_template_after();
                    endif;

                endwhile; // End of the loop.
                ?>

                <?php awesomepress_content_while_after(); ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php awesomepress_get_sidebar_single(); ?>
    </div><!-- .inner -->

<?php

get_footer();

<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

        <?php awesomepress_the_archive_title(); ?>
        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>

        <?php awesomepress_page_header_bottom(); ?>
    </header><!-- .page-header -->
    <?php awesomepress_page_header_after(); ?>

    <div class="inner">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php if (have_posts() ) : ?>

                    <?php awesomepress_content_while_before(); ?>

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /*
                        * Include the Post-Format-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                        */
                        get_template_part('template-parts/content', get_post_format());

                    endwhile;
                    ?>

                    <?php awesomepress_content_while_after(); ?>

                    <?php awesomepress_pagination_before(); ?>

                    <?php
                    /* Pagination */
                    the_posts_pagination(
                        array(
                            'mid_size'  => 4,
                            'prev_text' => ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' : '' ) . __(' Previous', 'awesomepress'),
                            'next_text' => __('Next', 'awesomepress') . ( ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-angle-double-right" aria-hidden="true"></i>' : '' ),
                        )
                    );
                    ?>

                    <?php awesomepress_pagination_after(); ?>

                <?php else : ?>

                    <?php get_template_part('template-parts/content', 'none'); ?>

                <?php endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php awesomepress_get_sidebar_archive(); ?>
    </div><!-- .inner -->

<?php 

get_footer();

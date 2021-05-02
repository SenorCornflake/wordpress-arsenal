<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

                    get_template_part('template-parts/content', 'page');

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
        <?php awesomepress_get_sidebar_page(); ?>
    </div><!-- .inner -->

<?php

get_footer();

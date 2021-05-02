<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AwesomePress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php awesomepress_entry_content_before(); ?>
    <div class="entry-content">
        <?php awesomepress_entry_content_top(); ?>

        <?php
        /* translators: %s: Name of current post */
        the_content(
            sprintf(
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'awesomepress'),
                get_the_title()
            )
        );

        wp_link_pages(
            array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'awesomepress'),
                    'after'  => '</div>',
            )
        );
        ?>

        <?php awesomepress_entry_content_bottom(); ?>
    </div><!-- .entry-content -->
    <?php awesomepress_entry_content_after(); ?>

    <?php if (get_edit_post_link() ) : ?>

        <?php awesomepress_entry_footer_before(); ?>
        <footer class="entry-footer">
            <?php awesomepress_entry_footer_top(); ?>

            <?php awesomepress_entry_footer(); ?>

            <?php awesomepress_entry_footer_bottom(); ?>
        </footer><!-- .entry-footer -->
        <?php awesomepress_entry_footer_after(); ?>

    <?php endif; ?>
</article><!-- #post-## -->

<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AwesomePress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! is_singular( ) ) : ?>
        <?php awesomepress_entry_header_before(); ?>
        <header class="entry-header">
        <?php awesomepress_entry_header_top(); ?>

            <?php if ('post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php the_awesomepress_meta_category(); ?>
                    <?php // the_awesomepress_meta_author(); ?>
                    <?php the_awesomepress_meta_date( true, false ); ?>
                    <?php the_awesomepress_meta_comments(); ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>

            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php awesomepress_entry_header_bottom(); ?>
        </header><!-- .entry-header -->
        <?php awesomepress_entry_header_after(); ?>
    <?php endif; ?>

    <?php
    if( is_singular() ) {
        awesomepress_entry_content_before(); ?>
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
        <?php
        awesomepress_entry_content_after();
    } else {
        ?>
        <div class="entry-summary">
        <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php } ?>

    <?php awesomepress_entry_footer_before(); ?>
    <footer class="entry-footer">
    <?php awesomepress_entry_footer_top(); ?>

    <?php
    if( is_single() && 'post' === get_post_type() ) {
        the_awesomepress_meta_tags();
    }
    ?>

    <?php edit_post_link( __( 'Edit', 'awesomepress' ), '<span class="edit-link">', '</span>' ); ?>

    <?php awesomepress_entry_footer(); ?>

    <?php awesomepress_entry_footer_bottom(); ?>
    </footer><!-- .entry-footer -->
    <?php awesomepress_entry_footer_after(); ?>

</article><!-- #post-## -->

<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AwesomePress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php awesomepress_entry_header_before(); ?>
    <header class="entry-header">
        <?php awesomepress_entry_header_top(); ?>

        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php awesomepress_entry_header_bottom(); ?>
    </header><!-- .entry-header -->
    <?php awesomepress_entry_header_after(); ?>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <?php awesomepress_entry_footer_before(); ?>
    <footer class="entry-footer">
        <?php awesomepress_entry_footer_top(); ?>

        <?php awesomepress_entry_footer(); ?>

        <?php awesomepress_entry_footer_bottom(); ?>
    </footer><!-- .entry-footer -->
    <?php awesomepress_entry_footer_after(); ?>

</article><!-- #post-## -->

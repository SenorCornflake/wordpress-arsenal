<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AwesomePress
 */

?>
    <?php awesomepress_content_bottom(); ?>
    </div><!-- #content -->
    <?php awesomepress_content_after(); ?>

    <?php awesomepress_footer_before(); ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
    <?php awesomepress_footer_top(); ?>

        <div class="site-info">
            <a href="<?php echo esc_url(__('https://wordpress.org/', 'awesomepress')); ?>">
                <?php printf( esc_html__('Proudly powered by %s', 'awesomepress'), 'WordPress'); ?>
            </a>
            <span class="sep"> <?php _e('|', 'awesomepress'); ?> </span>
            <?php printf(esc_html__('Theme: %1$s', 'awesomepress'), '<a href="http://surror.com/" rel="designer">AwesomePress</a>'); ?>
        </div><!-- .site-info -->

    <?php awesomepress_footer_bottom(); ?>
    </footer><!-- #colophon -->
    <?php awesomepress_footer_after(); ?>

</div><!-- #page -->

<?php awesomepress_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>

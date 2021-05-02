<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AwesomePress
 * @since   1.0.0
 */

?><!DOCTYPE html>
<?php awesomepress_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php awesomepress_head_top(); ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php awesomepress_head_bottom(); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php awesomepress_body_top(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'awesomepress'); ?></a>

    <?php awesomepress_header_before(); ?>
    <header id="masthead" class="site-header" role="banner">
    <?php awesomepress_header_top(); ?>

        <div class="site-branding">
            <?php the_custom_logo(); ?>
            <?php if (is_front_page() && is_home() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php $description = get_bloginfo('description', 'display'); ?>
            <?php if ($description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php if (AWESOMEPRESS_SUPPORT_FONTAWESOME ) : ?>
                    <i class="fa fa-reorder" aria-hidden="true"></i>
                <?php endif; ?>
                <?php esc_html_e('Primary Menu', 'awesomepress'); ?>
            </button>
            <?php wp_nav_menu(array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' )); ?>
        </nav><!-- #site-navigation -->

    <?php awesomepress_header_bottom(); ?>
    </header><!-- #masthead -->

    <?php awesomepress_header_after(); ?>

    <?php awesomepress_content_before(); ?>
    <div id="content" class="site-content">
    <?php awesomepress_content_top(); ?>

<?php
/**
 * The Sidebar containing the Sidebar
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */
if (  ! is_active_sidebar( 'sidebar-2' )
	&& ! is_active_sidebar( 'sidebar-3' )
	&& ! is_active_sidebar( 'sidebar-4' )
	) {
return;
}
?>

	<div class="sidebar-footer clear">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="sidebar-2" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div id="sidebar-3" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div id="sidebar-4" class="widget-area column third" role="complementary">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
	</div><!-- #contact-sidebar -->
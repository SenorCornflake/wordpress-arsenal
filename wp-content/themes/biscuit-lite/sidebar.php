<?php
/**
 * The Sidebar containing the Sidebar
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */
?>

	<?php
		if (   ! is_active_sidebar( 'sidebar-1' ) )
			return;
	?>

	<div id="secondary" class="column fourth">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div id="sidebar-1" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
	</div><!-- #contact-sidebar -->
<?php
/**
 * The template for displaying the footer.
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */
?>

		</div><!-- #content -->

	</div><!-- .container -->

		<footer id="colophon" class="site-footer" role="contentinfo">


			
			<div class="container">

				<div class="site-info">

					<?php get_sidebar('footer'); ?>

					<?php if ( get_theme_mod( 'biscuit_lite_footer' ) ) : ?>
						
						<?php echo esc_attr( get_theme_mod( 'biscuit_lite_footer' ) ); ?>
					
					<?php else : ?>

						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'biscuit-lite' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'biscuit-lite' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'biscuit-lite' ), 'biscuit-lite', '<a href="https://pankogut.com/">Pankogut.com</a>' );
						?>
					
					<?php endif; ?>

				</div><!-- .site-info -->

			</div><!-- .container -->
			
		</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

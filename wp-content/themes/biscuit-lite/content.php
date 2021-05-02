<?php
/**
 * The template used for displaying content
 *
 * @package biscuit-lite
 * @since biscuit-lite 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				biscuit_lite_posted_on();
				biscuit_lite_posted_by();
				?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'biscuit-lite' ), __( '1 Comment', 'biscuit-lite' ), __( '% Comments', 'biscuit-lite' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Read more', 'biscuit-lite' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'biscuit-lite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php biscuit_lite_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		
	</article><!-- #post-## -->

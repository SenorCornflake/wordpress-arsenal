<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AwesomePress
 */

/**
 * Get sidebar for single page
 */
if ( ! function_exists( 'awesomepress_get_sidebar_page' ) ) :

	/**
	 * Get sidebar for single page, custom post type etc.
	 *
	 * @see awesomepress_get_sidebar_layout()
	 * @see awesomepress_get_option()
	 */
	function awesomepress_get_sidebar_page() {
		awesomepress_get_sidebar_layout( awesomepress_get_option( 'sidebar-page' ) );
	}

endif;

/**
 * Get sidebar for single post
 */
if ( ! function_exists( 'awesomepress_get_sidebar_single' ) ) :

	/**
	 * Get sidebar for single post only.
	 *
	 * @see awesomepress_get_sidebar_layout()
	 * @see awesomepress_get_option()
	 */
	function awesomepress_get_sidebar_single() {
		awesomepress_get_sidebar_layout( awesomepress_get_option( 'sidebar-single' ) );
	}

endif;

/**
 * Get sidebar for archive pages
 */
if ( ! function_exists( 'awesomepress_get_sidebar_archive' ) ) :

	/**
	 * Get sidebar for archive pages ( tag, category, date ) and search page.
	 *
	 * @see awesomepress_get_sidebar_layout()
	 * @see awesomepress_get_option()
	 */
	function awesomepress_get_sidebar_archive() {
		awesomepress_get_sidebar_layout( awesomepress_get_option( 'sidebar-archive' ) );
	}

endif;

/**
 * Archive Title
 */
if ( ! function_exists( 'awesomepress_the_archive_title' ) ) :

	/**
	 * Archive Title
	 */
	function awesomepress_the_archive_title() {

		// vl( get_the_author_meta('ID') );
		// wp_die();

		$icons = array(
			'tag'      => ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-tag" aria-hidden="true"></i>' : '',
			'category' => ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-folder" aria-hidden="true"></i>' : '',
			'date'     => ( AWESOMEPRESS_SUPPORT_FONTAWESOME ) ? '<i class="fa fa-calendar" aria-hidden="true"></i>' : '',
			'author'   => get_avatar( get_the_author_meta( 'ID' ), 50 ),
		);

		if ( is_tag() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_category() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_date() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['tag'], '</h1>' );
		} elseif ( is_author() ) {
			the_archive_title( '<h1 class="page-title"> ' . $icons['author'], '</h1>' );
		} else {
			the_archive_title( '<h1 class="page-title">', '</h1>' );
		}
	}

endif;

/**
 * Date Meta
 */
if ( ! function_exists( 'the_awesomepress_meta_date' ) ) :
	function the_awesomepress_meta_date( $echo = true, $show_date_text = true ) {
		ob_start();
		?>
		<span class="meta-date">
			<span class="posted-on">
				<?php

				if( $show_date_text ) {
					_ex( 'Last updated on ', 'Article last written on date', 'awesomepress' );
				}

				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
				}
				$time_string = sprintf( $time_string,
				    esc_attr( get_the_date( 'c' ) ),
				    esc_html( get_the_date() ),
				    esc_attr( get_the_modified_date( 'c' ) ),
				    esc_html( get_the_modified_date() )
				);
				?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php echo $time_string; ?>
				</a>
			</span>
		</span>
		<?php
		$date_meta = ob_get_clean();

		if( $echo ) {
			echo $date_meta;
		} else {
			return $date_meta;
		}
	}
endif;

/**
 * Tags Meta
 */
if ( ! function_exists( 'the_awesomepress_meta_tags' ) ) :
	function the_awesomepress_meta_tags() {
		$tags_list = get_the_tag_list();
        if ( $tags_list ) { ?>
            <span class="meta-tag">
                <?php printf( __( 'Tagged with: <span class="tags-links">%s</span>', 'awesomepress' ), $tags_list ); ?>
            </span>
            <span class="sep"><?php _e( '|', 'awesomepress' ); ?></span>
        <?php }
	}
endif;

/**
 * Comments Meta
 */
if ( ! function_exists( 'the_awesomepress_meta_comments' ) ) :
	function the_awesomepress_meta_comments() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<span class="sep"><?php _e( '|', 'awesomepress' ); ?></span>
			<span class="comments-link">
				<?php
				/* translators: %s: post title */
				echo comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'awesomepress' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
				?>
			</span>
			<?php
		}
	}
endif;

/**
 * Category Meta
 */
if ( ! function_exists( 'the_awesomepress_meta_category' ) ) :
	function the_awesomepress_meta_category() {
		$categories_list = get_the_category_list( esc_html__( ', ', 'awesomepress' ) );

		if ( $categories_list && awesomepress_categorized_blog() ) {
			?>
			<span class="meta-category">
				<span class="cat-links">
					<?php echo $categories_list; ?>
				</span>
			</span>
			<?php
		}
	}
endif;

/**
 * Author Meta
 */
if ( ! function_exists( 'the_awesomepress_meta_author' ) ) :
	function the_awesomepress_meta_author() {
		global $post;
		?>
		<span class="meta-author">
            <span class="byline">
                <span class="author vcard">
                    <?php _ex( 'By ', 'Article written by', 'awesomepress' ); ?>
                    <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
                        <?php echo get_avatar( $post->post_author, 35 ); ?>
                        <?php echo esc_html( get_the_author() ); ?>
                    </a>
                </span>
            </span>
        </span>
        <?php
	}
endif;

/**
 * Category blog
 */
if ( ! function_exists( 'awesomepress_categorized_blog' ) ) :

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function awesomepress_categorized_blog() {

		if ( false === ( $all_the_cool_cats = get_transient( 'awesomepress_categories' ) ) ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'awesomepress_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so awesomepress_categorized_blog should return true.
			return true;

		} else {
			// This blog has only 1 category so awesomepress_categorized_blog should return false.
			return false;
		}
	}

endif;

/**
 * Flush out the transients
 */
if ( ! function_exists( 'awesomepress_category_transient_flusher' ) ) :

	/**
	 * Flush out the transients used in awesomepress_categorized_blog.
	 */
	function awesomepress_category_transient_flusher() {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Like, beat it. Dig?
		delete_transient( 'awesomepress_categories' );
	}
	add_action( 'edit_category', 'awesomepress_category_transient_flusher' );
	add_action( 'save_post',     'awesomepress_category_transient_flusher' );

endif;

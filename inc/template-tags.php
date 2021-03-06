<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package my_first_theme_for-block
 */
/**
 * Table of Contents:
 * Logo & Description - добавить
 * posted_on (date published)
 * posted_by (author)
 * 
 * post_thumbnail
 */

if ( ! function_exists( 'raspellab_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function raspellab_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
				
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			raspellab_get_icon_svg( 'calendar', 16 ),
			esc_url( get_permalink() ),
			$time_string
		);

	}
endif;


if ( ! function_exists( 'raspellab_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function raspellab_posted_by() {
		printf(
			/* translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link. */
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			raspellab_get_icon_svg( 'person', 16 ),
			__( 'Posted by', 'raspellab' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

// Comments link.
if ( ! function_exists( 'raspellab_comment_link' ) ) :
	/**
	 * Prints HTML with the comment link for the current post.
	 */
	function raspellab_comment_link() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo raspellab_get_icon_svg( 'comment', 16 );

			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'raspellab' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

// Categories.
function raspellab_category_list() {
	/* translators: used between list items, there is a space after the comma. */
	$categories_list = get_the_category_list( esc_html__( ', ', 'raspellab' ) );
	if ( $categories_list ) {
		printf(
			/* translators: 1: SVG icon. 2: Posted in - screen reader text. 3: List of categories. */
			'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
			raspellab_get_icon_svg( 'category', 16 ),
			esc_html__( 'Posted in', 'raspellab' ),
			$categories_list
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Tags.
function raspellab_tag_list() {
	/* translators: used between list items, there is a space after the comma. */
	$tags_list = get_the_tag_list( '', __( ', ', 'raspellab' ) );
	if ( $tags_list ) {
		printf(
			/* translators: 1: SVG icon. 2: Posted in - screen reader text. 3: List of tags. */
			'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
			raspellab_get_icon_svg( 'tag', 16 ),
			__( 'Tags:', 'raspellab' ),
			$tags_list
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'raspellab_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function raspellab_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			// Categories.
			raspellab_category_list();

			// Tags.
			raspellab_tag_list();

		}

		// Comment link.
			raspellab_comment_link();
		

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'raspellab' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">' . raspellab_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'raspellab_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function raspellab_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="ct-post-end-section">
	<div class="ct-post-actions" style="height: 115px;">
		<div class="ct-post-nav is-visible">
			<div class="ct-post-nav-container">
				<div class="ct-post-nav-content">
					<div class="left">
						<a href="#" class="follow btn-follow followed acted">
							<span class="cticon-follow"></span>
							<span class="btn-text">Following</span>
						</a>
					</div>
					<div class="right">
						<div class="actions">
							<a href="javascript:void(0)" class="btn-comment">
								<span class="cticon-bubbles"></span>
								<?php if ( have_comments() ) {
									get_comments_number();
								} else {
									echo '0';
								} ?>
							</a>
							<span class="splitter"></span>
							<?php
							$urlencode_permalink = urlencode( get_permalink() );
							if ( has_post_thumbnail() ) {
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
								if ( ! empty( $large_image_url[0] ) ) {
									$post_image_url = $large_image_url[0];
								}
								else {
									$post_image_url = '';
								}
							}
							$urlencode_image = urlencode( $post_image_url );
							$urlencode_excerpt = urlencode( get_the_excerpt() );
							$urlencode_title = urlencode( get_the_title() );
							?>
							<div class="share-icons">
								<a class="fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlencode_permalink ?>">
									<span class="cticon-facebook"></span>
								</a>
								<a class="pin" href="http://pinterest.com/pin/create/button/?url=<?php echo $urlencode_permalink; ?>&media=<?php echo $urlencode_image; ?>&description=<?php echo $urlencode_excerpt; ?>">
									<span class="cticon-pinterest"></span>
								</a>
								<a class="share-more">
									<span class="cticon-more-fill"></span>
								</a>
								<a class="tw" href="https://twitter.com/intent/tweet?url=<?php echo $urlencode_permalink ?>">
									<span class="cticon-twitter"></span>
								</a>
								<a class="yum" href="http://www.yummly.com/urb/verify?url=<?php echo $urlencode_permalink; ?>&title=<?php echo $urlencode_title; ?>&image=<?php echo $urlencode_image; ?>">
									<span class="cticon-yum"></span>
								</a>
							</div>
						</div>
						<a href="javascript:void(0)" class="share-on-mobile">
							<span class="cticon-share-alternitive"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="comment-block abs">
			<div class="ct-comment-trigger">
				<a data-reactid="218">Leave a comment...</a>
			</div>
		</div>
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'a-little-bit-of-spice' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'a-little-bit-of-spice' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'a-little-bit-of-spice' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'a-little-bit-of-spice' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'a-little-bit-of-spice' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'a-little-bit-of-spice' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'a-little-bit-of-spice' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().
	?>

</div><!-- #comments -->

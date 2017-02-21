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
									echo get_comments_number();
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
	</div>
</div><!-- #comments -->

<div class="ctmodal">
	<div class="overlay-content animatedquick easeInRight-appear">
		<div class="overlay-header">
			<h3><?php the_title(); ?></h3>
			<div class="right clearfix">
				<a class="close-panel" href="javascript:;">
					<span class="cticon-cross"></span>
				</a>
			</div>
		</div>
		<div class="overlay-body">
			<div class="comment-proof">
				<div class="sectional">
					<ul class="items">
						<li class="active">
							<h5>
								<span class="comment-count">
									<?php echo comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
								</span>
							</h5>
						</li>
					</ul>
				</div>
				<div id="post-comments" class="overlay-comments">
					<div class="comments-list clearfix">
						<ul>
							<?php
							$post_comments = get_comments( array( 'post_id' => get_the_ID() ) );
							foreach( $post_comments as $comment ): ?>
							<li class="comment-block comment-item" id="comment-<?php echo $comment->comment_ID; ?>">

								<?php if ( $comment->comment_author_url ): ?>
									<a class="ct-usr" href="<?php echo $comment->comment_author_url; ?>">
										<?php echo get_avatar( $comment->comment_author_email, 50, '', $comment->comment_author, array( 'class' => 'tiny-profile' ) ); ?>
									</a>
								<?php else: ?>
									<span class="ct-usr">
										<?php echo get_avatar( $comment->comment_author_email, 50, '', $comment->comment_author, array( 'class' => 'tiny-profile' ) ); ?>
									</span>
								<?php endif; ?>

								<div class="comment" itemprop="review" itemscope="" itemtype="http://schema.org/Review">
									<p>
										<span class="commenter">
											<meta itemprop="author" content="<?php echo $comment->comment_author; ?>">
											<?php if ( $comment->comment_author_url ): ?>
												<a href="<?php echo $comment->comment_author_url; ?>"><?php echo $comment->comment_author; ?></a>
											<?php else: ?>
												<?php echo $comment->comment_author; ?>
											<?php endif; ?>
										</span>
										<span itemprop="reviewBody" class="comment-text expandable">
											<?php echo $comment->comment_content; ?>
										</span>
									</p>
									<div class="timestamp">
										<span class="stamp">
											<?php
											$timestamp = strtotime( $comment->comment_date );
											if ( $timestamp > date( 'U' ) - 60*60*24*365 ) {
												// if current date is over a year, show time ago
												$timeago = human_time_diff( $timestamp, current_time('timestamp') ) . ' ago';
											} else {
												// otherwise, show full date
												$timeago = date( 'F jS, Y', $timestamp );
											}
											?>
											<time itemprop="datePublished" content="<?php echo $comment->comment_date; ?>" class="timeago" datetime="<?php echo $comment->comment_date; ?>" title="<?php echo date( 'F jS Y, H:i:s', $timestamp ); ?>">
												<?php echo $timeago; ?>
											</time>
										</span>
									</div>
									<meta itemprop="itemReviewed" content="<?php the_title(); ?>">
								</div>
							</li>
							<?php endforeach; ?>

							<li class="comment-block comment-form-block" style="display: block;">
								<?php
								$current_user = wp_get_current_user();
								$commenter = wp_get_current_commenter();
								$req = get_option( 'require_name_email' );
								$aria_req = ( $req ? " aria-required='true'" : '' );

								$fields =  array(
								  'author' =>
								    '<div class="comment-content comment">' .
										( $req ? '<span class="required">*</span>' : '' ) .
								    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
								    '" size="30" placeholder="Your name"' . $aria_req . ' /></div>',

								  'email' =>
								    '<div class="comment-content comment">' .
										( $req ? '<span class="required">*</span>' : '' ) .
								    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
								    '" size="30" placeholder="Email address"' . $aria_req . ' /></div>',

								  'url' =>
								    '<div class="comment-content comment">' .
								    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
								    '" size="30" placeholder="Your website" /></div>',
								);
								$comment_form_args = array(
									'class_submit' => 'btn btn-success btn-sm post-this submit-help',
									'label_submit' => 'Post Comment',
									'comment_field' => '<div class="comment-content comment"><span class="required">*</span><textarea id="comment" name="comment" aria-required="true" placeholder="Leave a comment..." style="height: 98px;"></textarea></div>',
									'title_reply' => '',
									'title_reply_before' => '',
									'title_reply_after' => '',
									'logged_in_as' => '<div class="dp">'.
																			'<span class="ct-usr">'.
																				get_avatar( $current_user->user_email, 50, '', $current_user->display_name, array( 'class' => 'tiny-profile' ) ).
																			'</span>'.
																		'</div>',
									'fields' => apply_filters( 'comment_form_default_fields', $fields )
								);

								comment_form( $comment_form_args ); ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- .ctmodal -->

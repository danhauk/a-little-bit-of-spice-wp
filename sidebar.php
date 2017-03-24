<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_Little_Bit_of_Spice
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar" role="complementary">
	<div class="inner-container">
		<div class="blog-logo">
			<div class="logo-area">
				<a class="logo-image" href="/">
					<?php echo get_custom_logo(); ?>
					<span class="sr-only" data-reactid="166">A Little Bit of Spice</span>
				</a>
			</div>
		</div>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

		<?php if ($_SERVER['HTTP_HOST'] == 'wp.dev:8888') {
			$form_id = 'html58d46cb53662a-1';
		} else {
			$form_id = 'html58d46dc88fe5c-1';
		} ?>
		<div class="widget_wysija_cont html_wysija">
			<div id="msg-form-wysija-<?php echo $form_id; ?>" class="wysija-msg ajax"></div>
			<form id="form-wysija-<?php echo $form_id; ?>" method="post" action="#wysija" class="widget_wysija html_wysija">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/subscribe-a.png" alt="Get new posts in your email!" />
				<p class="wysija-paragraph">
					<input type="email" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="Email"  value="" placeholder="Enter email address" />
					<span class="abs-req">
						<input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
					</span>
				</p>
				<input class="wysija-submit wysija-submit-field" type="submit" value="Subscribe" />

				<input type="hidden" name="form_id" value="1" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="controller" value="subscribers" />
				<input type="hidden" value="1" name="wysija-page" />
        <input type="hidden" name="wysija[user_list][list_ids]" value="1" />
 			</form>
		</div>

		<?php if ( is_single() ) {
			$cats = wp_get_post_categories( $post->ID );
			if ( $cats ) {
				$args = array(
					'category__in' => $cats,
					'post__not_in' => array( $post->ID ),
					'posts_per_page' => 5,
					'orderby' => 'rand',
					'ignore_sticky_posts' => true
				);
				$related_posts = new WP_Query( $args );

				if ( $related_posts->have_posts() ): ?>

					<div class="similar-posts clearfix">
						<h3>Similar Posts</h3>
						<ul class="ct-similar-posts">
							<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
								<li>
									<article class="similar-card">
										<div class="similar-post-wrapper">
											<div class="img-holder">
												<a class="thumb img-link" href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'medium_large' ); ?>
												</a>
											</div>
											<h3>
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
										</div>
									</article>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php
				endif;
				wp_reset_query();
			} // if post has categories
		} // if is_single() ?>
	</div>
</aside><!-- #secondary -->

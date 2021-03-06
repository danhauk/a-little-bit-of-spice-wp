<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

?><div class="card">
	<article>
		<div class="container">
			<div class="img-shell">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<span class="fade-In img-holder">
						<?php the_post_thumbnail(); ?>
					</span>
				</a>
			</div>
			<div class="text-area">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="dummy-link"></a>
				<h4>
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php the_title(); ?>
					</a>
				</h4>
				<p><?php the_excerpt(); ?></p>
			</div>
		</div>
	</article>
</div>

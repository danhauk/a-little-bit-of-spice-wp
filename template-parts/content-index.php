<?php
/**
 * Template part for displaying posts on index.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'thumbnail recipe-listing' ); ?>>
	<div class="post-snippet">
		<h2 class="entry-title">
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<div class="snippet-wrapper">
			<div class="img-holder">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="thumb img-link">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
			<div class="text-holder">
				<p><?php the_excerpt(); ?></p>
			</div>
		</div><!-- .snippet-wrapper -->
	</div><!-- .post-snippet -->
</article><!-- #post-## -->

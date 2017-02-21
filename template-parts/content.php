<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

?>

<div class="ct-post-content">
	<?php the_content(); ?>

	<?php comments_template(); ?>
</div><!-- #post-## -->

<div class="post-meta">
	<?php if ( has_category() ): ?>
	<article>
		<span>Posted under:</span>
		<ul class="ct-post-categories">
			<?php
			$post_categories = get_the_category();
			foreach( $post_categories as $category ) {
				echo "<li><a href='/category/{$category->slug}'>{$category->name}</a></li>";
			} ?>
		</ul>
	</article>
	<?php endif; ?>
</div>

<?php
/**
 * Template part for displaying posts on index.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

?>
<li>
	<h2>
		<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="snippet-wrapper">
		<div class="img-holder">
			<a href="<?php echo get_permalink(); ?>" class="thumb img-link">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</div>
		<div class="text-holder">
			<?php the_excerpt(); ?>
		</div>
	</div>
</li>

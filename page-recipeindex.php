<?php
/*
Template Name: Recipe Index
Template Post Type: page
*/

/**
 * The template for displaying the recipe index at /index/.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

get_header(); ?>

	<div id="primary" class="main-pillar generic collection">
		<main id="main" class="content-limiter" role="main">
			<div class="masthead">
				<div class="logo-area">
					<a class="logo-image" href="/">
						<?php the_custom_logo(); ?>
						<span class="sr-only"><?php echo get_bloginfo( 'name' ); ?></span>
					</a>
				</div>

				<div class="page-header">
					<label class="property-name">Index</label>
					<h1 class="page-head">Recipe Index</h1>
				</div>
			</div>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'recipeindex' );

			endwhile; // End of the loop.
			?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

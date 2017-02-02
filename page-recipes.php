<?php
/*
Template Name: Homepage Recipes
Template Post Type: post, page, recipe
*/

/**
 * The template for displaying the blog index of recipes.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

get_header(); ?>

	<div id="primary" class="main-pillar">
		<main id="main" class="content-limiter" role="main">
			<div class="masthead">
				<div class="logo-area">
					<a class="logo-image" href="/">
						<?php the_custom_logo(); ?>
						<span class="sr-only"><?php echo get_bloginfo( 'name' ); ?></span>
					</a>
				</div>
			</div>

		<?php
		$recipes = new WP_Query( array( 'post_type' => 'recipe', 'posts_per_page' => -1 ) );

		if ( $recipes->have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			// start the loop
			while ( $recipes->have_posts() ) : $recipes->the_post();

				get_template_part( 'template-parts/content', 'index' );

			endwhile; // End of the loop.
			wp_reset_query();

		endif; // End if have_posts()
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

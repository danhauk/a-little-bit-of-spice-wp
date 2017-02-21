<?php
/*
Template Name: Homepage Recipes
Template Post Type: page
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
		// set number of posts to display
		$display_count = 1;
		// get current page
		$page = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
		// calculate offset
		$offset = ( $page - 1 ) * $display_count;

		// query args
		$recipe_query_args = array(
			'post_type' => 'recipe',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => $display_count,
			'page' => $page,
			'offset' => $offset
		);
		$recipes = new WP_Query( $recipe_query_args );

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
			?>

			<div class="paginate">
				<?php if ( $page != 1 ): ?>
				<div class="prev">
					<a class="btn" href="/page/<?php echo $page-1; ?>">
						<span class="cticon-back"></span> Newer Posts
					</a>
				</div>
				<?php endif; ?>
				<?php if ( $page != $recipes->max_num_pages ): ?>
				<div class="next">
					<a class="btn" href="/page/<?php echo $page+1; ?>">
						Older Posts <span class="cticon-front"></span>
					</a>
				</div>
				<?php endif; ?>
			</div>

			<?php wp_reset_postdata();

		endif; // End if have_posts()
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

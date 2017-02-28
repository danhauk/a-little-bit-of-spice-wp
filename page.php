<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package A_Little_Bit_of_Spice
 */

global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
$url_pagename = explode( '=', $current_url );
$pagename = $url_pagename[1];
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

			<?php if ($pagename == 'index'): ?>
			<div class="page-header">
				<label class="property-name">Index</label>
				<h1 class="page-head">Recipe Index</h1>
			</div>
			<?php endif; ?>
		</div>

		<?php
		while ( have_posts() ) : the_post();

			if ( $pagename == 'index' ) {
				get_template_part( 'template-parts/content', 'recipeindex' );
			}
			else {
				get_template_part( 'template-parts/content', 'page' );
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

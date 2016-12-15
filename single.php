<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package A_Little_Bit_of_Spice
 */

get_header(); ?>

	<div id="primary" class="main-pillar">
		<main id="main" class="content-limiter" role="main">
			<?php
			while( have_posts() ) : the_post();
			?>
			<div class="masthead">
				<div class="logo-area">
					<a class="logo-image" href="/">
						<?php the_custom_logo(); ?>
						<span class="sr-only"><?php echo get_bloginfo( 'name' ); ?></span>
					</a>
				</div>
				<div class="page-header">
					<h1><?php the_title(); ?></h1>
				</div>
			</div>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

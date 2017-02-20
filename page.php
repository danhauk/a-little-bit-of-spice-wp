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
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

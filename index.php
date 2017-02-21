<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-index', get_post_format() );

			endwhile;

			?>

			<div class="paginate">
				<div class="prev">
					<span class="btn">
						<?php if( get_next_posts_link() ) {
							next_posts_link('<span class="cticon-back"></span> Newer Posts');
						} ?>
					</span>
				</div>
				<div class="next">
					<span class="btn">
						<?php if( get_previous_posts_link() ) {
							previous_posts_link('Older Posts <span class="cticon-front"></span>');
						} ?>
					</span>
				</div>
			</div>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

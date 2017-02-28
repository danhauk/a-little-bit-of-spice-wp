<?php
/**
 * The template for displaying archive pages.
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
				<?php the_archive_title( '<h1 class="page-head">', '</h1>' ); ?>
			</div>
		</div>

		<div class="collections clearfix">

		<?php
		if ( have_posts() ) : ?>

			<ul class="dishes">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile; ?>

			</ul>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</div> <!-- .collections -->

		<div class="paginate">
			<div class="prev">
				<?php if( get_previous_posts_link() ) {
					echo '<span class="btn">';
					previous_posts_link('<span class="cticon-back"></span> Newer Posts');
					echo '</span>';
				} ?>
			</div>
			<div class="next">
				<?php if( get_next_posts_link() ) {
					echo '<span class="btn">';
					next_posts_link('Older Posts <span class="cticon-front"></span>');
					echo '</span>';
				} ?>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

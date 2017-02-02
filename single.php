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
					<div class="ct-share-widgets-wrapper">
						<?php
						$urlencode_permalink = urlencode( get_permalink() );
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							if ( ! empty( $large_image_url[0] ) ) {
								$post_image_url = $large_image_url[0];
							}
							else {
								$post_image_url = '';
							}
						}
						$urlencode_image = urlencode( $post_image_url );
						$urlencode_excerpt = urlencode( get_the_excerpt() );
						$urlencode_title = urlencode( get_the_title() );
						?>
						<ul class="ct-share-widgets">
							<li>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlencode_permalink ?>"><span class="share-icon facebook"></span></a>
							</li>
							<li>
								<a href="https://twitter.com/intent/tweet?url=<?php echo $urlencode_permalink ?>"><span class="share-icon twitter"></span></a>
							</li>
							<li>
								<a href="http://pinterest.com/pin/create/button/?url=<?php echo $urlencode_permalink; ?>&media=<?php echo $urlencode_image; ?>&description=<?php echo $urlencode_excerpt; ?>"><span class="share-icon pinterest"></span></a>
							</li>
							<li>
								<a href="http://www.yummly.com/urb/verify?url=<?php echo $urlencode_permalink; ?>&title=<?php echo $urlencode_title; ?>&image=<?php echo $urlencode_image; ?>"><span class="share-icon yummly"></span></a>
							</li>
						</ul>
					</div>
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

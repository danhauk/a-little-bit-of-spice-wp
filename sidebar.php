<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_Little_Bit_of_Spice
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar" role="complementary">
	<div class="inner-container">
		<div class="blog-logo">
			<div class="logo-area">
				<a class="logo-image" href="/">
					<?php echo get_custom_logo(); ?>
					<span class="sr-only" data-reactid="166">A Little Bit of Spice</span>
				</a>
			</div>
		</div>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->

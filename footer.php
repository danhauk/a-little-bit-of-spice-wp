<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_Little_Bit_of_Spice
 */

?>

		</div><!-- .content -->

		<div class="footer">
			<div class="main-pillar">
				<div class="content-limiter">
					<footer>
						<div class="ct-footer">
							&copy; <?php echo get_bloginfo( 'name' ); ?>.
							<div class="credit">
								Powered by &nbsp;<a href="https://wordpress.org" target="_blank">WordPress</a>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>
	</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

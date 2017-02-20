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

<?php if ( is_search() ) { ?>
		</div> <!-- .search-page -->

		<header class="header ctheader animate-transform no-scroll search">
			<form id="searchid_form" method="GET" action="/">
				<span class="cticon-search"></span>
				<input id="q" name="q" type="textarea" value="<?php echo ( isset( $_GET['s'] ) ? $_GET['s'] : '' ); ?>" placeholder="Search" class="noauto" autocomplete="off">
				<div class="controls right">
					<a href="#" class="reset-filter reset hide" style="display: none;">
						<span class="cticon-filter-reset"></span>
					</a>
					<a href="#" class="cancel" data-action="http://www.alittlebitofspice.com/">
						<span class="cticon-cross"></span>
					</a>
				</div>
			</form>
		</header>
<?php } else { ?>
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
<?php } ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

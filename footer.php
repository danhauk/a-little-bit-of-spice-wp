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
				<input id="s" name="s" type="textarea" value="<?php echo ( isset( $_GET['s'] ) ? $_GET['s'] : '' ); ?>" placeholder="Search" class="noauto" autocomplete="off">
				<div class="controls right">
					<a href="#" class="reset-filter reset hide" style="display: none;">
						<span class="cticon-filter-reset"></span>
					</a>
					<a href="<?php echo get_bloginfo( 'url' ); ?>" class="cancel">
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
					<div class="below-footer">
						<div data-placement="below-footer" class="widget-container-below-footer widgets-below-footer">
							<div class="widget widget-googledfp"></div>
							<div class="widget widget-googledfp"></div>
							<div class="widget widget-static">
								<div class="widget widget-html">
									<!-- Hotjar Tracking Code for http://www.alittlebitofspice.com -->
									<script>
									    (function(h,o,t,j,a,r){
									        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
									        h._hjSettings={hjid:255963,hjsv:5};
									        a=o.getElementsByTagName('head')[0];
									        r=o.createElement('script');r.async=1;
									        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
									        a.appendChild(r);
									    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
									</script>
								</div>
							</div>
						</div>
					</div>
					<footer>
						<div class="ct-footer">
							&copy; <?php echo get_bloginfo( 'name' ); ?>.
							<div class="credit">
								Powered by <a href="https://wordpress.org" target="_blank">WordPress</a>
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

<script type="text/javascript">
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function loadArticle(pageNumber) {
	var sQuery = getUrlParameter( 's' );
	var total = <?php echo $wp_query->max_num_pages; ?>;
	console.log(total);

	if ( pageNumber > total ) {
		return false;
	} else {
		jQuery('.endless_container .auto-load a').text( 'Loading More Posts' );
	  jQuery.ajax({
	      url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
	      type:'POST',
	      data: "action=infinite_scroll&page_no="+ pageNumber + '&total=' + total + '&s=' + sQuery,
	      success: function(html){
					if ( pageNumber + 1 > total ) {
						jQuery('.endless_container').remove();
					} else {
						jQuery('.endless_container .auto-load a').text( 'Show More Posts' );
					}
					jQuery(".search-container .cards-container").append(html);
	      }
	  });
		return false;
	}
}
</script>

</body>
</html>

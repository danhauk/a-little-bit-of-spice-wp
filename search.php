<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package A_Little_Bit_of_Spice
 */

get_header(); ?>

	<div class="search-area clearfix">

		<div class="search-filters">
			<div class="filter-shell">
				<section>
					<div class="filter-header clearfix">
						<a href="#" class="back toggle-filter"><span class="cticon-back"></span></a>
						Filters

						<div class="controls">
							<a class="btn btn-default reset" style="display: none;">Reset</a>
							<a class="btn btn-success apply-filter hide" style="display: none;">Apply</a>
						</div>
					</div>
					<div class="filter-container">
						<h5>Categories</h5>
						<ul class="filters only-recipe">
							<li>
								<a class="option sfilter" href="#">Vegetarian</a>
							</li>
						</ul>
					</div>
				</section>
			</div>
		</div>

		<div class="search-results">
			<section class="search">
				<div class="search-container">
					<div class="result-posts">

						<div class="sectional">
							<ul class="items">
								<li class="active">
									<h5><a href="#">Posts</a></h5>
								</li>
							</ul>
							<ul class="info">
								<li>
									<a href="#" class="cticon-filter ttip toggle-filter" title="" data-original-title="Filters"></a>
								</li>
							</ul>
						</div>

						<div class="cards-shell">
							<div class="cards-container endless-list clearfix">

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

							</div>
						</div>
					</div>
				</div>
			</section>
		</div> <!-- .search-results -->

	</div><!-- .search-area -->

<?php
get_footer();

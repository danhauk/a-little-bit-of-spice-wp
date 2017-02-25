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
						<?php $categories = get_categories(); ?>
						<h5>Categories</h5>
						<ul class="filters only-recipe">
							<?php
							$categories = get_categories();
							?>
							<li>
								<a class="option sfilter" href="#">Vegetarian</a>
							</li>
						</ul>

						<h5>Dietary Preference</h5>
						<ul class="filters only-recipe">
							<?php foreach( $categories as $category ) {
								$cat_parent_name = get_cat_name( $category->parent );
								if ( strtolower($cat_parent_name) == 'diet' ) {
									echo "<li><a class='option sfilter' data-category='{$category->name}' href='javascript:;'>" .
												$category->name .
												"</a></li>";
								}
							} ?>
						</ul>

						<h5>Difficulty</h5>
						<ul class="filters only-recipe">
							<?php foreach( $categories as $category ) {
								$cat_parent_name = get_cat_name( $category->parent );
								if ( strtolower($cat_parent_name) == 'difficulty' ) {
									echo "<li><a class='option sfilter' data-category='{$category->name}' href='javascript:;'>" .
												$category->name .
												"</a></li>";
								}
							} ?>
						</ul>

						<h5>Cuisine</h5>
						<ul class="only-recipe">
							<li class="no-line clearfix">
								<div class="select-style">
									<select class="cuisine dfilter">
										<option selected="selected" value="">All</option>
										<?php
										$cuisines = get_categories( array('taxonomy' => 'cuisine') );
										foreach( $cuisines as $cuisine ) {
											echo "<option value='{$cuisine->slug}'>{$cuisine->name}</option>";
										} ?>
									</select>
								</div>
							</li>
						</ul>

						<h5>Course</h5>
						<ul class="only-recipe">
							<li class="no-line clearfix">
								<div class="select-style">
									<select class="cuisine dfilter">
										<option selected="selected" value="">All</option>
										<?php
										$courses = get_categories( array('taxonomy' => 'course') );
										foreach( $courses as $course ) {
											echo "<option value='{$course->slug}'>{$course->name}</option>";
										} ?>
									</select>
								</div>
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
			?>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

							</div>
						</div>

						<div class="endless_container">
							<?php if( get_next_posts_link() ) {
								echo '<span class="btn endless_more load-more auto-load">';
								next_posts_link('Show more posts');
								echo '</span>';
							} ?>
						</div>
					</div>
				</div>
			</section>
		</div> <!-- .search-results -->

	</div><!-- .search-area -->

<?php
get_footer();

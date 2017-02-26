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

			<?php if ( have_posts() ) : ?>
				<?php global $wp;
							$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
							$catlist = '';
							$catlist_arr = array();

							if ( isset($_GET['catlist']) ) {
								$catlist = $_GET['catlist'];
								$catlist_arr = explode( ',', $catlist );
							}
				?>
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
							$exclude_cats = array('difficulty', 'ingredients', 'diet', 'cooking-time', 'preparation-time');
							$search_url = get_bloginfo('url') . '/?s=' . $_GET['s'];
							$search_url .= ( $catlist != '' ? '&catlist='.$catlist : '' );
							foreach( $categories as $category ) {
								if ( !$category->parent && !in_array($category->slug, $exclude_cats) ) {
									if ( isset($_GET['category_name']) && $_GET['category_name'] == $category->name ) {
										echo '<li class="selected">' .
													"<a class='option sfilter' href='{$search_url}'>" .
													$category->name .
													"</a></li>";
									} else {
										echo '<li>' .
													"<a class='option sfilter' href='{$search_url}&category_name={$category->name}'>" .
													$category->name .
													"</a></li>";
									}
								}
							}
							?>
						</ul>

						<h5>Dietary Preference</h5>
						<ul class="filters only-recipe">
							<?php foreach( $categories as $category ) {
								$cat_parent_name = get_cat_name( $category->parent );
								if ( strtolower($cat_parent_name) == 'diet' ) {
									$cat_id = $category->term_id;

									if ( in_array( $cat_id, $catlist_arr ) ) {
										// if category is in current filters
										// remove this category id from the list to deselect the option
										$cat_index = array_search($cat_id, $catlist_arr);
										$new_catlist_arr = $catlist_arr;
										unset( $new_catlist_arr[$cat_index] );

										// if the array has remaining categories,
										// create a new catlist, otherwise empty catlist parameter
										if ( count($new_catlist_arr) ) {
											$new_catlist = implode(',', $new_catlist_arr);
										} else {
											$new_catlist = '';
										}

										echo "<li class='selected'>" .
													"<a class='option sfilter' href='{$current_url}&catlist={$new_catlist}'>" .
													$category->name .
													"</a></li>";
									}
									else {
										// category is not in current filters
										// add the category id to the catlist parameter
										$new_catlist = ( $catlist ? $catlist.','.$cat_id : $cat_id );
										echo "<li><a class='option sfilter' href='{$current_url}&catlist={$new_catlist}'>" .
													$category->name .
													"</a></li>";
									}
								}
							} ?>
						</ul>

						<h5>Difficulty</h5>
						<ul class="filters only-recipe">
							<?php foreach( $categories as $category ) {
								$cat_parent_name = get_cat_name( $category->parent );
								if ( strtolower($cat_parent_name) == 'difficulty' ) {
									$cat_id = $category->term_id;

									if ( in_array( $cat_id, $catlist_arr ) ) {
										// if category is in current filters
										// remove this category id from the list to deselect the option
										$cat_index = array_search($cat_id, $catlist_arr);
										$new_catlist_arr = $catlist_arr;
										unset( $new_catlist_arr[$cat_index] );

										// if the array has remaining categories,
										// create a new catlist, otherwise empty catlist parameter
										if ( count($new_catlist_arr) ) {
											$new_catlist = implode(',', $new_catlist_arr);
										} else {
											$new_catlist = '';
										}

										echo "<li class='selected'>" .
													"<a class='option sfilter' href='{$current_url}&catlist={$new_catlist}'>" .
													$category->name .
													"</a></li>";
									}
									else {
										// category is not in current filters
										// add the category id to the catlist parameter
										$new_catlist = ( $catlist ? $catlist.','.$cat_id : $cat_id );
										echo "<li><a class='option sfilter' href='{$current_url}&catlist={$new_catlist}'>" .
													$category->name .
													"</a></li>";
									}
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
			<?php endif; ?>
		</div>

		<div class="search-results">
			<section class="search">
				<div class="search-container">
					<div class="result-posts">

						<?php if ( have_posts() ) : ?>
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

							</div> <!-- .cards-container -->
						</div> <!-- .cards-shell -->

						<div class="endless_container">
							<?php if( get_next_posts_link() ) {
								echo '<span class="btn endless_more load-more auto-load">';
								next_posts_link('Show more posts');
								echo '</span>';
							} ?>
						</div>

		<?php
		else : ?>

		<div class="blank-results center">
			<span class="cticon-alert dim clipart"></span>
			<p class="">Sorry, we couldn't find any matches.</p>
		</div>

		<?php endif; ?>

					</div> <!-- .result-posts -->
				</div> <!-- .search-container -->
			</section>
		</div> <!-- .search-results -->

	</div><!-- .search-area -->

<?php
get_footer();

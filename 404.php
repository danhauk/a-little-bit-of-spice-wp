<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package A_Little_Bit_of_Spice
 */

get_header(); ?>

	<div class="search-area clearfix">

		<div class="search-filters">
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
							<a class="btn btn-default reset" <?php echo ( isset($_GET['category_name']) || isset($_GET['catlist']) || isset($_GET['cuisine']) || isset($_GET['course']) ? '' : 'style="display: none;"' ); ?>>Reset</a>
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
									<select class="cuisine dfilter" data-filter="cuisine">
										<option <?php echo ( isset($_GET['cuisine']) ? '' : 'selected="selected"' ); ?> value="">All</option>
										<?php
										$cuisines = get_categories( array('taxonomy' => 'cuisine') );
										foreach( $cuisines as $cuisine ) {
											if ( isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine->slug ) {
												echo "<option value='{$cuisine->slug}' selected='selected'>{$cuisine->name}</option>";
											} else {
												echo "<option value='{$cuisine->slug}'>{$cuisine->name}</option>";
											}
										} ?>
									</select>
								</div>
							</li>
						</ul>

						<h5>Course</h5>
						<ul class="only-recipe">
							<li class="no-line clearfix">
								<div class="select-style">
									<select class="course dfilter" data-filter="course">
										<option <?php echo ( isset($_GET['course']) ? '' : 'selected="selected"' ); ?> value="">All</option>
										<?php
										$courses = get_categories( array('taxonomy' => 'course') );
										foreach( $courses as $course ) {
											if ( isset($_GET['course']) && $_GET['course'] == $course->slug ) {
												echo "<option value='{$course->slug}' selected='selected'>{$course->name}</option>";
											} else {
												echo "<option value='{$course->slug}'>{$course->name}</option>";
											}
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


		<div class="blank-results center">
			<span class="cticon-alert dim clipart"></span>
			<h2>Not Found</h2>
			<p class="">Sorry, that page seems to be missing or has been moved.<br>
			Try searching for a recipe above, browse the <a href="<?php echo home_url('index'); ?>">recipe index</a>, or visit the <a href="<?php echo home_url(); ?>">home page</a>.</p>
		</div>


					</div> <!-- .result-posts -->
				</div> <!-- .search-container -->
			</section>
		</div> <!-- .search-results -->

	</div><!-- .search-area -->

<?php
get_footer();

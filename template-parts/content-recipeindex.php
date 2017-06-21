<?php
// Recipe index parameters table

$courses = get_categories( array('taxonomy' => 'course') );
$cuisines = get_categories( array('taxonomy' => 'cuisine') );
$categories = get_categories();
$diet = array();
$difficulty = array();

foreach( $categories as $category ) {
	$cat_parent_name = strtolower( get_cat_name( $category->parent ) );

	switch ( $cat_parent_name ) {
		case 'diet':
			array_push( $diet, $category );
			break;

		case 'difficulty':
			array_push( $difficulty, $category );
			break;

		default;
	}
}
?>
<div class="ct-index-parameters">
	<div class="ct-index-grp">
		<h3 class="ListTitle">Course</h3>
		<ul>
			<?php foreach( $courses as $course ): ?>
				<li>
					<a href="/course/<?php echo $course->slug; ?>/">
						<span class="ItemName"><?php echo $course->name; ?></span>
						<span class="ItemCount"><?php echo $course->category_count; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="ct-index-grp">
		<h3 class="ListTitle">Cuisine</h3>
		<ul>
			<?php foreach( $cuisines as $cuisine ): ?>
				<li>
					<a href="/cuisine/<?php echo $cuisine->slug; ?>/">
						<span class="ItemName"><?php echo $cuisine->name; ?></span><span class="ItemCount"><?php echo $cuisine->category_count; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="ct-index-grp">
		<h3 class="ListTitle">Diet</h3>
		<ul>
			<?php foreach( $diet as $d ): ?>
				<li>
					<a href="/category/<?php echo $d->slug; ?>/">
						<span class="ItemName"><?php echo $d->name; ?></span>
						<span class="ItemCount"><?php echo $d->category_count; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="ct-index-grp">
		<h3 class="ListTitle">Difficulty</h3>
		<ul>
			<?php foreach( $difficulty as $d ): ?>
				<li>
					<a href="/category/<?php echo $d->slug; ?>/">
						<span class="ItemName"><?php echo $d->name; ?></span>
						<span class="ItemCount"><?php echo $d->category_count; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="blog-content collections categories">
	<div class="post-cards recipe-index">
		<ul>
			<?php
			foreach( $categories as $category ):
				if ( !$category->parent && $category->count > 0 ): ?>

				<li class="cat-wrapper">
					<h2><?php echo $category->name; ?></h2>
					<ul class="card-wrapper">
						<?php
						$recipe_query_args = array(
							'category_name' => $category->name,
							'post_type' => 'recipe',
							'orderby' => 'date',
							'order' => 'desc',
							'posts_per_page' => 10,
							'post_status' => 'publish'
						);
						$recipes = new WP_Query( $recipe_query_args );

						if ( $recipes->have_posts() ):
							while ( $recipes->have_posts() ): $recipes->the_post(); ?>
						<li class="post-wrapper">
							<article class="post-snippet clearfix">
								<div class="img-holder">
									<a class="thumb img-link" href="<?php echo get_permalink(); ?>">
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									</a>
								</div>
								<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
							</article>
						</li>
						<?php
						endwhile;
						wp_reset_postdata();
						endif; ?>

						<?php if ( $category->count > 10 ): $num_more = $category->count - 10; ?>
							<li class="paginate">
								<span class="more-stuff">
									<a class="btn endless-link" href="/category/<?php echo $category->slug; ?>">
										<span>+<span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
									</a>
								</span>
							</li>
						<?php endif; ?>
					</ul>
				</li>

			<?php endif;
			endforeach; ?>
		</ul>
	</div>
</div>

<?php
// Recipe index parameters table

$courses = get_categories( array('taxonomy' => 'course') );
$cuisines = get_categories( array('taxonomy' => 'cuisine') );
$categories = get_categories();
$diet = array();
$difficulty = array();
$num_cakes = 0;
$num_puddings = 0;
$num_onam = 0;
$num_vegetarian = 0;
$num_egg = 0;
$num_uncat = 0;

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

	switch ( $category->slug ) {
		case 'cakes':
			$num_cakes = $category->count;
			break;

		case 'egg':
			$num_egg = $category->count;
			break;

		case 'onam':
			$num_onam = $category->count;
			break;

		case 'puddings':
			$num_puddings = $category->count;
			break;

		case 'vegetarian':
			$num_vegetarian = $category->count;
			break;

		default:
			$num_uncat = $category->count;
			break;
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
			<?php if ( $num_cakes > 0 ): ?>
			<li class="cat-wrapper">
				<h2>Cakes</h2>
				<ul class="card-wrapper">

					<?php
					$recipe_query_args = array(
						'category_name' => 'cakes',
						'post_type' => 'recipe',
						'orderby' => 'date',
						'order' => 'desc',
						'posts_per_page' => 10,
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

					<?php if ( $num_cakes > 10 ): $num_more = $num_cakes - 10; ?>
						<li class="paginate">
							<span class="more-stuff">
								<a class="btn endless-link" href="?page=2">
									<span> + <span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
								</a>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</li>
			<?php endif; ?>

			<?php if ( $num_egg > 0 ): ?>
			<li class="cat-wrapper">
				<h2>Egg</h2>
				<ul class="card-wrapper">

					<?php
					$recipe_query_args = array(
						'category_name' => 'egg',
						'post_type' => 'recipe',
						'orderby' => 'date',
						'order' => 'desc',
						'posts_per_page' => 10,
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

					<?php if ( $num_egg > 10 ): $num_more = $num_egg - 10; ?>
						<li class="paginate">
							<span class="more-stuff">
								<a class="btn endless-link" href="?page=2">
									<span> + <span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
								</a>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</li>
			<?php endif; ?>

			<?php if ( $num_onam > 0 ): ?>
			<li class="cat-wrapper">
				<h2>Onam</h2>
				<ul class="card-wrapper">

					<?php
					$recipe_query_args = array(
						'category_name' => 'onam',
						'post_type' => 'recipe',
						'orderby' => 'date',
						'order' => 'desc',
						'posts_per_page' => 10,
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

					<?php if ( $num_onam > 10 ): $num_more = $num_onam - 10; ?>
						<li class="paginate">
							<span class="more-stuff">
								<a class="btn endless-link" href="?page=2">
									<span> + <span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
								</a>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</li>
			<?php endif; ?>

			<?php if ( $num_puddings > 0 ): ?>
			<li class="cat-wrapper">
				<h2>Puddings</h2>
				<ul class="card-wrapper">

					<?php
					$recipe_query_args = array(
						'category_name' => 'puddings',
						'post_type' => 'recipe',
						'orderby' => 'date',
						'order' => 'desc',
						'posts_per_page' => 10,
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

					<?php if ( $num_puddings > 10 ): $num_more = $num_puddings - 10; ?>
						<li class="paginate">
							<span class="more-stuff">
								<a class="btn endless-link" href="?page=2">
									<span> + <span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
								</a>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</li>
			<?php endif; ?>

			<?php if ( $num_vegetarian > 0 ): ?>
			<li class="cat-wrapper">
				<h2>Vegetarian</h2>
				<ul class="card-wrapper">

					<?php
					$recipe_query_args = array(
						'category_name' => 'vegetarian',
						'post_type' => 'recipe',
						'orderby' => 'date',
						'order' => 'desc',
						'posts_per_page' => 10,
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

					<?php if ( $num_vegetarian > 10 ): $num_more = $num_vegetarian - 10; ?>
						<li class="paginate">
							<span class="more-stuff">
								<a class="btn endless-link" href="?page=2">
									<span> + <span class="count"><?php echo $num_more; ?></span><span class="text" data-reactid="509">&nbsp;More</span></span>
								</a>
							</span>
						</li>
					<?php endif; ?>

				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>

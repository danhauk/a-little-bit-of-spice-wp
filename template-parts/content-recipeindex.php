<?php
// Recipe index parameters table

$courses = get_categories( array('taxonomy' => 'course') );
$cuisines = get_categories( array('taxonomy' => 'cuisine') );
$categories = get_categories();
$diet = array();
$difficulty = array();
$prep_time = array();
$cook_time = array();
$ingredients = array();

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

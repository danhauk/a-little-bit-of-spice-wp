<?php
/**
 * Custom recipe template
 *
 */

function wpurp_custom_ingredients( $template )
{
	var_dump( $recipe );
}

function wpurp_custom_template_test( $content, $recipe )
{
	ob_start();
	echo '<pre>';
	var_dump( $recipe );
	echo '</pre>';

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

function wpurp_custom_template( $content, $recipe )
{
	ob_start();

	$recipe_summary = wpurp_custom_template_get_summary( $recipe );
	?>

	<article itemscope itemtype="http://schema.org/Recipe" class="ct-recipe">
		<?php //echo $recipe_summary; ?>
		<pre><?php var_dump( $recipe ); ?></pre>
	</article>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

function wpurp_custom_template_ingredients( $recipe )
{

}

function wpurp_custom_template_get_summary( $recipe )
{
	ob_start();
	?>
	<div class="recipe-meta-inline">
		<div class="block-head">
			<h4><span>Summary</span></h4>
		</div>

		<ul class="clearfix">
			<li>
				<span class="item-key">Course</span>
				<span class="item-value" itemprop="recipeCategory" content="<?php //echo $course_meta; ?>">
					<?php //echo $course; ?>
				</span>
			</li>

			<li>
				<span class="item-key">Cuisine</span>
				<span class="item-value" itemprop="recipeCuisine" content="<?php //echo $cuisine_meta; ?>">
					<?php //echo $cuisine; ?>
				</span>
			</li>

			<li>
				<span class="item-key">Yield</span>
				<span itemprop="recipeYield">
					<?php //echo $serves; ?> s
				</span>
			</li>

			<li>
				<span class="item-key">Cooking Time</span>
				<span class="item-value"><?php //echo $cook_time; ?></span>
				<meta itemprop="cookTime" content="<?php //echo recipe_hero_schema_cook_time(); ?>">
			</li>

			<li>
				<span class="item-key">Preparation Time</span>
				<span class="item-value"><?php //echo $prep_time; ?></span>
				<meta itemprop="prepTime" content="<?php //echo recipe_hero_schema_prep_time(); ?>">
			</li>

			<li>
				<span class="item-key">Total Time</span>
				<span class="item-value"><?php //echo $total_time; ?></span>
				<meta itemprop="totalTime" content="<?php //echo recipe_hero_schema_total_time(); ?>">
			</li>
		</ul>

	</div><!-- .recipe-single-details -->
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

<?php
/**
 * Custom recipe template
 *
 */

function wpurp_custom_template_test( $content, $recipe )
{
	ob_start();
	?>
	<div class="ct-recipe">
		<div class="recipe-meta-inline">
			<div class="block-head">
				<h4><span>Summary</span></h4>
			</div>
			<div class="ct-recipe-apps">
				<a href="#">
					<span class="cticon-printer"></span>
					<span class="icon-label">Print</span>
				</a>
				<a href="javascript:void(0);">
					<span class="cticon-tune"></span>
					<span class="icon-label">Adjust</span>
				</a>
			</div>

			<ul class="clearfix">

				<?php if ( $recipe->servings() ) { ?>
				<li>
					<span class="item-key">Yield</span>
					<span itemprop="recipeYield">
						<?php echo $recipe->servings(); ?> s
					</span>
				</li>
				<?php } ?>

				<?php if ( $recipe->cook_time() ) { ?>
				<li>
					<span class="item-key">Cooking Time</span>
					<span class="item-value"><?php echo $recipe->cook_time().' '.$recipe->cook_time_text(); ?></span>
					<meta itemprop="cookTime" content="<?php echo $recipe->cook_time_meta(); ?>">
				</li>
				<?php } ?>

				<?php if ( $recipe->prep_time() ) { ?>
				<li>
					<span class="item-key">Preparation Time</span>
					<span class="item-value"><?php echo $recipe->prep_time().' '.$recipe->prep_time_text(); ?></span>
					<meta itemprop="prepTime" content="<?php echo $recipe->prep_time_meta(); ?>">
				</li>
				<?php } ?>

				<?php
				$total_time = $recipe->prep_time() + $recipe->cook_time();
				?>
				<li>
					<span class="item-key">Total Time</span>
					<span class="item-value"><?php echo $total_time; ?></span>
				</li>

				<?php if ( $recipe->passive_time() ) { ?>
				<li>
					<span class="item-key">Passive Time</span>
					<span class="item-value"><?php echo $recipe->passive_time().' '.$recipe->passive_time_text(); ?></span>
				</li>
				<?php } ?>
			</ul>
		</div>

		<div class="ing-inline" data-servings="<?php echo $recipe->servings_normalized(); ?>">
			<h4><span>Ingredients</span></h4>
			<?php
			$groups = array();
			$previous_group = null;
			$out = '';

			foreach( $recipe->ingredients() as $ingredient ): ?>
				<?php
				$group = isset( $ingredient['group'] ) ? $ingredient['group'] : '';
				if( $group !== $previous_group ) {
					echo '<h5><div class="ing-qty">'.$group.'</div></h5>';
					$previous_group = $group;
				}
				?>

				<div class="ing-line" itemprop="ingredients">
		   		<div class="ing-name">
		   			<?php echo $ingredient['ingredient']; ?>
		   		</div>
		   		<div class="ing-qty">
		   			<?php echo $ingredient['amount']; ?>
						<?php echo $ingredient['unit']; ?>
		   		</div>
		    </div>
			<?php endforeach;
				// var_dump( $ingredient );
				// $group = isset( $ingredient['group'] ) ? $ingredient['group'] : '';
				//
        // if( $group !== $previous_group ) {
        //     $groups[] = $group;
        //     $previous_group = $group;
        // }

			// foreach( $groups as $index => $group ) {
			// 	echo '<h5><div class="ing-qty">'.$group.'</div></h5>';
			// }
			?>

		</div>
	</div><!-- .ct-recipe -->
	<?php

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

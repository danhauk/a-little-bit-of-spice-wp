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

				<?php
				$recipe_terms = array();
				$taxonomies = WPUltimateRecipe::get()->tags();
				unset( $taxonomies['ingredient'] );

				foreach( $taxonomies as $taxonomy => $options ) {
					if( !in_array( $taxonomy, WPUltimateRecipe::option('recipe_tags_hide_in_recipe', array() ) ) ) {
						$terms = get_the_terms( $recipe->ID(), $taxonomy );
						if( $terms && ! is_wp_error( $terms ) ) {
							foreach( $terms as $term ) {
								$recipe_terms[$term->taxonomy] = $term->name;
							}
						}
					}
				}
				?>

				<?php if ( isset( $recipe_terms['course'] ) ) { ?>
				<li>
					<span class="item-key">Course</span>
					<span class="item-value capitalize" itemprop="recipeCategory" content="<?php echo $recipe_terms['course']; ?>">
						<?php echo $recipe_terms['course']; ?>
					</span>
				</li>
				<?php } ?>

				<?php if ( isset ( $recipe_terms['cuisine'] ) ) { ?>
				<li>
					<span class="item-key">Cuisine</span>
					<span class="item-value capitalize" itemprop="recipeCuisine" content="<?php echo $recipe_terms['cuisine']; ?>">
						<?php echo $recipe_terms['cuisine']; ?>
					</span>
				</li>
				<?php } ?>

				<?php if ( $recipe->servings() ) { ?>
				<li>
					<span class="item-key">Yield</span>
					<span itemprop="recipeYield">
						<?php echo $recipe->servings() . ' ' . $recipe->servings_type(); ?>
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
				if ( $recipe->prep_time_text() == 'minutes' && $recipe->cook_time_text() == 'minutes' ) {
					$total_time = $recipe->prep_time() + $recipe->cook_time() . ' minutes';
				}
				else {
					if ( $recipe->prep_time_text() == 'hours' || $recipe->prep_time_text() == 'hour' ) {
						$prep_time = $recipe->prep_time() * 60;
					} else {
						$prep_time = $recipe->prep_time();
					}

					if ( $recipe->cook_time_text() == 'hours' || $recipe->cook_time_text() == 'hour' ) {
						$cook_time = $recipe->cook_time() * 60;
					} else {
						$cook_time = $recipe->cook_time();
					}

					$time = $prep_time + $cook_time;
					$hours = $time / 60;
					$total_hours = number_format( $hours, 0 );
					$minutes = $time - ($total_hours * 60);

					$total_time = ($total_hours > 1 ? $total_hours . ' hours ' : $total_hours . ' hour ');
					$total_time .= $minutes . ' minutes';
				}
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
		</div><!-- .recipe-meta-inline -->

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
						<?php echo $ingredient['ingredient'] . ' ' . $ingredient['notes']; ?>
		   		</div>
		   		<div class="ing-qty">
		   			<?php echo $ingredient['amount']; ?>
						<?php echo $ingredient['unit']; ?>
		   		</div>
		    </div>
			<?php endforeach; ?>

		</div><!-- .ing-inline -->

		<div class="steps-inline">
			<h4>Steps</h4>

			<ol class="recipe-steps" itemprop="recipeInstructions">
				<?php
				$instructions = $recipe->instructions();

				for( $i = 0; $i < count($instructions); $i++ ):
					$instruction = $instructions[$i]; ?>

					<li itemprop="recipeInstructions">
						<?php
						echo $instruction['description'];

						if ( $instruction['image'] != '' ) {
							$thumb = wp_get_attachment_image_src( $instruction['image'], 'large' );
							$thumb_url = $thumb['0'];

							$full_img = wp_get_attachment_image_src( $instruction['image'], 'full' );
							$full_img_url = $full_img['0'];

							$title_tag = WPUltimateRecipe::option( 'recipe_instruction_images_title', 'attachment' ) == 'attachment' ? esc_attr( get_the_title( $instruction['image'] ) ) : esc_attr( $instruction['description'] );
							$alt_tag = WPUltimateRecipe::option( 'recipe_instruction_images_alt', 'attachment' ) == 'attachment' ? esc_attr( get_post_meta( $instruction['image'], '_wp_attachment_image_alt', true ) ) : esc_attr( $instruction['description'] );

							echo '<figure class="img-center"><img src="' . $thumb_url . '" alt="' . $alt_tag . '" /></figure>';
						} ?>
					</li>
				<?php endfor; ?>
			</ol>
		</div><!-- .steps-inline -->

		<?php if ( $recipe->notes() ):
			$notes = wpautop( $recipe->notes() ); ?>

			<p><strong>Notes</strong></p>
			<?php echo $notes; ?>

		<?php endif; ?>

		<div class="recipe-finished-image">
			<figure class="img-center">
				<?php
				$recipe_thumb = wp_get_attachment_image_src( $recipe->image_ID(), $size = 'full' );
				$recipe_image_url = $recipe_thumb[0];
				?>
				<img src="<?php echo $recipe_image_url; ?>" alt="<?php echo $recipe->title(); ?>" />
			</figure>
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

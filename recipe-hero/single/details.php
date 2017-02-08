<?php
/**
 * Recipe Single Details
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @version   1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Variables
global $post;

$serves 		= get_post_meta( $post->ID, '_recipe_hero_detail_serves', true );
$serves_type 	= get_post_meta( $post->ID, '_recipe_hero_detail_serves_type', true );
$equipment 		= get_post_meta( $post->ID, '_recipe_hero_detail_equipment', false );

$prep_time 		= recipe_hero_convert_minute_hour( get_post_meta( $post->ID, '_recipe_hero_detail_prep_time', true ) );
$cook_time 		= recipe_hero_convert_minute_hour( get_post_meta( $post->ID, '_recipe_hero_detail_cook_time', true ) );
$total_time 	= recipe_hero_convert_minute_hour( recipe_hero_calc_total_cook_time() );

$cuisine_terms = wp_get_object_terms( $post->ID, 'cuisine' );
$course_terms = wp_get_object_terms( $post->ID, 'course' );

if ( ! empty ( $cuisine_terms ) ) {
	if ( ! is_wp_error ( $cuisine_terms ) ) {
		foreach ( $cuisine_terms as $term ) {
			$cuisine = $term->name;
		}
	}
}

if ( ! empty ( $course_terms ) ) {
	if ( ! is_wp_error ( $course_terms ) ) {
		foreach ( $course_terms as $term ) {
			$course = $term->name;
		}
	}
}

?>

<div class="recipe-meta-inline">
	<div class="block-head">
		<h4><span>Summary</span></h4>
	</div>

	<ul class="clearfix">
		<?php if ( isset ( $course ) ) { ?>
		<li>
			<span class="item-key">Course</span>
			<span class="item-value" itemprop="recipeCategory" content="<?php echo $course_meta; ?>">
				<?php echo $course; ?>
			</span>
		</li>
		<?php } ?>

		<?php if ( isset ( $cuisine ) ) { ?>
		<li>
			<span class="item-key">Cuisine</span>
			<span class="item-value" itemprop="recipeCuisine" content="<?php echo $cuisine_meta; ?>">
				<?php echo $cuisine; ?>
			</span>
		</li>
		<?php } ?>

		<?php if ( $serves ) { ?>
		<li>
			<span class="item-key">Yield</span>
			<span itemprop="recipeYield">
				<?php echo $serves; ?> s
			</span>
		</li>
		<?php } ?>

		<?php if ( $cook_time ) { ?>
		<li>
			<span class="item-key">Cooking Time</span>
			<span class="item-value"><?php echo $cook_time; ?></span>
			<meta itemprop="cookTime" content="<?php echo recipe_hero_schema_cook_time(); ?>">
		</li>
		<?php } ?>

		<?php if ( $prep_time ) { ?>
		<li>
			<span class="item-key">Preparation Time</span>
			<span class="item-value"><?php echo $prep_time; ?></span>
			<meta itemprop="prepTime" content="<?php echo recipe_hero_schema_prep_time(); ?>">
		</li>
		<?php } ?>

		<li>
			<span class="item-key">Total Time</span>
			<span class="item-value"><?php echo $total_time; ?></span>
			<meta itemprop="totalTime" content="<?php echo recipe_hero_schema_total_time(); ?>">
		</li>
	</ul>

</div><!-- .recipe-single-details -->

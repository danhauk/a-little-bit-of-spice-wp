<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_Little_Bit_of_Spice
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( is_search() ) { ?>
<div id="ct-container" class="container slide-animation">
	<div class="search-page">

<?php } else { ?>
<div id="theme-container" class="site">
	<header class="theme-header" id="theme-header" role="banner">
		<a class="menu-trigger" id="menu-trigger"><span></span></a>

		<div class="nav-area" id="site-navigation">
			<?php get_search_form(); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
	</header>

	<?php
	$content_classes = '';
	if ( is_home() ) {
		$content_classes = 'content home';
	} elseif ( is_single() ) {
		$content_classes = 'content post generic';
	} else {
		$content_classes = 'content';
	}
	?>
	<div id="content" class="container">
		<div class="<?php echo $content_classes; ?>">
<?php } ?>

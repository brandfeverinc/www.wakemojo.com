<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WakeMojo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if IE 8]> <html lang="en-us" class="no-js ie8 oldie"> <![endif]-->
<!--[if IE 9]> <html lang="en-us" class="no-js-9 ie9"> <![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrap">
			<div class="menu">
				<a href="#mmenu" class="menu-toggle">Menu</a>
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'WakeMojo' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div><!-- .header-wrap -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

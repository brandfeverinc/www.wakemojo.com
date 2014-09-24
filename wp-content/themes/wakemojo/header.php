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
<link rel="shortcut icon" href="/wp-content/themes/wakemojo/img/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="/wp-content/themes/wakemojo/img/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/wakemojo/img/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/wakemojo/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/wp-content/themes/wakemojo/img/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/wp-content/themes/wakemojo/img/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/wp-content/themes/wakemojo/img/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/wp-content/themes/wakemojo/img/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/wp-content/themes/wakemojo/img/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="/wp-content/themes/wakemojo/img/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="/wp-content/themes/wakemojo/img/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/wp-content/themes/wakemojo/img/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/wp-content/themes/wakemojo/img/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/wp-content/themes/wakemojo/img/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/wp-content/themes/wakemojo/img/mstile-144x144.png">
<meta name="msapplication-config" content="/wp-content/themes/wakemojo/img/browserconfig.xml">
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

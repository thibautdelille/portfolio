<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/a05026f7-1ac7-43f1-a31b-75f739ce9431.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed">
	<header id="header" role="banner">
		<section id="branding">
			<div id="site-title"><?php if ( ! is_singular() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'thibautdelille' ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( ! is_singular() ) { echo '</h1>'; } ?></div>
			<div id="site-description"><?php bloginfo( 'description' ); ?></div>
		</section>
		<nav id="menu" role="navigation">
			<div id="search">
				<?php get_search_form(); ?>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>
	</header>
	<div id="container">
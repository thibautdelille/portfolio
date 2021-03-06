<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/a05026f7-1ac7-43f1-a31b-75f739ce9431.css"/>
  <link href="<?php echo get_template_directory_uri()?>/assets/css/style.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>
	<script src="<?php echo get_template_directory_uri();?>/assets/js/jquery-1.10.1.min.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/aau.min.js"></script>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-8063686-1', 'thibautdelille.com');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed">
	<header id="header" role="banner">
		<nav>
			<div class="primary-nav" id="primary">
				<div class="row top-nav">
					<div class="marged padded">
						<section id="branding">
							<div id="site-title"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'thibautdelille' ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1></div>
							<div id="site-description"><?php bloginfo( 'description' ); ?></div>
						</section>
					</div>
				</div>
				<div class="row middle-nav">
					<div class="marged_tablet padded_tablet">
						<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav' ) ); ?>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<div id="container">
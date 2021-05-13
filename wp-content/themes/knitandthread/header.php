<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php wp_title(); ?></title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">
	<?php wp_head(); ?>
</head>
<body>

<header class="kat-site-header">
	<div class="kat-site-header-meta">
		<button class="kat-site-header-navigation-show">Show</button>
		<div class="kat-site-header-social">
			<?php do_action( "bkr_contacts_zone", "header" ); ?>
		</div>
		<div class="kat-site-header-logo">LOGO</div>
		<div class="kat-site-header-search">SEARCH</div>
	</div>
	<div class="kat-site-header-navigation">
		<button class="kat-site-header-navigation-hide">x</button>
		<?php
		wp_nav_menu( [
			"theme_location" => "primary",
			"walker" => new KAT_Nav_Walker(),
			"menu_class" => "kat-navigation-menu",
			"container" => false
		] );
		?>
	</div>
</header>

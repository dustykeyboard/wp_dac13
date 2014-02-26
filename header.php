<!DOCTYPE html>
<!--[if lte IE 7]> <html class="ie7" <?php language_attributes(); ?>> <![endif]-->  
<!--[if IE 8]>     <html class="ie8" <?php language_attributes(); ?>> <![endif]-->  
<!--[if IE 9]>     <html class="ie9" <?php language_attributes(); ?>> <![endif]-->  
<!--[if !IE]><!--> <html <?php language_attributes(); ?>>             <!--<![endif]-->  
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<title><?php wp_title( '@', true, 'right' ); ?><?php bloginfo('name'); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri(); ?>/style.css" />
		<link rel="alternate" type="application/rss+xml" href="<?= bloginfo('url'); ?>?feed=rss2" />
		<link rel="apple-touch-icon-precomposed" href="<?= get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png" />
		<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
		<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri(); ?>/i_hate_ie.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<h1 id='logo'><a href='<?= home_url(); ?>' title='<?php bloginfo('name'); ?>'><?php bloginfo('name'); ?></a></h1>
			<a href='#nav' onclick='document.getElementById("nav").className="active";return false' class='administrative show-menu' title='Show Menu'>&equiv;</a>
			<a href='#search' onclick='document.getElementById("search").className="active";document.getElementById("s").focus();return false' class='show-search' title='Show Search' title='Search'>&#128269;</a>
			<nav id='nav'>
				<a href='#top' onclick='document.getElementById("nav").className="";return false' class='administrative hide-menu'>Close Menu</a>
				<?php wp_nav_menu(); ?>
			</nav>
			<form id='search' action='<?php echo home_url( '/' ); ?>' class='<?= get_search_query() != '' ? 'active': ''; ?>'><input type='search' name='s' id='s' placeholder='Search...'  value="<?php the_search_query(); ?>" />&nbsp;<input type='submit' class='search-submit' value='Search' /></form>
		</header>
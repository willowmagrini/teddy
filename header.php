<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body id="<?php echo $post->post_name;?>" <?php body_class(); ?>>
	<div class="container col-sm-12 sem-margem">
		<header id="header" role="banner">
			<div id="h-topo"><!--topo do header-->
				<div id="logo-menu" class="col-sm-10 centro"><!--logo-menu-->
					<?php
						$header_image = get_header_image();
						if ( ! empty( $header_image ) ) :
					?>
					<a id="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" height="<?php esc_attr_e( $header_image->height ); ?>" width="<?php esc_attr_e(
						 $header_image->width ); ?>" alt="" /></a>
					<?php endif; ?>
					<nav id="main-navigation" class="navbar navbar-default" role="navigation">
						<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'odin' ); ?>"><?php _e( 'Skip to content', 'odin' ); ?></a>
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
							<span class="sr-only"><?php _e( 'Toggle navigation', 'odin' ); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<?php /*

							<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

							*/ ?>
						</div>

						<div class="collapse navbar-collapse navbar-main-navigation">
							<?php
								wp_nav_menu(
									array(
										'theme_location'     => 'main-menu',
										'depth'              => 2,
										'container'          => false,
										'menu_class'         => 'nav navbar-nav',
										'fallback_cb'        => 'Odin_Bootstrap_Nav_Walker::fallback',
										'walker'             => new Odin_Bootstrap_Nav_Walker(),
										'menu_class'	     => 'menu-principal nav navbar-nav ',
										'container_class'    => 'sem-margem'
									
									)
								);
							?>

						</div><!-- .navbar-collapse -->
					</nav><!-- #main-menu -->
				</div><!--logo-menu-->
			</div><!--topo do header-->
			<div id="h-fundo" class="clearfix"><!--fundo do header-->
				
			</div><!--fundo do header-->
			


					</header><!-- #header -->

		<div id="main" class="site-main row">

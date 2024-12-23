<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mystery Themes
 * @subpackage Editorial
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'editorial_before_page' );
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'editorial' ) ;?></a>
	<?php do_action( 'editorial_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="top-header-section">
			<div class="mt-container">
				<div class="top-left-header">
					<?php do_action( 'editorial_current_date' ); ?>
					<nav id="top-header-navigation" class="top-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'top-header', 'container_class' => 'top-menu', 'depth'=> 1, 'fallback_cb' => false, 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
					</nav>
				</div>
				<?php do_action( 'editorial_top_social_icons' ); ?>
			</div> <!-- mt-container end -->
		</div><!-- .top-header-section -->

		<div class="logo-ads-wrapper clearfix">
			<div class="mt-container">
				<div class="site-branding">
					<?php if ( the_custom_logo() ) { ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div><!-- .site-logo -->
					<?php } ?>
					<?php 
						$site_title_option = get_theme_mod( 'header_textcolor' );
						if ( $site_title_option != 'blank' ) {
					?>
						<div class="site-title-wrapper">
							<?php
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
							endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
							endif; ?>
						</div><!-- .site-title-wrapper -->
					<?php 
						}
					?>
				</div><!-- .site-branding -->
				<div class="header-ads-wrapper">
					<?php dynamic_sidebar( 'editorial_header_ads_area' ); ?>
				</div><!-- .header-ads-wrapper -->
			</div>
		</div><!-- .logo-ads-wrapper -->

		<div id="mt-menu-wrap" class="bottom-header-wrapper clearfix">
			<div class="mt-container">
				<div class="home-icon"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <i class="fa fa-home"> </i> </a> </div>
				<a href="javascript:void(0)" class="menu-toggle"> <i class="fa fa-navicon"> </i> </a>
				<nav id="site-navigation" class="main-navigation mt-modal-popup-content" role="navigation">
					<?php 
						wp_nav_menu( 
							array( 
								'theme_location' => 'primary', 
								'container_class' => 'menu', 
								'items_wrap' => '<ul>%3$s</ul>' 
							) 
						); 
					?>
				</nav><!-- #site-navigation -->
				<div class="header-search-wrapper">
					<span class="search-main"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></span>
					<div class="search-form-main clearfix">
	                	<?php get_search_form(); ?>
	            	</div>
				</div><!-- .header-search-wrapper -->
			</div><!-- .mt-container -->
		</div><!-- #mt-menu-wrap -->

		<?php do_action( 'editorial_news_ticker' ); ?>
			
	</header><!-- #masthead -->
	
	<?php
		do_action( 'editorial_after_header' );
		do_action( 'editorial_before_main' );
	?>

	<div id="content" class="site-content">
		<div class="mt-container">

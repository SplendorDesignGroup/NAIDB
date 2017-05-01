<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<!--[if !(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9 ie8" lang="en"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if gte IE 9]>
<style type="text/css">
	.gradient {
		filter: none;
	}
</style>
<![endif]-->

<head>
	<!-- Set up Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="format-detection" content="telephone=no">
	<meta charset="<?php bloginfo('charset'); ?>">

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<!-- Add Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<!--	<script src="https://use.typekit.net/mfd7yst.js"></script>-->
<!--	<script>try{Typekit.load({ async: true });}catch(e){}</script>-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- BEGIN of header -->
<header class="header">
	<div class="row">
		<div class="large-4 medium-12 columns">
			<div class="logo small-only-text-center">
				<?php show_custom_logo(); ?>
			</div>
		</div>
		<div class="large-8 medium-12 columns text-right header-right">
			<div>
				<?php if ( $header_info = get_field('header_info','options') ) : ?>
					<div class="header-info" ><?php echo $header_info; ?></div>
				<?php endif;
				if ( $header_sign_up_form = get_field('header_sign_up_form','options') ) :
					echo do_shortcode('[gravityform id="' . $header_sign_up_form['id'] . '" title="false" description="false" ajax="true"]');
				endif;
				if ( $header_sign_up_text = get_field('header_sign_up_text','options') ) : ?>
					<p class="header-sign" ><?php echo $header_sign_up_text; ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="header-menu">
		<div class="row medium-uncollapse small-collapse">
			<div class="small-12 columns medium-no-padding">
				<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
					<button class="menu-icon" type="button" data-toggle></button>
					<div class="title-bar-title">Menu</div>
				</div>
				<nav class="top-bar" id="main-menu">
					<?php
					if (has_nav_menu('header-menu')) {
						wp_nav_menu(array('theme_location' => 'header-menu',
							'menu_class' => 'menu header-menu dropdown',
							'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
							'walker' => new Foundation_Navigation()));
					}
					?>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- END of header -->

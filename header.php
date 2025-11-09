<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
	<nav class="site-nav" role="navigation">
		<?php
		wp_nav_menu([
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'primary-menu',
			'fallback_cb' => false
		]);
		?>
	</nav>
</header>

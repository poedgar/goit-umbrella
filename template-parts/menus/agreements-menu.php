<?php

/**
 * Template Part: Agreements Menu
 * Can be used anywhere: footer, page, sidebar
 */

if (has_nav_menu('agreements')) {
	wp_nav_menu([
		'theme_location' => 'agreements',
		'container'      => false,
		'menu_class'     => 'agreements-menu flex flex-col md:flex-row gap-[10px] md:gap-4',
		'fallback_cb'    => false,
	]);
}

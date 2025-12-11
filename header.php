<?php

/**
 * The header
 *
 * @package Bathe
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Favicon -->
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/src/images/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/src/images/favicon.svg" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Unbounded:wght@200..900&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased flex flex-col min-h-screen'); ?>>
    <?php wp_body_open(); ?>

    <header class="bg-body sticky top-0 z-50 py-5 md:py-8">
        <div class="container">
            <nav class="flex items-center justify-between">
                <!-- Logo -->
                <a href="<?php echo home_url('/'); ?>" class="w-[166px] h-[28px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/logo/logo-black.svg"
                        alt="логотип BETTERED" class="">
                </a>

                <!-- Desktop Navigation Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false,
						'items_wrap' => '%3$s',
						'fallback_cb' => false,
						'walker' => new Custom_Anchor_Walker()
					));
					?>
                </div>

                <!-- Desktop Ecosystem Dropdown -->
                <div class="hidden xl:block relative text-xl/[28px]">
                    <button id="ecosystem-dropdown-btn"
                        class="bg-black text-white px-4 py-2 rounded flex items-center justify-center gap-[10px] hover:bg-gray-800 transition-colors">
                        <span id="selected-ecosystem" class="lowercase">Наша екосистема</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/decoratives/arrow-down-white.svg"
                            alt="декорація" class="w-3 h-2" aria-hidden="true">
                    </button>
                    <?php
					// Get all companies
					$companies = get_posts([
						'post_type' => 'companies',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
					]);

					// Collect all sites from all companies
					$all_sites = [];
					foreach ($companies as $company) {
						$sites = get_field('sites', $company->ID);

						if ($sites) {
							foreach ($sites as $site) {
								$all_sites[] = [
									'name' => $site['header_name'] ?? '',
									'url' => $site['header_url'] ?? '#',
								];
							}
						}
					}
					?>

                    <div id="ecosystem-dropdown" class="absolute right-0 w-full bg-white rounded-b shadow-lg border border-gray-200 overflow-hidden
           transition-all duration-1200 ease-[cubic-bezier(0.25,0.46,0.45,0.94)]
           opacity-0 invisible scale-95 translate-y-2 origin-top">
                        <?php if (!empty($all_sites)) : ?>
                        <?php foreach ($all_sites as $index => $site) : ?>
                        <?php
								// Determine if this is the last item (no border)
								$border_class = ($index < count($all_sites) - 1) ? '' : '';
								?>
                        <?php if ($site['url']) : ?>
                        <a href="<?php echo esc_url($site['url']); ?>"
                            class="block text-center px-4 py-2 hover:bg-gray-50 hover:underline underline-offset-4 transition-colors <?php echo $border_class; ?>"
                            target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($site['name']); ?>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="block px-6 py-3 text-gray-500 text-sm">
                            No sites available
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn"
                    class="xl:hidden text-xl/[28px] border-2 border-black px-4 py-1 flex items-center justify-center rounded h-[44px] hover:bg-gray-50 transition-colors">
                    меню
                </button>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu"
        class="fixed inset-0 z-50 xl:hidden bg-body transition-transform duration-1200 ease-out translate-x-full">
        <div class="container py-5 h-full flex flex-col">
            <!-- Mobile Menu Header -->
            <div class="flex items-center justify-between">
                <a href="<?php echo home_url('/'); ?>" class="w-[168px] h-[28px]">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/logo/logo-black.svg"
                        alt="логотип BETTERED">
                </a>
                <button id="mobile-close-btn"
                    class="text-xl/[28px] border-2 border-black px-4 py-1 flex items-center justify-center h-[44px] rounded hover:bg-gray-50 transition-colors">
                    закрити
                </button>
            </div>

            <!-- Mobile Navigation Links -->
            <nav class="flex-1 flex flex-col items-center space-y-5 mt-[60px]">
                <!-- Mobile Ecosystem Dropdown -->
                <div class="w-full text-xl/[28px]">
                    <button id="mobile-ecosystem-btn"
                        class="w-full bg-black text-white px-4 py-2 rounded-t flex items-center justify-center gap-[10px] hover:bg-gray-800 transition-colors">
                        <span id="mobile-selected-ecosystem" class="lowercase">Наша екосистема</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/decoratives/arrow-down-white.svg"
                            alt="декорація" class="w-3 h-2" aria-hidden="true">
                    </button>

                    <div id="mobile-ecosystem-dropdown" class="bg-white rounded-b border border-gray-200 overflow-hidden
           transition-all duration-1200 ease-in-out
           max-h-0 opacity-0"> <?php if (!empty($all_sites)) : ?>
                        <?php foreach ($all_sites as $index => $site) : ?>
                        <?php
										// Determine if this is the last item (no border)
										$border_class = ($index < count($all_sites) - 1) ? '' : '';
								?>
                        <?php if ($site['url']) : ?>
                        <a href="<?php echo esc_url($site['url']); ?>"
                            class="block text-center px-4 py-2 hover:bg-gray-50 hover:underline underline-offset-4 transition-colors <?php echo $border_class; ?>"
                            target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($site['name']); ?>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="block px-6 py-3 text-gray-500 text-sm">
                            No sites available
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'space-y-8 text-center text-lg',
					'fallback_cb' => false,
					'walker' => new Custom_Mobile_Anchor_Walker()
				));
				?>
            </nav>

            <!-- Footer -->
            <div class="">
                <!-- Footer Text -->
                <div class="text-center text-gray-400 text-base/[24px]">
                    Better<i>ED</i> © 2026
                </div>
            </div>
        </div>
    </div>

    <main id="primary" class="grow" role="main">

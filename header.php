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
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased flex flex-col min-h-screen' ); ?>>
    <?php wp_body_open(); ?>

    <header class="bg-gray-100 py-4 px-4 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto max-w-7xl">
            <nav class="flex items-center justify-between">
                <!-- Logo -->
                <a href="<?php echo home_url('/'); ?>" class="text-2xl font-bold text-black flex items-center">
                    BETTER <span class="italic ml-1">ED</span>
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

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'space-y-3',
                'fallback_cb' => false,
                'walker' => new Custom_Mobile_Anchor_Walker()
            ));
            ?>
            </div>
        </div>
    </header>

    <div class="lg:flex grow">
        <main id="primary" class="grow p-8" role="main">

<?php
// Register Agreements Menu
add_action('after_setup_theme', function () {
    register_nav_menus([
        'agreements' => __('Agreements Menu', 'bathe'),
    ]);
});

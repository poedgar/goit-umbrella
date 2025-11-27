<?php
/**
 * Custom Walker for Desktop Menu with Dropdown Support
 */
class Custom_Anchor_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200"><div class="py-2">';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</div></div>';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0) {
            // Top level items
            if ($has_children) {
                // Dropdown button
                $output .= '<div class="relative group">';
                $output .= '<button class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition-colors flex items-center gap-2">';
                $output .= esc_html($item->title);
                $output .= '<svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
                $output .= '</button>';
            } else {
                // Check if first menu item (про нас style)
                $is_first = strpos($output, '<a') === false;
                $class = $is_first ? 'text-black hover:text-gray-600 transition-colors px-4 py-2 border-2 border-black rounded hover:bg-black hover:text-white' : 'text-black hover:text-gray-600 transition-colors';

                $output .= '<a href="' . esc_url($item->url) . '" class="' . $class . '">';
                $output .= esc_html($item->title);
                $output .= '</a>';
            }
        } else {
            // Dropdown items
            $output .= '<a href="' . esc_url($item->url) . '" target="_blank" rel="noopener noreferrer" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 transition-colors">';
            $output .= '<div class="font-semibold">' . esc_html($item->title) . '</div>';
            if ($item->description) {
                $output .= '<div class="text-sm text-gray-500 mt-1">' . esc_html($item->description) . '</div>';
            }
            $output .= '</a>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0 && $has_children) {
            $output .= '</div>';
        }
    }
}

/**
 * Custom Walker for Mobile Menu
 */
class Custom_Mobile_Anchor_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<div class="border-t pt-3 mt-3"><div class="font-semibold mb-2 text-sm uppercase text-gray-600">наша екосистема</div>';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</div>';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if ($depth === 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $classes);

            if (!$has_children) {
                $is_first = strpos($output, '<a') === false;
                $class = $is_first ? 'block text-black hover:text-gray-600 transition-colors px-4 py-2 border-2 border-black rounded' : 'block text-black hover:text-gray-600 transition-colors py-2';

                $output .= '<li><a href="' . esc_url($item->url) . '" class="' . $class . '">';
                $output .= esc_html($item->title);
                $output .= '</a></li>';
            } else {
                $output .= '<li>';
            }
        } else {
            $output .= '<a href="' . esc_url($item->url) . '" target="_blank" rel="noopener noreferrer" class="block py-2 text-black hover:text-gray-600 transition-colors">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth === 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $classes);

            if ($has_children) {
                $output .= '</li>';
            }
        }
    }
}

/**
 * Register Navigation Menu
 * Add this to your theme's functions.php
 */
function register_header_menu() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'theme-textdomain')
    ));
}
add_action('after_setup_theme', 'register_header_menu');
?>

<?php
/**
* Custom Post Type: Companies
*/

function create_companies_post_type() {

$labels = array(
'name' => 'Companies',
'singular_name' => 'Company',
'menu_name' => 'Companies',
'name_admin_bar' => 'Company',
'add_new' => 'Add New',
'add_new_item' => 'Add New Company',
'edit_item' => 'Edit Company',
'new_item' => 'New Company',
'view_item' => 'View Company',
'search_items' => 'Search Companies',
'not_found' => 'No companies found',
'not_found_in_trash' => 'No companies in trash'
);

$args = array(
'label' => 'Company',
'labels' => $labels,
'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,
'menu_icon' => 'dashicons-building',
'show_in_admin_bar' => true,
'show_in_rest' => true,
'has_archive' => true,
'rewrite' => array('slug' => 'companies')
);

register_post_type('companies', $args);
}
add_action('init', 'create_companies_post_type');

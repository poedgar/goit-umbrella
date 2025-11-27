<?php
/**
* Custom Post Type: Sites
* Add this code to your theme's functions.php file or create a custom plugin
*/

// Register Custom Post Type
function create_sites_post_type() {
$labels = array(
'name' => 'Sites',
'singular_name' => 'Site',
'menu_name' => 'Sites',
'name_admin_bar' => 'Site',
'archives' => 'Site Archives',
'attributes' => 'Site Attributes',
'parent_item_colon' => 'Parent Site:',
'all_items' => 'All Sites',
'add_new_item' => 'Add New Site',
'add_new' => 'Add New',
'new_item' => 'New Site',
'edit_item' => 'Edit Site',
'update_item' => 'Update Site',
'view_item' => 'View Site',
'view_items' => 'View Sites',
'search_items' => 'Search Site',
'not_found' => 'Not found',
'not_found_in_trash' => 'Not found in Trash',
);

$args = array(
'label' => 'Site',
'description' => 'Sites and their information',
'labels' => $labels,
'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,
'menu_icon' => 'dashicons-admin-site-alt3',
'show_in_admin_bar' => true,
'show_in_nav_menus' => true,
'can_export' => true,
'has_archive' => true,
'exclude_from_search' => false,
'publicly_queryable' => true,
'capability_type' => 'post',
'show_in_rest' => true,
);

register_post_type('sites', $args);
}
add_action('init', 'create_sites_post_type', 0);

// Add Custom Meta Boxes
function add_sites_meta_boxes() {
add_meta_box(
'site_details',
'Site Details',
'render_site_details_meta_box',
'sites',
'normal',
'high'
);
}
add_action('add_meta_boxes', 'add_sites_meta_boxes');

// Render Meta Box Content
function render_site_details_meta_box($post) {
wp_nonce_field('sites_meta_box', 'sites_meta_box_nonce');

$site_url = get_post_meta($post->ID, '_site_url', true);
$facebook = get_post_meta($post->ID, '_site_facebook', true);
$twitter = get_post_meta($post->ID, '_site_twitter', true);
$instagram = get_post_meta($post->ID, '_site_instagram', true);
$linkedin = get_post_meta($post->ID, '_site_linkedin', true);
$youtube = get_post_meta($post->ID, '_site_youtube', true);
?>

<table class="form-table">
    <tr>
        <th><label for="site_url">Site URL</label></th>
        <td>
            <input type="url" id="site_url" name="site_url" value="<?php echo esc_attr($site_url); ?>"
                class="regular-text" placeholder="https://example.com">
        </td>
    </tr>
    <tr>
        <th colspan="2"><strong>Social Media Links</strong></th>
    </tr>
    <tr>
        <th><label for="site_facebook">Facebook</label></th>
        <td>
            <input type="url" id="site_facebook" name="site_facebook" value="<?php echo esc_attr($facebook); ?>"
                class="regular-text" placeholder="https://facebook.com/yourpage">
        </td>
    </tr>
    <tr>
        <th><label for="site_twitter">Twitter/X</label></th>
        <td>
            <input type="url" id="site_twitter" name="site_twitter" value="<?php echo esc_attr($twitter); ?>"
                class="regular-text" placeholder="https://twitter.com/yourhandle">
        </td>
    </tr>
    <tr>
        <th><label for="site_instagram">Instagram</label></th>
        <td>
            <input type="url" id="site_instagram" name="site_instagram" value="<?php echo esc_attr($instagram); ?>"
                class="regular-text" placeholder="https://instagram.com/yourhandle">
        </td>
    </tr>
    <tr>
        <th><label for="site_linkedin">LinkedIn</label></th>
        <td>
            <input type="url" id="site_linkedin" name="site_linkedin" value="<?php echo esc_attr($linkedin); ?>"
                class="regular-text" placeholder="https://linkedin.com/company/yourcompany">
        </td>
    </tr>
    <tr>
        <th><label for="site_youtube">YouTube</label></th>
        <td>
            <input type="url" id="site_youtube" name="site_youtube" value="<?php echo esc_attr($youtube); ?>"
                class="regular-text" placeholder="https://youtube.com/@yourchannel">
        </td>
    </tr>
</table>

<style>
.form-table th {
    width: 200px;
}
</style>
<?php
}

// Save Meta Box Data
function save_sites_meta_box_data($post_id) {
    if (!isset($_POST['sites_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['sites_meta_box_nonce'], 'sites_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('site_url', 'site_facebook', 'site_twitter', 'site_instagram', 'site_linkedin', 'site_youtube');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, esc_url_raw($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_sites_meta_box_data');

// Display sites data in admin columns
function set_custom_sites_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['site_url'] = 'Site URL';
    $new_columns['social_media'] = 'Social Media';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_sites_posts_columns', 'set_custom_sites_columns');

function custom_sites_column_content($column, $post_id) {
    switch ($column) {
        case 'site_url':
            $url = get_post_meta($post_id, '_site_url', true);
            if ($url) {
                echo '<a href="' . esc_url($url) . '" target="_blank">' . esc_html($url) . '</a>';
            } else {
                echo '—';
            }
            break;
        case 'social_media':
            $socials = array(
                'facebook' => get_post_meta($post_id, '_site_facebook', true),
                'twitter' => get_post_meta($post_id, '_site_twitter', true),
                'instagram' => get_post_meta($post_id, '_site_instagram', true),
                'linkedin' => get_post_meta($post_id, '_site_linkedin', true),
                'youtube' => get_post_meta($post_id, '_site_youtube', true),
            );
            $active = array_filter($socials);
            echo !empty($active) ? count($active) . ' linked' : '—';
            break;
    }
}
add_action('manage_sites_posts_custom_column', 'custom_sites_column_content', 10, 2);
?>

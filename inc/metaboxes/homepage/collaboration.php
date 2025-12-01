<?php
/**
 * Collaboration / Team — метабокс без ACF
 */

defined('ABSPATH') || exit;

$post_id = 0;

if (isset($_GET['post'])) {
	$post_id = (int) $_GET['post'];
}

$allowed_template = 'page-templates/homepage.php';

if (get_page_template_slug($post_id) !== $allowed_template)
	return;

add_action('add_meta_boxes', function () {
    add_meta_box(
        'collaboration_section_meta',
        'Collaboration',
        'render_team_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_team_metabox_callback($post)
{
    wp_nonce_field('team_metabox_save', 'team_nonce');

    $show    = get_post_meta($post->ID, 'show_collaboration_section', true);
    $title   = get_post_meta($post->ID, 'team_section_title', true);
    $members = get_post_meta($post->ID, 'team_team_members', true) ?: [];
    ?>
<p>
    <label>
        <input type="checkbox" name="show_collaboration_section" value="1" <?php checked($show, '1'); ?> id="show-team">
        Показувати секцію «Команда»
    </label>
</p>

<div id="team-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Заголовок секції</strong></label><br>
        <input type="text" name="team_section_title" style="width:100%"
            value="<?php echo esc_attr($title ?: 'СПІВПРАЦЯ З НАМИ'); ?>">
    </p>

    <hr>
    <h3>Учасники команди</h3>
    <div id="team-members-wrapper">
        <?php foreach ($members as $i => $m) : ?>
        <?php render_team_member_item($i, $m); ?>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary" id="add-team-member">+ Додати учасника</button>
</div>
<?php
}

function render_team_member_item($index, $data = [])
{
    $photo    = $data['photo'] ?? '';
    $name     = $data['name'] ?? '';
    $position = $data['position'] ?? '';
    $email    = $data['email'] ?? '';
    $linkedin = $data['linkedin'] ?? '';
    ?>
<div class="team-member-item" style="margin:15px 0;padding:15px;border:1px solid #ccc;background:#fff;">
    <div class="photo-wrapper" style="margin-bottom:15px;">
        <strong>Фото</strong><br>
        <div class="photo-preview"
            style="width:100px;height:100px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;">
            <?php if ($photo) : ?>
            <img src="<?php echo esc_url($photo); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="team_members[<?php echo $index; ?>][photo]" class="photo-url-input"
            value="<?php echo esc_attr($photo); ?>">
        <div class="photo-actions" style="margin-top:8px;">
            <button type="button" class="button upload-photo-btn">Завантажити</button>
            <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
        </div>
    </div>

    <p><input type="text" name="team_members[<?php echo $index; ?>][name]" placeholder="Ім’я" style="width:100%"
            value="<?php echo esc_attr($name); ?>"></p>
    <p><input type="text" name="team_members[<?php echo $index; ?>][position]" placeholder="Посада" style="width:100%"
            value="<?php echo esc_attr($position); ?>"></p>
    <p><input type="email" name="team_members[<?php echo $index; ?>][email]" placeholder="Email" style="width:100%"
            value="<?php echo esc_attr($email); ?>"></p>
    <p><input type="url" name="team_members[<?php echo $index; ?>][linkedin]" placeholder="LinkedIn" style="width:100%"
            value="<?php echo esc_url($linkedin); ?>"></p>

    <button type="button" class="button button-link-delete remove-team-member">Видалити учасника</button>
</div>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['team_nonce']) || !wp_verify_nonce($_POST['team_nonce'], 'team_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_collaboration_section', isset($_POST['show_collaboration_section']) ? '1' : '0');
    update_post_meta($post_id, 'team_section_title', sanitize_text_field($_POST['team_section_title'] ?? ''));

    $clean = [];
    if (!empty($_POST['team_members']) && is_array($_POST['team_members'])) {
        foreach ($_POST['team_members'] as $m) {
            $clean[] = [
                'photo'    => esc_url_raw($m['photo'] ?? ''),
                'name'     => sanitize_text_field($m['name'] ?? ''),
                'position' => sanitize_text_field($m['position'] ?? ''),
                'email'    => sanitize_email($m['email'] ?? ''),
                'linkedin' => esc_url_raw($m['linkedin'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'team_members', $clean);
});

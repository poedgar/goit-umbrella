<?php
/**
 * Programs / Blocks — метабокс без ACF
 * Адмінка для секції з блоками + кольоровими статистичними картками */

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
        'programs_section_meta',
        'Programs / Blocks',
        'render_programs_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_programs_metabox_callback($post)
{
    wp_nonce_field('programs_metabox_save', 'programs_nonce');

    $show   = get_post_meta($post->ID, 'show_programs_section', true);
    $title  = get_post_meta($post->ID, 'programs_section_title', true);
    $items  = get_post_meta($post->ID, 'programs_items', true) ?: [];
    ?>
<p>
    <label>
        <input type="checkbox" name="show_programs_section" value="1" <?php checked($show, '1'); ?> id="show-programs">
        Показувати секцію «Програми / Блоки»
    </label>
</p>

<div id="programs-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Заголовок секції</strong></label><br>
        <input type="text" name="programs_section_title" style="width:100%"
            value="<?php echo esc_attr($title ?: 'СТВОРЮЄМО НОВУ КУЛЬТУРУ ОСВІТИ'); ?>">
    </p>

    <hr>
    <h3>Блоки / Картки</h3>
    <div id="programs-items-wrapper">
        <?php foreach ($items as $i => $it) : ?>
        <?php render_program_item($i, $it); ?>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary" id="add-program-item">+ Додати блок</button>
</div>
<?php
}

function render_program_item($index, $data = [])
{
    // fields: image, style (text|stats), small_title, subtitle, content, stat_big, stat_left_label, stat_left_value, stat_right_label, stat_right_value, bg_color, cta_label, cta_link
    $image   = $data['image'] ?? '';
    $style   = $data['style'] ?? 'text';
    $s_title = $data['small_title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
    $content = $data['content'] ?? '';
    $stat_big = $data['stat_big'] ?? '';
    $stat_left_label = $data['stat_left_label'] ?? '';
    $stat_left_value = $data['stat_left_value'] ?? '';
    $stat_right_label = $data['stat_right_label'] ?? '';
    $stat_right_value = $data['stat_right_value'] ?? '';
    $bg_color = $data['bg_color'] ?? '#F5A623';
    $cta_label = $data['cta_label'] ?? '';
    $cta_link = $data['cta_link'] ?? '';
    ?>
<div class="program-item" style="margin:15px 0;padding:15px;border:1px solid #ccc;background:#fff;">
    <div style="display:flex;gap:12px;align-items:flex-start;">
        <div class="photo-wrapper" style="min-width:160px;">
            <strong>Ілюстрація</strong><br>
            <div class="photo-preview"
                style="width:160px;height:160px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;margin-top:8px;">
                <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" style="width:100%;height:100%;object-fit:cover;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="programs_items[<?php echo $index; ?>][image]" class="photo-url-input"
                value="<?php echo esc_attr($image); ?>">
            <div class="photo-actions" style="margin-top:8px;">
                <button type="button" class="button upload-photo-btn">Завантажити</button>
                <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
            </div>
        </div>

        <div style="flex:1;">
            <p>
                <label><strong>Тип блоку</strong></label><br>
                <select name="programs_items[<?php echo $index; ?>][style]">
                    <option value="text" <?php selected($style, 'text'); ?>>Опис</option>
                    <option value="stats" <?php selected($style, 'stats'); ?>>Статистика (кольорова картка)</option>
                </select>
            </p>

            <p><input type="text" name="programs_items[<?php echo $index; ?>][small_title]"
                    placeholder="Маленький заголовок / мітка" style="width:100%"
                    value="<?php echo esc_attr($s_title); ?>"></p>

            <p><input type="text" name="programs_items[<?php echo $index; ?>][subtitle]" placeholder="Заголовок"
                    style="width:100%" value="<?php echo esc_attr($subtitle); ?>"></p>

            <p>
                <textarea name="programs_items[<?php echo $index; ?>][content]" placeholder="Опис / контент"
                    style="width:100%" rows="4"><?php echo esc_textarea($content); ?></textarea>
            </p>

            <div style="display:flex;gap:8px;">
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][stat_big]"
                        placeholder="Велика цифра (наприклад 150 000+)" style="width:100%"
                        value="<?php echo esc_attr($stat_big); ?>"></p>
            </div>

            <div style="display:flex;gap:8px;margin-top:8px;">
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][stat_left_value]"
                        placeholder="Ліва цифра" style="width:100%" value="<?php echo esc_attr($stat_left_value); ?>">
                </p>
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][stat_right_value]"
                        placeholder="Права цифра" style="width:100%" value="<?php echo esc_attr($stat_right_value); ?>">
                </p>
            </div>

            <div style="display:flex;gap:8px;margin-top:8px;">
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][stat_left_label]"
                        placeholder="Ліва підпись" style="width:100%" value="<?php echo esc_attr($stat_left_label); ?>">
                </p>
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][stat_right_label]"
                        placeholder="Права підпись" style="width:100%"
                        value="<?php echo esc_attr($stat_right_label); ?>"></p>
            </div>

            <p style="margin-top:8px;"><input type="text" name="programs_items[<?php echo $index; ?>][bg_color]"
                    placeholder="Колір картки (hex)" style="width:220px" value="<?php echo esc_attr($bg_color); ?>"></p>

            <div style="display:flex;gap:8px;margin-top:8px;">
                <p style="flex:1;"><input type="text" name="programs_items[<?php echo $index; ?>][cta_label]"
                        placeholder="Текст кнопки" style="width:100%" value="<?php echo esc_attr($cta_label); ?>"></p>
                <p style="flex:1;"><input type="url" name="programs_items[<?php echo $index; ?>][cta_link]"
                        placeholder="Посилання кнопки" style="width:100%" value="<?php echo esc_attr($cta_link); ?>">
                </p>
            </div>
        </div>
    </div>

    <div style="margin-top:12px;">
        <button type="button" class="button button-link-delete remove-program-item">Видалити блок</button>
    </div>
</div>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['programs_nonce']) || !wp_verify_nonce($_POST['programs_nonce'], 'programs_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_programs_section', isset($_POST['show_programs_section']) ? '1' : '0');
    update_post_meta($post_id, 'programs_section_title', sanitize_text_field($_POST['programs_section_title'] ?? ''));

    $clean = [];
    if (!empty($_POST['programs_items']) && is_array($_POST['programs_items'])) {
        foreach ($_POST['programs_items'] as $it) {
            $clean[] = [
                'image' => esc_url_raw($it['image'] ?? ''),
                'style' => sanitize_text_field($it['style'] ?? 'text'),
                'small_title' => sanitize_text_field($it['small_title'] ?? ''),
                'subtitle' => sanitize_text_field($it['subtitle'] ?? ''),
                'content' => wp_kses_post($it['content'] ?? ''),
                'stat_big' => sanitize_text_field($it['stat_big'] ?? ''),
                'stat_left_label' => sanitize_text_field($it['stat_left_label'] ?? ''),
                'stat_left_value' => sanitize_text_field($it['stat_left_value'] ?? ''),
                'stat_right_label' => sanitize_text_field($it['stat_right_label'] ?? ''),
                'stat_right_value' => sanitize_text_field($it['stat_right_value'] ?? ''),
                'bg_color' => sanitize_text_field($it['bg_color'] ?? ''),
                'cta_label' => sanitize_text_field($it['cta_label'] ?? ''),
                'cta_link' => esc_url_raw($it['cta_link'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'programs_items', $clean);
});
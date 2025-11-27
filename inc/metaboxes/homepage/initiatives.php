<?php
/**
 * Ініціативи (слайдер) — метабокс без ACF
 * Файл: inc/metaboxes/initiatives-metabox.php
 */

defined('ABSPATH') || exit;

// Enqueue media только там, где нужно
add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();
    if ($screen->base === 'post' && $screen->post_type === 'page') {
        wp_enqueue_media();
    }
});

// Регистрация метабокса
add_action('add_meta_boxes', function () {
    add_meta_box(
        'initiatives_section_meta',
        'Ініціативи (Слайдер)',
        'render_initiatives_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_initiatives_metabox_callback($post)
{
    wp_nonce_field('initiatives_metabox_save', 'initiatives_nonce');

    $show     = get_post_meta($post->ID, 'show_initiatives_section', true);
    $title    = get_post_meta($post->ID, 'initiatives_section_title', true);
    $subtitle = get_post_meta($post->ID, 'initiatives_section_subtitle', true);
    $items    = get_post_meta($post->ID, 'initiatives_list', true) ?: [];
?>
    <p>
        <label>
            <input type="checkbox" name="show_initiatives_section" value="1" <?php checked($show, '1'); ?> id="show-initiatives">
            Показувати секцію «Ініціативи»
        </label>
    </p>

    <div id="initiatives-fields" style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
        <p>
            <label><strong>Заголовок секції</strong></label><br>
            <input type="text" name="initiatives_section_title" style="width:100%" value="<?php echo esc_attr($title ?: 'ВІРИМО В ОСВІТУ, ЩО РУХАЄ ВПЕРЕД'); ?>">
        </p>
        <p>
            <label><strong>Підзаголовок</strong></label><br>
            <textarea name="initiatives_section_sub" rows="3" style="width:100%"><?php echo esc_textarea($subtitle ?: 'ТОМУ ПІДТРИМУЄМО СОЦІАЛЬНІ ТА ОСВІТНІ ІНІЦІАТИВИ Й ЗАПУСКАЄМО ВЛАСНІ'); ?></textarea>
        </p>

        <hr>
        <h3>Слайди ініціатив</h3>
        <div id="initiatives-wrapper">
            <?php foreach ($items as $i => $item) : ?>
                <?php render_initiative_item($i, $item); ?>
            <?php endforeach; ?>
        </div>

        <button type="button" class="button button-primary" id="add-initiative">+ Додати ініціативу</button>
    </div>

    <?php
}

function render_initiative_item($index, $data = [])
{
    $photo = $data['photo'] ?? '';
    $title = $data['title'] ?? '';
    $desc  = $data['description'] ?? '';
    ?>
    <div class="initiative-item" style="margin:15px 0; padding:15px; border:1px solid #ccc; background:#fff; border-radius: 1px solid #ddd;">
        <div class="photo-wrapper" style="margin-bottom:15px;">
            <strong>Фото</strong><br>
            <div class="photo-preview" style="width:120px;height:120px;border:2px dashed #ccc;background:#f9f9f9;overflow:hidden;">
                <?php if ($photo) : ?>
                    <img src="<?php echo esc_url($photo); ?>" style="width:100%;height:100%;object-fit:cover;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="initiatives_list[<?php echo $index; ?>][photo]" class="photo-url-input" value="<?php echo esc_attr($photo); ?>">
            <div class="photo-actions" style="margin-top:8px;">
                <button type="button" class="button upload-photo-btn">Завантажити</button>
                <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
            </div>
        </div>

        <p><input type="text" name="initiatives_list[<?php echo $index; ?>][title]" placeholder="Заголовок ініціативи" style="width:100%" value="<?php echo esc_attr($title); ?>"></p>
        <p><textarea name="initiatives_list[<?php echo $index; ?>][description]" placeholder="Опис" rows="3" style="width:100%"><?php echo esc_textarea($desc); ?></textarea></p>

        <button type="button" class="button button-link-delete remove-initiative">Видалити ініціативу</button>
    </div>
    <?php
}

// Сохранение
add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['initiatives_nonce']) || !wp_verify_nonce($_POST['initiatives_nonce'], 'initiatives_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_initiatives_section', isset($_POST['show_initiatives_section']) ? '1' : '0');
    update_post_meta($post_id, 'initiatives_section_title', sanitize_text_field($_POST['initiatives_section_title'] ?? ''));
    update_post_meta($post_id, 'initiatives_section_sub',    sanitize_textarea_field($_POST['initiatives_section_sub'] ?? ''));

    $list = [];
    if (!empty($_POST['initiatives_list']) && is_array($_POST['initiatives_list'])) {
        foreach ($_POST['initiatives_list'] as $item) {
            $list[] = [
                'photo'       => esc_url_raw($item['photo'] ?? ''),
                'title'       => sanitize_text_field($item['title'] ?? ''),
                'description' => sanitize_textarea_field($item['description'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'initiatives_list', $list);
});

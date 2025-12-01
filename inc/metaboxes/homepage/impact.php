<?php
/**
 * Impact / Від знань до впливу — метабокс без ACF
 */

defined('ABSPATH') || exit;

$post_id = 0;
if (isset($_GET['post'])) {
    $post_id = (int) $_GET['post'];
}

$allowed_template = 'page-templates/homepage.php';
if (get_page_template_slug($post_id) !== $allowed_template) return;

add_action('add_meta_boxes', function () {
    add_meta_box(
        'impact_section_meta',
        'Impact / Від знань до впливу',
        'render_impact_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_impact_metabox_callback($post)
{
    wp_nonce_field('impact_metabox_save', 'impact_nonce');

    $show        = get_post_meta($post->ID, 'show_impact_section', true);
    $title       = get_post_meta($post->ID, 'impact_section_title', true);
    $description = get_post_meta($post->ID, 'impact_section_description', true);
    $image       = get_post_meta($post->ID, 'impact_image', true);
    $btn_label   = get_post_meta($post->ID, 'impact_button_label', true);
    $btn_link    = get_post_meta($post->ID, 'impact_button_link', true);
    ?>
<p>
    <label>
        <input type="checkbox" name="show_impact_section" value="1" <?php checked($show, '1'); ?> id="show-impact">
        Показувати секцію «Від знань до впливу»
    </label>
</p>

<div id="impact-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Заголовок</strong></label><br>
        <input type="text" name="impact_section_title" style="width:100%"
            value="<?php echo esc_attr($title ?: 'ВІД ЗНАНЬ ДО ВПЛИВУ'); ?>">
    </p>

    <p>
        <label><strong>Опис / підзаголовок</strong></label><br>
        <textarea name="impact_section_description" style="width:100%"
            rows="4"><?php echo esc_textarea($description); ?></textarea>
    </p>

    <hr>
    <h3>Зображення (ліворуч)</h3>
    <div class="photo-wrapper" style="margin-bottom:12px;">
        <div class="photo-preview"
            style="width:640px;max-width:100%;height:360px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;margin-top:8px;border-radius:8px;">
            <?php if ($image) : ?>
            <img src="<?php echo esc_url($image); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="impact_image" class="photo-url-input" value="<?php echo esc_attr($image); ?>">
        <div class="photo-actions" style="margin-top:8px;">
            <button type="button" class="button upload-photo-btn">Завантажити</button>
            <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
        </div>
    </div>

    <hr>
    <h3>Кнопка поверх зображення</h3>
    <p><input type="text" name="impact_button_label" placeholder="Текст кнопки (наприклад: ДИВИТИСЯ)" style="width:100%"
            value="<?php echo esc_attr($btn_label); ?>"></p>
    <p><input type="url" name="impact_button_link" placeholder="Посилання кнопки" style="width:100%"
            value="<?php echo esc_url($btn_link); ?>"></p>
</div>

<script>
(function() {
    document.addEventListener('click', function(e) {
        if (!e.target) return;

        if (e.target.id === 'show-impact') {
            var wrapper = document.getElementById('impact-fields');
            if (e.target.checked) wrapper.style.display = '';
            else wrapper.style.display = 'none';
        }

        // remove image (reuse collaboration classes)
        if (e.target.classList && e.target.classList.contains('remove-photo-btn')) {
            var container = e.target.closest('#impact-fields') || e.target.closest('.photo-wrapper');
            if (!container) return;
            var preview = container.querySelector('.photo-preview');
            var input = container.querySelector('.photo-url-input');
            if (preview) preview.innerHTML = '';
            if (input) input.value = '';
        }

        // NOTE: do not init wp.media here — use the project's shared uploader (media-upload.php)
    });
})();
</script>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['impact_nonce']) || !wp_verify_nonce($_POST['impact_nonce'], 'impact_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_impact_section', isset($_POST['show_impact_section']) ? '1' : '0');
    update_post_meta($post_id, 'impact_section_title', sanitize_text_field($_POST['impact_section_title'] ?? ''));
    update_post_meta($post_id, 'impact_section_description', wp_kses_post($_POST['impact_section_description'] ?? ''));
    update_post_meta($post_id, 'impact_image', esc_url_raw($_POST['impact_image'] ?? ''));
    update_post_meta($post_id, 'impact_button_label', sanitize_text_field($_POST['impact_button_label'] ?? ''));
    update_post_meta($post_id, 'impact_button_link', esc_url_raw($_POST['impact_button_link'] ?? ''));
});

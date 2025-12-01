<?php
/**
 * Timeline / Our path — метабокс без ACF
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
        'timeline_section_meta',
        'Timeline / Наш шлях',
        'render_timeline_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_timeline_metabox_callback($post)
{
    wp_nonce_field('timeline_metabox_save', 'timeline_nonce');

    $show   = get_post_meta($post->ID, 'show_timeline_section', true);
    $title  = get_post_meta($post->ID, 'timeline_section_title', true);
    $items  = get_post_meta($post->ID, 'timeline_items', true) ?: [];
    ?>
<p>
    <label>
        <input type="checkbox" name="show_timeline_section" value="1" <?php checked($show, '1'); ?> id="show-timeline">
        Показувати секцію «Наш шлях»
    </label>
</p>

<div id="timeline-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Заголовок секції</strong></label><br>
        <input type="text" name="timeline_section_title" style="width:100%"
            value="<?php echo esc_attr($title ?: 'НАШ ШЛЯХ'); ?>">
    </p>

    <hr>
    <h3>Кроки / Карточки</h3>
    <div id="timeline-items-wrapper">
        <?php foreach ($items as $i => $it) : ?>
        <?php render_timeline_item($i, $it); ?>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary" id="add-timeline-item">+ Додати крок</button>
</div>

<script>
(function() {
    // Minimal UI helpers: toggle, add, remove. Image uploader handled by same classes as collaboration metabox.
    document.addEventListener('click', function(e) {
        if (!e.target) return;

        if (e.target.id === 'show-timeline') {
            var wrapper = document.getElementById('timeline-fields');
            if (e.target.checked) wrapper.style.display = '';
            else wrapper.style.display = 'none';
        }

        if (e.target.id === 'add-timeline-item') {
            var wrapper = document.getElementById('timeline-items-wrapper');
            var idx = wrapper.querySelectorAll('.timeline-item').length;
            var template =
                `<?php ob_start(); render_timeline_item('%%INDEX%%', []); $tpl = ob_get_clean(); echo str_replace("\n", "\\n", addslashes($tpl)); ?>`;
            var html = template.replace(/%%INDEX%%/g, idx);
            wrapper.insertAdjacentHTML('beforeend', html);
        }

        if (e.target.classList && e.target.classList.contains('remove-timeline-item')) {
            var item = e.target.closest('.timeline-item');
            if (item) item.remove();
        }

        // reuse collaboration classes for upload / remove buttons — media uploader lives elsewhere in theme
        if (e.target.classList && e.target.classList.contains('remove-photo-btn')) {
            var container = e.target.closest('.timeline-item');
            if (!container) return;
            var preview = container.querySelector('.photo-preview');
            var input = container.querySelector('.photo-url-input');
            if (preview) preview.innerHTML = '';
            if (input) input.value = '';
        }
    });
})();
</script>
<?php
}

function render_timeline_item($index, $data = [])
{
    $image   = $data['image'] ?? '';
    $year    = $data['year'] ?? '';
    $heading = $data['heading'] ?? '';
    $content = $data['content'] ?? '';
    ?>
<div class="timeline-item" style="margin:15px 0;padding:15px;border:1px solid #ccc;background:#fff;">
    <div class="photo-wrapper" style="margin-bottom:12px;">
        <strong>Фото / Ілюстрація</strong><br>
        <div class="photo-preview"
            style="width:320px;height:220px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;margin-top:8px;">
            <?php if ($image) : ?>
            <img src="<?php echo esc_url($image); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="timeline_items[<?php echo $index; ?>][image]" class="photo-url-input"
            value="<?php echo esc_attr($image); ?>">
        <div class="photo-actions" style="margin-top:8px;">
            <button type="button" class="button upload-photo-btn">Завантажити</button>
            <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
        </div>
    </div>

    <p><input type="text" name="timeline_items[<?php echo $index; ?>][year]" placeholder="Рік" style="width:100%"
            value="<?php echo esc_attr($year); ?>"></p>
    <p><input type="text" name="timeline_items[<?php echo $index; ?>][heading]" placeholder="Заголовок"
            style="width:100%" value="<?php echo esc_attr($heading); ?>"></p>
    <p><textarea name="timeline_items[<?php echo $index; ?>][content]" placeholder="Опис" style="width:100%"
            rows="5"><?php echo esc_textarea($content); ?></textarea></p>

    <button type="button" class="button button-link-delete remove-timeline-item">Видалити крок</button>
</div>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['timeline_nonce']) || !wp_verify_nonce($_POST['timeline_nonce'], 'timeline_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_timeline_section', isset($_POST['show_timeline_section']) ? '1' : '0');
    update_post_meta($post_id, 'timeline_section_title', sanitize_text_field($_POST['timeline_section_title'] ?? ''));

    $clean = [];
    if (!empty($_POST['timeline_items']) && is_array($_POST['timeline_items'])) {
        foreach ($_POST['timeline_items'] as $it) {
            $clean[] = [
                'image'   => esc_url_raw($it['image'] ?? ''),
                'year'    => sanitize_text_field($it['year'] ?? ''),
                'heading' => sanitize_text_field($it['heading'] ?? ''),
                'content' => wp_kses_post($it['content'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'timeline_items', $clean);
});

<?php
/**
 * Awards — метабокс без ACF
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
        'awards_section_meta',
        'Awards',
        'render_awards_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_awards_metabox_callback($post)
{
    wp_nonce_field('awards_metabox_save', 'awards_nonce');

    $show   = get_post_meta($post->ID, 'show_awards_section', true);
    $title  = get_post_meta($post->ID, 'awards_section_title', true);
    $items  = get_post_meta($post->ID, 'awards_items', true) ?: [];
    ?>
<p>
    <label>
        <input type="checkbox" name="show_awards_section" value="1" <?php checked($show, '1'); ?> id="show-awards">
        Показувати секцію «Нагороди»
    </label>
</p>

<div id="awards-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Заголовок секції</strong></label><br>
        <input type="text" name="awards_section_title" style="width:100%"
            value="<?php echo esc_attr($title ?: 'НАШІ НАГОРОДИ'); ?>">
    </p>

    <hr>
    <h3>Логотипи / Нагороди</h3>
    <div id="awards-items-wrapper">
        <?php foreach ($items as $i => $it) : ?>
        <?php render_award_item($i, $it); ?>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary" id="add-award-item">+ Додати логотип</button>
</div>

<script>
(function() {
    // Minimal inline JS to support add/remove UI in WP editor quickly.
    // For full UX you may want to move this to an enqueued admin JS file.
    document.addEventListener('click', function(e) {
        if (!e.target) return;

        // Toggle section visibility
        if (e.target.id === 'show-awards') {
            var wrapper = document.getElementById('awards-fields');
            if (e.target.checked) wrapper.style.display = '';
            else wrapper.style.display = 'none';
        }

        // Add new award
        if (e.target.id === 'add-award-item') {
            var wrapper = document.getElementById('awards-items-wrapper');
            var idx = wrapper.querySelectorAll('.award-item').length;
            var template =
                `<?php ob_start(); render_award_item('%%INDEX%%', []); $tpl = ob_get_clean(); echo str_replace("\n", "\\n", addslashes($tpl)); ?>`;
            var html = template.replace(/%%INDEX%%/g, idx);
            wrapper.insertAdjacentHTML('beforeend', html);
        }

        // Remove award
        if (e.target.classList && e.target.classList.contains('remove-award-item')) {
            var item = e.target.closest('.award-item');
            if (item) item.remove();
        }
    });
})();
</script>
<?php
}

function render_award_item($index, $data = [])
{
    $image = $data['image'] ?? '';
    $title = $data['title'] ?? '';
    $link  = $data['link'] ?? '';
    ?>
<div class="award-item" style="margin:15px 0;padding:15px;border:1px solid #ccc;background:#fff;">
    <div class="photo-wrapper" style="margin-bottom:12px;">
        <strong>Логотип</strong><br>
        <div class="photo-preview"
            style="width:160px;height:80px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;margin-top:8px;">
            <?php if ($image) : ?>
            <img src="<?php echo esc_url($image); ?>" style="width:100%;height:100%;object-fit:contain;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="awards_items[<?php echo $index; ?>][image]" class="photo-url-input"
            value="<?php echo esc_attr($image); ?>">
        <div class="photo-actions" style="margin-top:8px;">
            <button type="button" class="button upload-photo-btn">Завантажити</button>
            <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
        </div>
    </div>

    <p><input type="text" name="awards_items[<?php echo $index; ?>][title]" placeholder="Назва / опис"
            style="width:100%" value="<?php echo esc_attr($title); ?>"></p>
    <p><input type="url" name="awards_items[<?php echo $index; ?>][link]" placeholder="Посилання (опційно)"
            style="width:100%" value="<?php echo esc_url($link); ?>"></p>

    <button type="button" class="button button-link-delete remove-award-item">Видалити логотип</button>
</div>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['awards_nonce']) || !wp_verify_nonce($_POST['awards_nonce'], 'awards_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_awards_section', isset($_POST['show_awards_section']) ? '1' : '0');
    update_post_meta($post_id, 'awards_section_title', sanitize_text_field($_POST['awards_section_title'] ?? ''));

    $clean = [];
    if (!empty($_POST['awards_items']) && is_array($_POST['awards_items'])) {
        foreach ($_POST['awards_items'] as $it) {
            $clean[] = [
                'image' => esc_url_raw($it['image'] ?? ''),
                'title' => sanitize_text_field($it['title'] ?? ''),
                'link'  => esc_url_raw($it['link'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'awards_items', $clean);
});

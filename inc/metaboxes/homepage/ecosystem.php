<?php
/**
 * Ecosystem / Better Ed — метабокс без ACF
 *
 * This version proxies uploads for dynamically added items to an existing
 * upload button that the project's centralized uploader already bound to.
 * That allows uploads to work without touching the centralized uploader.
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
        'ecosystem_section_meta',
        'Ecosystem / Better Ed',
        'render_ecosystem_metabox_callback',
        'page',
        'normal',
        'high'
    );
});

function render_ecosystem_metabox_callback($post)
{
    wp_nonce_field('ecosystem_metabox_save', 'ecosystem_nonce');

    $show         = get_post_meta($post->ID, 'show_ecosystem_section', true);
    $title_big    = get_post_meta($post->ID, 'ecosystem_title_big', true);
    $subtitle     = get_post_meta($post->ID, 'ecosystem_subtitle', true);
    $left_image   = get_post_meta($post->ID, 'ecosystem_left_image', true);
    $right_images = get_post_meta($post->ID, 'ecosystem_right_images', true) ?: [];
    $logos        = get_post_meta($post->ID, 'ecosystem_logos', true) ?: [];
    ?>
<p>
    <label>
        <input type="checkbox" name="show_ecosystem_section" value="1" <?php checked($show, '1'); ?>
            id="show-ecosystem">
        Показувати секцію «Ecosystem / Better Ed»
    </label>
</p>

<div id="ecosystem-fields"
    style="<?php echo $show ? '' : 'display:none;'; ?> padding:15px; background:#fafafa; border:1px solid #ddd; border-radius:6px;">
    <p>
        <label><strong>Великий заголовок</strong></label><br>
        <input type="text" name="ecosystem_title_big" style="width:100%"
            value="<?php echo esc_attr($title_big ?: 'BETTER ED'); ?>">
    </p>

    <p>
        <label><strong>Підзаголовок / опис</strong></label><br>
        <textarea name="ecosystem_subtitle" style="width:100%"
            rows="3"><?php echo esc_textarea($subtitle); ?></textarea>
    </p>

    <hr>
    <h3>Ліве велике зображення</h3>
    <div class="photo-wrapper" style="margin-bottom:12px;">
        <div class="photo-preview"
            style="width:100%;max-width:760px;height:360px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;margin-top:8px;border-radius:8px;">
            <?php if ($left_image) : ?>
            <img src="<?php echo esc_url($left_image); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php endif; ?>
        </div>
        <input type="hidden" name="ecosystem_left_image" class="photo-url-input"
            value="<?php echo esc_attr($left_image); ?>">
        <div class="photo-actions" style="margin-top:8px;">
            <!-- keep real upload button here so centralized uploader will bind to something on initial load -->
            <button type="button" class="button upload-photo-btn">Завантажити</button>
            <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
        </div>
    </div>

    <hr>
    <h3>Праворуч — стопка картинок (вертикально)</h3>
    <div id="ecosystem-right-images-wrapper">
        <?php foreach ($right_images as $i => $ri) : ?>
        <div class="right-image-item" style="margin-bottom:12px;padding:10px;border:1px solid #ddd;background:#fff;">
            <div class="photo-preview"
                style="width:220px;height:64px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;">
                <?php if ($ri) : ?>
                <img src="<?php echo esc_url($ri); ?>" style="width:100%;height:100%;object-fit:cover;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="ecosystem_right_images[<?php echo $i; ?>]" class="photo-url-input"
                value="<?php echo esc_attr($ri); ?>">
            <div style="margin-top:6px;">
                <!-- existing saved items keep real upload button class so they remain bound -->
                <button type="button" class="button upload-photo-btn">Завантажити</button>
                <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
                <button type="button" class="button remove-right-image" style="margin-left:6px;">Видалити блок</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" id="add-right-image">+ Додати картинку</button>

    <hr>
    <h3>Логотипи внизу</h3>
    <div id="ecosystem-logos-wrapper">
        <?php foreach ($logos as $i => $lg) : ?>
        <div class="ecosystem-logo-item"
            style="margin:10px 0;padding:10px;border:1px solid #ddd;background:#fff;display:flex;align-items:center;gap:12px;">
            <div class="photo-preview"
                style="width:120px;height:48px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;">
                <?php if (!empty($lg['image'])) : ?>
                <img src="<?php echo esc_url($lg['image']); ?>" style="width:100%;height:100%;object-fit:contain;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="ecosystem_logos[<?php echo $i; ?>][image]" class="photo-url-input"
                value="<?php echo esc_attr($lg['image'] ?? ''); ?>">
            <input type="text" name="ecosystem_logos[<?php echo $i; ?>][alt]" placeholder="alt / label"
                value="<?php echo esc_attr($lg['alt'] ?? ''); ?>" style="flex:1;">
            <div>
                <!-- existing saved items keep real upload button class so they remain bound -->
                <button type="button" class="button upload-photo-btn">Завантажити</button>
                <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
                <button type="button" class="button remove-ecosystem-logo" style="margin-left:6px;">Видалити
                    блок</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button button-primary" id="add-ecosystem-logo">+ Додати логотип</button>
</div>

<script>
(function() {
    // Create new items using proxy upload buttons (upload-photo-proxy).
    // Proxy finds an existing bound upload button on the page, moves it
    // into the new item, triggers a click and restores the original button.
    // This avoids touching the centralized uploader.

    function makeRightImageItem(index) {
        var root = document.createElement('div');
        root.className = 'right-image-item';
        root.style = 'margin-bottom:12px;padding:10px;border:1px solid #ddd;background:#fff;';

        var preview = document.createElement('div');
        preview.className = 'photo-preview';
        preview.style = 'width:220px;height:64px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ecosystem_right_images[' + index + ']';
        input.className = 'photo-url-input';
        input.value = '';

        var controls = document.createElement('div');
        controls.style = 'margin-top:6px;';

        // proxy button (not bound by centralized uploader)
        var proxy = document.createElement('button');
        proxy.type = 'button';
        proxy.className = 'button upload-photo-proxy';
        proxy.textContent = 'Завантажити';

        var remBtn = document.createElement('button');
        remBtn.type = 'button';
        remBtn.className = 'button remove-photo-btn';
        remBtn.style.color = '#a00';
        remBtn.textContent = 'Видалити';

        var delBlock = document.createElement('button');
        delBlock.type = 'button';
        delBlock.className = 'button remove-right-image';
        delBlock.style.marginLeft = '6px';
        delBlock.textContent = 'Видалити блок';

        controls.appendChild(proxy);
        controls.appendChild(remBtn);
        controls.appendChild(delBlock);

        root.appendChild(preview);
        root.appendChild(input);
        root.appendChild(controls);

        return root;
    }

    function makeLogoItem(index) {
        var root = document.createElement('div');
        root.className = 'ecosystem-logo-item';
        root.style =
            'margin:10px 0;padding:10px;border:1px solid #ddd;background:#fff;display:flex;align-items:center;gap:12px;';

        var preview = document.createElement('div');
        preview.className = 'photo-preview';
        preview.style = 'width:120px;height:48px;border:2px dashed #ccc;overflow:hidden;background:#f9f9f9;';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ecosystem_logos[' + index + '][image]';
        input.className = 'photo-url-input';
        input.value = '';

        var alt = document.createElement('input');
        alt.type = 'text';
        alt.name = 'ecosystem_logos[' + index + '][alt]';
        alt.placeholder = 'alt / label';
        alt.style = 'flex:1;';

        var ctrlWrap = document.createElement('div');

        var proxy = document.createElement('button');
        proxy.type = 'button';
        proxy.className = 'button upload-photo-proxy';
        proxy.textContent = 'Завантажити';

        var remBtn = document.createElement('button');
        remBtn.type = 'button';
        remBtn.className = 'button remove-photo-btn';
        remBtn.style.color = '#a00';
        remBtn.textContent = 'Видалити';

        var delBlock = document.createElement('button');
        delBlock.type = 'button';
        delBlock.className = 'button remove-ecosystem-logo';
        delBlock.style.marginLeft = '6px';
        delBlock.textContent = 'Видалити блок';

        ctrlWrap.appendChild(proxy);
        ctrlWrap.appendChild(remBtn);
        ctrlWrap.appendChild(delBlock);

        root.appendChild(preview);
        root.appendChild(input);
        root.appendChild(alt);
        root.appendChild(ctrlWrap);

        return root;
    }

    // Find a "real" upload button that centralized uploader bound to.
    // Prefer one outside our dynamic containers (e.g. the left image upload).
    function findRealUploadButton() {
        // prefer a button within .photo-actions (left image) or any existing upload-photo-btn
        var sel = '.photo-actions .upload-photo-btn, .upload-photo-btn';
        var nodes = document.querySelectorAll(sel);
        for (var i = 0; i < nodes.length; i++) {
            var n = nodes[i];
            // ignore proxy buttons if any
            if (n.classList.contains('upload-photo-proxy')) continue;
            // ensure it is visible and in DOM
            if (!document.body.contains(n)) continue;
            return n;
        }
        return null;
    }

    // Proxy click handler: move real button into target, trigger click, restore when input changes.
    function handleProxyClick(e) {
        if (!e.target.classList || !e.target.classList.contains('upload-photo-proxy')) return;
        e.preventDefault();

        var proxyBtn = e.target;
        // target container is closest item
        var container = proxyBtn.closest('.right-image-item, .ecosystem-logo-item');
        if (!container) return;

        var input = container.querySelector('.photo-url-input');
        var preview = container.querySelector('.photo-preview');

        var realBtn = findRealUploadButton();
        if (!realBtn) {
            // fallback to prompt
            var url = prompt('Image URL');
            if (url) {
                if (input) input.value = url;
                if (preview) preview.innerHTML = '<img src="' + url +
                    '" style="width:100%;height:100%;object-fit:cover;display:block;">';
            }
            return;
        }

        // Save original location to restore later
        var originalParent = realBtn.parentNode;
        var originalNext = realBtn.nextSibling;

        // CRITICAL FIX: Wrap container in a temporary .photo-wrapper div
        // so the centralized uploader can find it with $(currentBtn).closest('.photo-wrapper')
        var tempWrapper = document.createElement('div');
        tempWrapper.className = 'photo-wrapper';
        tempWrapper.style.display = 'contents'; // doesn't affect layout

        // Wrap the container
        container.parentNode.insertBefore(tempWrapper, container);
        tempWrapper.appendChild(container);

        // Move realBtn into our container's controls so centralized uploader uses this context
        var controls = proxyBtn.parentNode;
        controls.insertBefore(realBtn, proxyBtn);
        // hide proxy while uploader is open
        proxyBtn.style.display = 'none';

        var restored = false;

        function restore() {
            if (restored) return;
            restored = true;

            // Unwrap the temporary .photo-wrapper
            if (tempWrapper.parentNode) {
                tempWrapper.parentNode.insertBefore(container, tempWrapper);
                tempWrapper.remove();
            }

            // restore real button to original place
            if (originalParent) {
                if (originalNext) originalParent.insertBefore(realBtn, originalNext);
                else originalParent.appendChild(realBtn);
            }
            // show proxy again
            proxyBtn.style.display = '';
            // cleanup listeners
            if (input) {
                input.removeEventListener('change', onChange);
            }
            if (observer) observer.disconnect();
            clearTimeout(timeoutId);
        }

        function onChange() {
            // small delay to ensure preview was updated by centralized uploader
            setTimeout(restore, 50);
        }

        // use MutationObserver on input.value in case central uploader sets value without dispatching 'change'
        var observer = null;
        if (input) {
            observer = new MutationObserver(function(mutations) {
                for (var i = 0; i < mutations.length; i++) {
                    if (mutations[i].attributeName === 'value') {
                        // attribute 'value' changed
                        restore();
                        return;
                    }
                }
            });
            observer.observe(input, {
                attributes: true,
                attributeFilter: ['value']
            });
            input.addEventListener('change', onChange);
        }

        // safety fallback: restore after 12s if nothing happens
        var timeoutId = setTimeout(restore, 12000);

        // trigger click on the real (bound) button
        realBtn.click();
    }

    // global click handler for metabox controls
    document.addEventListener('click', function(e) {
        if (!e.target) return;

        // toggle visibility
        if (e.target.id === 'show-ecosystem') {
            var w = document.getElementById('ecosystem-fields');
            if (e.target.checked) w.style.display = '';
            else w.style.display = 'none';
        }

        // add right image
        if (e.target.id === 'add-right-image') {
            var wrapper = document.getElementById('ecosystem-right-images-wrapper');
            var idx = wrapper.querySelectorAll('.right-image-item').length;
            var node = makeRightImageItem(idx);
            wrapper.appendChild(node);
            // do not add 'upload-photo-btn' class here; we use proxy to reuse existing bound button
            document.dispatchEvent(new CustomEvent('uploader:element-added', {
                detail: {
                    element: node
                }
            }));
            return;
        }

        // add logo
        if (e.target.id === 'add-ecosystem-logo') {
            var wrapper = document.getElementById('ecosystem-logos-wrapper');
            var idx = wrapper.querySelectorAll('.ecosystem-logo-item').length;
            var node = makeLogoItem(idx);
            wrapper.appendChild(node);
            document.dispatchEvent(new CustomEvent('uploader:element-added', {
                detail: {
                    element: node
                }
            }));
            return;
        }

        // remove blocks
        if (e.target.classList && e.target.classList.contains('remove-right-image')) {
            var item = e.target.closest('.right-image-item');
            if (item) item.remove();
            return;
        }
        if (e.target.classList && e.target.classList.contains('remove-ecosystem-logo')) {
            var item = e.target.closest('.ecosystem-logo-item');
            if (item) item.remove();
            return;
        }

        // proxy upload click
        if (e.target.classList && e.target.classList.contains('upload-photo-proxy')) {
            handleProxyClick(e);
            return;
        }
    });
})();
</script>
<?php
}

add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['ecosystem_nonce']) || !wp_verify_nonce($_POST['ecosystem_nonce'], 'ecosystem_metabox_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'show_ecosystem_section', isset($_POST['show_ecosystem_section']) ? '1' : '0');
    update_post_meta($post_id, 'ecosystem_title_big', sanitize_text_field($_POST['ecosystem_title_big'] ?? ''));
    update_post_meta($post_id, 'ecosystem_subtitle', wp_kses_post($_POST['ecosystem_subtitle'] ?? ''));
    update_post_meta($post_id, 'ecosystem_left_image', esc_url_raw($_POST['ecosystem_left_image'] ?? ''));

    $right_images_clean = [];
    if (!empty($_POST['ecosystem_right_images']) && is_array($_POST['ecosystem_right_images'])) {
        foreach ($_POST['ecosystem_right_images'] as $ri) {
            $right_images_clean[] = esc_url_raw($ri);
        }
    }
    update_post_meta($post_id, 'ecosystem_right_images', $right_images_clean);

    $logos_clean = [];
    if (!empty($_POST['ecosystem_logos']) && is_array($_POST['ecosystem_logos'])) {
        foreach ($_POST['ecosystem_logos'] as $lg) {
            $logos_clean[] = [
                'image' => esc_url_raw($lg['image'] ?? ''),
                'alt'   => sanitize_text_field($lg['alt'] ?? ''),
            ];
        }
    }
    update_post_meta($post_id, 'ecosystem_logos', $logos_clean);
});


<?php
defined('ABSPATH') || exit;

add_action('admin_enqueue_scripts', function () {
    $screen = get_current_screen();
    // FIX: Check if we are on a post or page editing screen (removed strict 'page' check)
    if ($screen && $screen->base === 'post') {
        wp_enqueue_media();
    }
});

add_action('admin_footer', function () {
    $screen = get_current_screen();
    // FIX: Ensure script outputs on both posts and pages
    if (!$screen || $screen->base !== 'post') return;
    ?>
<script>
jQuery(function($) {

    // 1. Define variables globally within this function scope
    let frame;
    let currentBtn; // This variable will track WHICH button was clicked

    // 2. Generic function to handle file selection
    $(document).on('click', '.upload-photo-btn', function(e) {
        e.preventDefault();

        // Save the specific button that was clicked
        currentBtn = this;

        // If the frame already exists, open it and stop here
        if (frame) {
            frame.open();
            return;
        }

        // Create the media frame ONLY ONCE
        frame = wp.media({
            title: 'Оберіть зображення',
            button: {
                text: 'Використати'
            },
            multiple: false, // Set to true if you want to allow selecting multiple files
            library: {
                type: 'image'
            }
        });

        // When an image is selected, run this callback
        frame.on('select', function() {
            // Get the selected image data
            const selection = frame.state().get('selection').first().toJSON();
            const url = selection.url;

            // Use 'currentBtn' to find the specific wrapper for the row we are editing
            const $wrapper = $(currentBtn).closest('.photo-wrapper');

            // Update inputs and preview
            $wrapper.find('.photo-url-input').val(url);
            $wrapper.find('.photo-preview').html('<img src="' + url + '" style="max-width:100%;height:auto;display:block;">');
        });

        frame.open();
    });

    // --- The rest of your code works fine, kept below for completeness ---

    // Remove photo
    $(document).on('click', '.remove-photo-btn', function(e) {
        e.preventDefault();
        const $wrapper = $(this).closest('.photo-wrapper');
        $wrapper.find('.photo-url-input').val('');
        $wrapper.find('.photo-preview').empty();
    });

    // Add Initiative
    $('#add-initiative').on('click', function() {
        const index = $('.initiative-item').length; // Ensure unique index based on count
        const html = `
                <div class="initiative-item" style="background:#fff;padding:20px;margin:15px 0;border:1px solid #ddd;border-radius:8px;">
                    <div class="photo-wrapper">
                        <strong>Фото:</strong><br>
                        <div class="photo-preview" style="width:150px;height:150px;border:2px dashed #ccc;background:#fafafa;"></div>
                        <input type="hidden" name="initiatives_list[${index}][photo]" class="photo-url-input" value="">
                        <button type="button" class="button upload-photo-btn">Завантажити фото</button>
                        <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
                    </div>
                    <p style="margin-top:15px;"><input type="text" name="initiatives_list[${index}][title]" placeholder="Заголовок" style="width:100%;"></p>
                    <p><textarea name="initiatives_list[${index}][description]" placeholder="Опис" rows="3" style="width:100%;"></textarea></p>
                    <button type="button" class="button button-link-delete remove-initiative">Видалити ініціативу</button>
                </div>`;
        $('#initiatives-wrapper').append(html);
    });

    // Add Team Member
    $('#add-team-member').on('click', function() {
        const index = $('.team-member-item').length;
        const html = `
                <div class="team-member-item" style="background:#fff;padding:20px;margin:15px 0;border:1px solid #ddd;border-radius:8px;">
                    <div class="photo-wrapper">
                        <strong>Фото:</strong><br>
                        <div class="photo-preview" style="width:120px;height:120px;border:2px dashed #ccc;background:#fafafa;"></div>
                        <input type="hidden" name="team_members[${index}][photo]" class="photo-url-input" value="">
                        <button type="button" class="button upload-photo-btn">Завантажити фото</button>
                        <button type="button" class="button remove-photo-btn" style="color:#a00;">Видалити</button>
                    </div>
                    <p style="margin-top:10px;"><input type="text" name="team_members[${index}][name]" placeholder="Ім’я" style="width:100%;"></p>
                    <p><input type="text" name="team_members[${index}][position]" placeholder="Посада" style="width:100%;"></p>
                    <p><input type="email" name="team_members[${index}][email]" placeholder="Email" style="width:100%;"></p>
                    <p><input type="url" name="team_members[${index}][linkedin]" placeholder="LinkedIn" style="width:100%;"></p>
                    <button type="button" class="button button-link-delete remove-team-member">Видалити учасника</button>
                </div>`;
        $('#team-members-wrapper').append(html);
    });

    // Remove Items
    $(document).on('click', '.remove-initiative, .remove-team-member', function() {
        $(this).closest('.initiative-item, .team-member-item').remove();
    });

    // Toggle Visibility
    $('#show-initiatives, #show-team').on('change', function() {
        $(this).parent().next('div').toggle(this.checked);
    });
});
</script>
<?php
});
?>

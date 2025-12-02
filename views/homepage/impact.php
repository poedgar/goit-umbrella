<?php
// Retrieve values from ACF
$show_section = get_field('show_impact_section');
$title        = get_field('impact_section_title') ?: 'ВІД ЗНАНЬ ДО ВПЛИВУ';
$description  = get_field('impact_section_description');
$image        = get_field('impact_image'); // returns URL (per JSON settings)
$btn_label    = get_field('impact_button_label');
$btn_link     = get_field('impact_button_link');

// Don't render if disabled
if (!$show_section) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

            <!-- Left: Image with centered overlay button -->
            <div class="relative flex justify-center">
                <?php if ($image): ?>
                <div class="rounded-lg overflow-hidden" style="width:100%;max-width:720px;">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>"
                        style="width:100%;height:100%;object-fit:cover;display:block;">

                    <?php if ($btn_label): ?>
                    <a href="<?= esc_url($btn_link ?: '#'); ?>" class="absolute"
                        style="left:50%;top:50%;transform:translate(-50%,-50%);background:#111;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;">
                        <?= esc_html($btn_label); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php else: ?>
                <div style="width:100%;max-width:720px;height:360px;background:#eee;border-radius:10px;"></div>
                <?php endif; ?>
            </div>

            <!-- Right: Title + Description -->
            <div class="text-right lg:text-left">
                <?php if ($title): ?>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"><?= esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($description): ?>
                <div class="text-gray-600 text-lg"><?= wp_kses_post(wpautop($description)); ?></div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

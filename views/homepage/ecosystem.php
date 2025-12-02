<?php
// Retrieve values from ACF
$show_section   = get_field('show_ecosystem_section');
$title_big      = get_field('ecosystem_title_big') ?: 'BETTER ED';
$subtitle       = get_field('ecosystem_subtitle');
$left_image     = get_field('ecosystem_left_image');
$right_images   = get_field('ecosystem_right_images') ?: [];
$logos          = get_field('ecosystem_logos') ?: [];

// Don't render if disabled
if (!$show_section) return;
?>

<section class="py-20 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left: Big title and subtitle -->
            <div>
                <h1 class="text-6xl lg:text-8xl font-black leading-tight mb-6"><?= esc_html($title_big); ?></h1>
                <?php if ($subtitle): ?>
                <div class="text-gray-600 max-w-xl"><?= wp_kses_post(wpautop($subtitle)); ?></div>
                <?php endif; ?>
            </div>

            <!-- Right: stacked images -->
            <div class="flex flex-col items-center lg:items-end gap-4">
                <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end;">
                    <?php if (!empty($right_images)): ?>
                    <?php foreach ($right_images as $ri):
                            $image_url = $ri['image'] ?? '';
                            if (!$image_url) continue;
                        ?>
                    <div
                        style="width:260px;height:56px;border-radius:8px;overflow:hidden;background:#fff;box-shadow:0 1px 0 rgba(0,0,0,0.06);">
                        <img src="<?= esc_url($image_url); ?>" alt=""
                            style="width:100%;height:100%;object-fit:cover;display:block;">
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- placeholder stack -->
                    <div style="width:260px;height:56px;border-radius:8px;background:#eee;"></div>
                    <div style="width:220px;height:56px;border-radius:8px;background:#eee;"></div>
                    <div style="width:200px;height:56px;border-radius:8px;background:#eee;"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ($left_image): ?>
        <div class="mt-12 flex justify-center">
            <div style="width:100%;max-width:1200px;border-radius:12px;overflow:hidden;">
                <img src="<?= esc_url($left_image); ?>" alt="<?= esc_attr($title_big); ?>"
                    style="width:100%;height:auto;display:block;object-fit:cover;">
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($logos)): ?>
        <div class="mt-12">
            <div class="flex flex-wrap items-center justify-center gap-8">
                <?php foreach ($logos as $lg):
                    $image = $lg['image'] ?? '';
                    $alt   = $lg['alt'] ?? '';
                    if (!$image) continue;
                ?>
                <div class="flex items-center" style="max-width:160px;">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($alt); ?>"
                        style="max-height:48px;width:auto;display:block;object-fit:contain;">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

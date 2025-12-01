<?php
// Retrieve values from MetaBoxes
$show_section = get_post_meta(get_the_ID(), 'show_programs_section', true);
$title        = get_post_meta(get_the_ID(), 'programs_section_title', true) ?: 'СТВОРЮЄМО НОВУ КУЛЬТУРУ ОСВІТИ';
$items        = get_post_meta(get_the_ID(), 'programs_items', true) ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8 md:mb-12">
            <?= esc_html($title); ?>
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-8">
                <?php foreach ($items as $item):
                    if (($item['style'] ?? 'text') !== 'text') continue;
                    $image = $item['image'] ?? '';
                    $small = $item['small_title'] ?? '';
                    $subtitle = $item['subtitle'] ?? '';
                    $content = $item['content'] ?? '';
                    $cta_label = $item['cta_label'] ?? '';
                    $cta_link = $item['cta_link'] ?? '';
                ?>
                <div class="bg-white rounded-lg p-6 shadow-sm flex gap-6">
                    <?php if ($image): ?>
                    <div class="w-1/3 min-w-[120px]">
                        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($subtitle); ?>"
                            class="w-full h-full object-cover rounded">
                    </div>
                    <?php endif; ?>
                    <div class="flex-1">
                        <?php if ($small): ?><div class="text-sm font-semibold text-gray-500 mb-2">
                            <?= esc_html($small); ?></div><?php endif; ?>
                        <?php if ($subtitle): ?><h3 class="text-2xl font-bold mb-3"><?= esc_html($subtitle); ?></h3>
                        <?php endif; ?>
                        <?php if ($content): ?><div class="text-gray-700 text-sm mb-4">
                            <?= wp_kses_post(wpautop($content)); ?></div><?php endif; ?>
                        <?php if ($cta_label && $cta_link): ?>
                        <a href="<?= esc_url($cta_link); ?>"
                            class="inline-block border px-4 py-2 rounded hover:bg-black hover:text-white transition"><?= esc_html($cta_label); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="space-y-8">
                <?php foreach ($items as $item):
                    if (($item['style'] ?? '') !== 'stats') continue;
                    $bg = $item['bg_color'] ?? '#F5A623';
                    $big = $item['stat_big'] ?? '';
                    $left_v = $item['stat_left_value'] ?? '';
                    $left_l = $item['stat_left_label'] ?? '';
                    $right_v = $item['stat_right_value'] ?? '';
                    $right_l = $item['stat_right_label'] ?? '';
                    $image = $item['image'] ?? '';
                ?>
                <div class="rounded-lg p-8 text-center" style="background:<?= esc_attr($bg); ?>; color: #111;">
                    <?php if ($image): ?>
                    <div class="mx-auto mb-4"
                        style="width:72px;height:72px;border-radius:50%;overflow:hidden;display:inline-block;">
                        <img src="<?= esc_url($image); ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <?php endif; ?>

                    <?php if ($big): ?>
                    <div class="text-4xl md:text-5xl font-extrabold mb-2"><?= esc_html($big); ?></div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 gap-4 mt-6 text-left">
                        <div>
                            <?php if ($left_v): ?><div class="text-2xl font-bold"><?= esc_html($left_v); ?></div>
                            <?php endif; ?>
                            <?php if ($left_l): ?><div class="text-sm"><?= esc_html($left_l); ?></div><?php endif; ?>
                        </div>
                        <div>
                            <?php if ($right_v): ?><div class="text-2xl font-bold"><?= esc_html($right_v); ?></div>
                            <?php endif; ?>
                            <?php if ($right_l): ?><div class="text-sm"><?= esc_html($right_l); ?></div><?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
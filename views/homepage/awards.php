<?php
// Retrieve values from MetaBoxes
$show_section = get_post_meta(get_the_ID(), 'show_awards_section', true);
$title        = get_post_meta(get_the_ID(), 'awards_section_title', true) ?: 'НАШІ НАГОРОДИ';
$awards_items = get_post_meta(get_the_ID(), 'awards_items', true) ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($awards_items)) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">

        <!-- Section Title -->
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8 md:mb-12">
            <?= esc_html($title); ?>
        </h2>

        <!-- Awards / Logos Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 items-center">
            <?php foreach ($awards_items as $item):
                $image = $item['image'] ?? '';
                $label = $item['title'] ?? '';
                $link  = $item['link'] ?? '';
                if (!$image) continue;
            ?>
            <div class="flex items-center justify-center p-4 bg-transparent">
                <?php if ($link): ?>
                <a href="<?= esc_url($link); ?>" target="_blank" rel="noopener noreferrer" class="block max-w-full"
                    aria-label="<?= esc_attr($label ?: 'award'); ?>">
                    <div class="mx-auto"
                        style="max-height:80px; display:flex; align-items:center; justify-content:center;">
                        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($label); ?>"
                            style="max-height:80px; width:auto; object-fit:contain; display:block;">
                    </div>
                </a>
                <?php else: ?>
                <div class="mx-auto" style="max-height:80px; display:flex; align-items:center; justify-content:center;">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($label); ?>"
                        style="max-height:80px; width:auto; object-fit:contain; display:block;">
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php
// ACF fields
$show     = get_field('show_initiatives_section');
$title    = get_field('initiatives_section_title') ?: 'ВІРИМО В ОСВІТУ, ЩО РУХАЄ ВПЕРЕД';
$subtitle = get_field('initiatives_section_subtitle') ?: 'ТОМУ ПІДТРИМУЄМО СОЦІАЛЬНІ ТА ОСВІТНІ ІНІЦІАТИВИ Й ЗАПУСКАЄМО ВЛАСНІ';
$slides   = get_field('initiatives_list');

var_dump($slides);
echo 'hey there';

// Exit if section disabled or empty
if (!$show || empty($slides)) return;
?>

<section id="initiatives" class="py-20 px-4 bg-white">
    <div class="container mx-auto max-w-7xl">

        <h2 class="text-4xl md:text-5xl font-bold text-center">
            <?= esc_html($title); ?>
        </h2>

        <?php if ($subtitle): ?>
        <p class="text-lg md:text-xl text-gray-600 text-center max-w-3xl mx-auto mt-4">
            <?= esc_html($subtitle); ?>
        </p>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
            <?php foreach ($slides as $slide):
                $photo = $slide['photo']['url'] ?? '';
                $slide_title = $slide['title'] ?? '';
                $description = $slide['description'] ?? '';
            ?>
            <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
                <?php if ($photo): ?>
                <img src="<?= esc_url($photo); ?>" alt="<?= esc_attr($slide_title); ?>"
                    class="w-full h-64 object-cover rounded-lg mb-4">
                <?php endif; ?>

                <h3 class="text-xl font-semibold mb-2"><?= esc_html($slide_title); ?></h3>
                <p class="text-gray-600"><?= esc_html($description); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
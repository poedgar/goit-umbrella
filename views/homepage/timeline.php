<?php
// Retrieve values from MetaBoxes
$show_section = get_field('show_timeline_section');
$title        = get_field('timeline_section_title') ?: 'НАШ ШЛЯХ';
$items        = get_field('timeline_items') ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">

        <!-- Section Title -->
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8 md:mb-12">
            <?= esc_html($title); ?>
        </h2>

        <!-- Carousel Nav -->
        <div class="flex justify-between items-center mb-6">
            <button class="timeline-prev px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">назад</button>
            <button class="timeline-next px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">вперед</button>
        </div>

        <!-- Timeline Carousel -->
        <div class="timeline-track flex gap-6 overflow-x-auto scroll-smooth pb-4">
            <?php foreach ($items as $item):
                $image   = $item['image'] ?? '';
                $year    = $item['year'] ?? '';
                $heading = $item['heading'] ?? '';
                $content = $item['content'] ?? '';
            ?>
            <article class="timeline-card flex-shrink-0 w-[720px] bg-white rounded-xl overflow-hidden flex">
                <?php if ($image): ?>
                <div class="w-2/5 min-w-[260px] max-w-[360px]">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($heading ?: $year); ?>"
                        class="w-full h-full object-cover block">
                </div>
                <?php endif; ?>

                <div class="p-8 flex-1">
                    <?php if ($year): ?>
                    <div class="text-5xl font-bold mb-4"><?= esc_html($year); ?></div>
                    <?php endif; ?>

                    <?php if ($heading): ?>
                    <h3 class="text-xl font-bold mb-3 uppercase"><?= esc_html($heading); ?></h3>
                    <?php endif; ?>

                    <?php if ($content): ?>
                    <div class="text-gray-700 text-sm"><?= wp_kses_post(wpautop($content)); ?></div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<script>
(function() {
    const track = document.querySelector('.timeline-track');
    if (!track) return;

    const getCardWidth = () => {
        const card = track.querySelector('.timeline-card');
        return card ? card.getBoundingClientRect().width + 24 : 720;
    };

    document.querySelectorAll('.timeline-next').forEach(btn =>
        btn.addEventListener('click', () => track.scrollBy({
            left: getCardWidth(),
            behavior: 'smooth'
        }))
    );

    document.querySelectorAll('.timeline-prev').forEach(btn =>
        btn.addEventListener('click', () => track.scrollBy({
            left: -getCardWidth(),
            behavior: 'smooth'
        }))
    );
})();
</script>
<?php
// Retrieve values from MetaBoxes
$show_section = get_post_meta(get_the_ID(), 'show_timeline_section', true);
$title        = get_post_meta(get_the_ID(), 'timeline_section_title', true) ?: 'НАШ ШЛЯХ';
$items        = get_post_meta(get_the_ID(), 'timeline_items', true) ?: [];

// Don't render if section disabled or empty
if (!$show_section || empty($items)) return;
?>

<section class="py-16 px-4 bg-gray-100">
    <div class="container mx-auto max-w-7xl">

        <!-- Section Title -->
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8 md:mb-12">
            <?= esc_html($title); ?>
        </h2>

        <!-- Nav -->
        <div class="flex justify-between items-center mb-6">
            <button class="timeline-prev button">назад</button>
            <button class="timeline-next button">вперед</button>
        </div>

        <!-- Timeline carousel (horizontal scroll) -->
        <div class="timeline-track"
            style="display:flex;gap:24px;overflow-x:auto;scroll-behavior:smooth;padding-bottom:8px;">
            <?php foreach ($items as $item):
                $image   = $item['image'] ?? '';
                $year    = $item['year'] ?? '';
                $heading = $item['heading'] ?? '';
                $content = $item['content'] ?? '';
            ?>
            <article class="timeline-card"
                style="flex:0 0 720px; background:#fff;border-radius:10px; overflow:hidden; display:flex;">
                <?php if ($image): ?>
                <div style="width:45%;min-width:260px;max-width:360px;">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($heading ?: $year); ?>"
                        style="width:100%;height:100%;object-fit:cover;display:block;">
                </div>
                <?php endif; ?>

                <div style="padding:32px;flex:1;">
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
    var track = document.querySelector('.timeline-track');
    if (!track) return;
    var cardWidth = function() {
        return track.querySelector('.timeline-card') ? track.querySelector('.timeline-card')
            .getBoundingClientRect().width + 24 : 720;
    };

    document.querySelectorAll('.timeline-next').forEach(function(btn) {
        btn.addEventListener('click', function() {
            track.scrollBy({
                left: cardWidth(),
                behavior: 'smooth'
            });
        });
    });
    document.querySelectorAll('.timeline-prev').forEach(function(btn) {
        btn.addEventListener('click', function() {
            track.scrollBy({
                left: -cardWidth(),
                behavior: 'smooth'
            });
        });
    });
})();
</script>

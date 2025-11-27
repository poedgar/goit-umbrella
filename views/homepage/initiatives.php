<?php
    $post_id = get_the_ID(); // Works in page templates

    $show = get_post_meta($post_id, 'show_initiatives_section', true);
    if (!$show) return;

    $title = get_post_meta($post_id, 'initiatives_section_title', true) ?: 'ВІРИМО В ОСВІТУ, ЩО РУХАЄ ВПЕРЕД';
    $subtitle = get_post_meta($post_id, 'initiatives_section_subtitle', true) ?: 'ТОМУ ПІДТРИМУЄМО СОЦІАЛЬНІ ТА ОСВІТНІ ІНІЦІАТИВИ Й ЗАПУСКАЄМО ВЛАСНІ, ЩОБ ВІДКРИВАТИ БІЛЬШЕ МОЖЛИВОСТЕЙ І СТВОРЮВАТИ ЗМІНИ';
    $initiatives = get_post_meta($post_id, 'initiatives_list', true) ?: [];

    if (empty($initiatives)) return;
    ?>
<section class="py-16 px-4 bg-gray-50">
    <div class="container mx-auto max-w-7xl">

        <!-- Header -->
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                <?= esc_html($title); ?>
            </h2>
            <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                <?= esc_html($subtitle); ?>
            </p>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center mb-6">
            <button
                class="btn-prev px-4 py-2 bg-white border border-gray-300 rounded-md font-bold hover:bg-gray-100 transition">
                назад
            </button>
            <button
                class="btn-next px-4 py-2 bg-white border border-gray-300 rounded-md font-bold hover:bg-gray-100 transition">
                вперед
            </button>
        </div>

        <!-- Slider -->
        <div class="initiatives-slider">
            <div class="slides flex gap-6 overflow-x-auto scroll-smooth pb-4">
                <?php foreach ($initiatives as $item): ?>
                <div
                    class="initiative-card flex-shrink-0 w-[300px] bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-transform hover:-translate-y-1">
                    <?php if (!empty($item['photo'])): ?>
                    <div class="aspect-video overflow-hidden">
                        <img src="<?= esc_url($item['photo']); ?>" alt="<?= esc_attr($item['title']); ?>"
                            class="w-full h-full object-cover">
                    </div>
                    <?php endif; ?>
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-black mb-2 line-clamp-2">
                            <?= esc_html($item['title']); ?>
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-3">
                            <?= esc_html($item['description']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.initiatives-slider');
    const slides = document.querySelector('.slides');
    const btnPrev = document.querySelector('.btn-prev');
    const btnNext = document.querySelector('.btn-next');

    let scrollAmount = 0;
    const slideWidth = 300 + 24; // card width + gap

    btnNext.addEventListener('click', () => {
        scrollAmount += slideWidth;
        if (scrollAmount > slides.scrollWidth - slider.offsetWidth) {
            scrollAmount = slides.scrollWidth - slider.offsetWidth;
        }
        slides.style.transform = `translateX(-${scrollAmount}px)`;
    });

    btnPrev.addEventListener('click', () => {
        scrollAmount -= slideWidth;
        if (scrollAmount < 0) {
            scrollAmount = 0;
        }
        slides.style.transform = `translateX(-${scrollAmount}px)`;
    });
});
</script>